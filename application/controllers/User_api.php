<?php defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/API_Controller.php';

class User_api extends API_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Simple API
     * 
     * @link: api/v1/simple
     */
    public function simple_api()
    {
        header("Access-Control-Allow-Origin: *");

        // API Configuration
        $this->_apiConfig([
            'methods' => ['POST']  //Request Method oOnly POST
        ]);
    }

    /**
     * API Limit
     * 
     * @link: api/v1/limit
     */
    public function api_limit()
    {
        /**
        * API Limit
        * ----------------------------------
        * @param: {int} API limit Number
        * @param: {string} API limit Type (IP)
        * @param: {int} API limit Time [minute]
        */

        $this->_APIConfig([
            // number limit, type limit, time limit (last minute)
            'limit' => [10, 'ip', 5]
        ]);
    }

    /**
     * API Key without Database
     * @link: api/v1/key
     */
    public function api_key()
    {
        /**
         * Use API Key without Database
         * ---------------------------------------------------------
         * @param: {string} Types
         * @param: {string} API Key
         */
        $this->_APIConfig([
            'methods' => ['POST'],
            'key' => ['header', '123456'],
        ]);
    }

    /**
     * API Key with Database
     * @link: api/v1/keydb
     */
    public function api_key_db()
    {
        /**
         * API Key
         * ---------------------------------------------------------
         * @param: {string} Types
         * @param: {string} [table]
         */
        $this->_APIConfig([
            // 'key' => ['header', 'table'],
            'methods' => ['POST'],
            'key' => ['header'],
            //Add custom data in in API Responses
            'data' => [ 'is_login' => false ], // custom data 
        ]);

        // Data
        $data = array(
            'status' => 'OK',
            'data' => [
                'user_id' => 12,
            ]
        );

        /**
         * Return API Response
         * ---------------------------------------------------------
         * @param: API Data
         * @param: Request Status Code
         */
        if (!empty($data)) {
            $this->api_return($data, 200);
        } else {
            $this->api_return(['status' => false, 'error' => 'Invalid Data'], 404);
        }
        
        
    }
    /**
     * login method 
     *
     * @link [api/user/login]
     * @method POST
     * @return Response|void
    */
    public function login()
    {
        header("Access-Control-Allow-Origin: *");

        // API Configuration
        $this->_apiConfig([
            'methods' => ['POST'],
        ]);

        // you user authentication code will go here, you can compare the user with the database or whatever
        $payload = [
            'id' => "123456",
            'user' => "Jenni",
            'email' => "jen_cadiz@hotmail.com",
            'time' => date('Y-m-d h:i:s a', time()),
        ];

        // Load Authorization Library or Load in autoload config file
        $this->load->library('authorization_token');

        // generte a token
        $token = $this->authorization_token->generateToken($payload);

        // return data
        $this->api_return(
            [
                'status' => true,
                "result" => [
                    'token' => $token,
                ],
                
            ],
        200);
    }

    /**
     * view User Data
     *
     * @link [api/user/view]
     * @method POST
     * @return Response|void
     */
    public function view()
    {
        header("Access-Control-Allow-Origin: *");

        // API Configuration [Return Array: User Token Data]
        $user_data = $this->_apiConfig([
            'methods' => ['POST'],
            'requireAuthorization' => true,
        ]);

        // return data
        $this->api_return(
            [
                'status' => true,
                "result" => [
                    'user_data' => $user_data['token_data']
                ],
            ],
        200);
    }
}
