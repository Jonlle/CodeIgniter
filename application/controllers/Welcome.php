<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        // $this->load->view('welcome_message');
        $datos = array(
            'nombre' => 'Jhonatan Lerena',
            'correo' => 'llerena19@hotmail.com',
            'usuario' => 'Jonlle',
            'contraseña' => '2b631272f3914ad68399ca37b2eeea714d2c6829'
        );
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($datos));

        //echo json_encode($datos);
    }
}
