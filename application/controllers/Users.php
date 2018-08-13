<?php class Users extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('users_model', 'user');
    }
    public function index()
    {
        //INSTANCIA HEADER
        $header=$this->parser->parse('users/layouts/header', array('titlePage'=> 'Login'), true);
        //INSTANCIA DEL FOOTER
        $footer=$this->parser->parse('users/layouts/footer', array(), true);
        //INSTANCIA DE PARTE DE CUERPO
        $content=$this->parser->parse('users/login_form', array(), true);
        //DATA QUE SE PASA AL LAYOUT EN GENERAL
        //ACA SE INSTANCIA EL HEADER FOOTER Y CONTENT
        $data=array('header'=> $header, 'content'=> $content, 'footer'=> $footer);
        $this->parser->parse('users/layouts/template', $data);
    }
    public function login()
    {
        $data=array( 'username'=> $this->input->post('username'), 'password'=> md5($this->input->post('password')));
        log_message('info', 'Entrando a validate_credentials con: ' . json_encode($data));
        $query=$this->user->validate_credentials($data);
        if ($query->num_rows() > 0) {
            $user['records']=$query->result();
            log_message('info', 'Datos Usuario: ' . json_encode($user['records']));
            $data=array( 'username'=> $user['records'][0]->username, 'role'=> $user['records'][0]->role, 'logged_in'=> true, );
            $this->session->set_userdata($data);
            if ($data['role']=='admin') {
                // ------------------ Vista logged_in_area.php ------------------
                $header=$this->parser->parse('users/layouts/header', array('titlePage'=> 'Admin Section'), true);
                $footer=$this->parser->parse('users/layouts/footer', array(), true);
                $content=$this->parser->parse('users/logged_in_area', array(), true);
                $data=array('header'=> $header, 'content'=> $content, 'footer'=> $footer);
                $this->parser->parse('users/layouts/template', $data);
            } else {
                // ------------------ Vista user_logged_in.php ------------------
                $header=$this->parser->parse('users/layouts/header', array('titlePage'=> 'User Section'), true);
                $footer=$this->parser->parse('users/layouts/footer', array(), true);
                $content=$this->parser->parse('users/user_logged_in', array(), true);
                $data=array('header'=> $header, 'content'=> $content, 'footer'=> $footer);
                $this->parser->parse('users/layouts/template', $data);
            }
        } else {
            // ------------------ Vista wrong_credentials.php ------------------
            $header=$this->parser->parse('users/layouts/header', array('titlePage'=> 'Error'), true);
            $footer=$this->parser->parse('users/layouts/footer', array(), true);
            $content=$this->parser->parse('users/wrong_credentials', array(), true);
            $data=array('header'=> $header, 'content'=> $content, 'footer'=> $footer);
            $this->parser->parse('users/layouts/template', $data);
        }
    }
    public function signup()
    {
        // ------------------ Vista signup_form.php ------------------
        log_message('info', 'Signup...');
        $header=$this->parser->parse('users/layouts/header', array('titlePage'=> 'Sign Up!'), true);
        $footer=$this->parser->parse('users/layouts/footer', array(), true);
        $content=$this->parser->parse('users/signup_form', array(), true);
        $data=array('header'=> $header, 'content'=> $content, 'footer'=> $footer);
        $this->parser->parse('users/layouts/template', $data);
    }
    public function user()
    {
        $user=$this->uri->segment('3');
        if (!$user) {
            $query=$this->user->get_users();
        } else {
            $query=$this->user->get_user($user);
        }
        if ($query->num_rows() > 0) {
            $users['records']=$query->result();
            // ------------------ Vista signup_form.php ------------------
            log_message('info', 'mostrando lista de usuarios data: ' . json_encode($users['records']));
            $header=$this->parser->parse('users/layouts/header', array('titlePage'=> 'Users'), true);
            $footer=$this->parser->parse('users/layouts/footer', array(), true);
            $content=$this->parser->parse('users/user', $users, true);
            $data=array('header'=> $header, 'content'=> $content, 'footer'=> $footer);
            $this->parser->parse('users/layouts/template', $data);
        } else {
            // ------------------ Vista error.php ------------------
            $header=$this->parser->parse('users/layouts/header', array('titlePage'=> 'Error'), true);
            $footer=$this->parser->parse('users/layouts/footer', array(), true);
            $content=$this->parser->parse('users/error', array(), true);
            $data=array('header'=> $header, 'content'=> $content, 'footer'=> $footer);
            $this->parser->parse('users/layouts/template', $data);
        }
    }
    public function edit()
    {
        $user=$this->uri->segment('3');
        $query=$this->user->get_user($user);
        $user=$query->result()[0];
        // ------------------ Vista edit.php ------------------
        $header=$this->parser->parse('users/layouts/header', array('titlePage'=> 'Edit Records'), true);
        $footer=$this->parser->parse('users/layouts/footer', array(), true);
        $content=$this->parser->parse('users/edit', $user, true);
        $data=array('header'=> $header, 'content'=> $content, 'footer'=> $footer);
        $this->parser->parse('users/layouts/template', $data);
    }
    public function update()
    {
        $this->load->library('form_validation');
        $member_update=array( 'email_address'=> $this->input->post('email_address'), 'username'=> $this->input->post('username'), 'role'=> $this->input->post('role'), 'id'=> $this->input->post('id'), );
        $this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('role', 'Role', 'trim|required|min_length[4]|max_length[5]');
        if ($this->form_validation->run()==false) {
            // ------------------ Vista signup_form.php ------------------
            log_message('info', 'error en validacion...');
            $header=$this->parser->parse('users/layouts/header', array('titlePage'=> 'Update!'), true);
            $footer=$this->parser->parse('users/layouts/footer', array(), true);
            $content=$this->parser->parse('users/edit', $member_update, true);
            $data=array('header'=> $header, 'content'=> $content, 'footer'=> $footer);
            $this->parser->parse('users/layouts/template', $data);
        } else {
            log_message('info', 'listo validacion con dato----> ' . json_encode($member_update));
            log_message('info', 'listo validacion, Actualizando en bd...');
            $this->user->update_member($member_update);
            redirect('users/user');
        }
    }
    public function delete()
    {
        $user=$this->uri->segment('3');
        $this->user->delete_user($user);
        redirect('users/user');
    }
    public function create_member()
    {
        $this->load->library('form_validation');
        $new_member_insert_data=array( 'first_name'=> $this->input->post('first_name'), 'last_name'=> $this->input->post('last_name'), 'email_address'=> $this->input->post('email_address'), 'username'=> $this->input->post('username'), 'role'=> $this->input->post('role'), 'password'=> md5($this->input->post('password')));
        log_message('info', 'Validando...');
        $this->form_validation->set_rules('first_name', 'Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('role', 'Role', 'trim|required|min_length[4]|max_length[5]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[12]');
        $this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password]');
        if ($this->form_validation->run()==false) {
            // ------------------ Vista signup_form.php ------------------
            log_message('info', 'error en validacion...');
            $header=$this->parser->parse('users/layouts/header', array('titlePage'=> 'Sign Up!'), true);
            $footer=$this->parser->parse('users/layouts/footer', array(), true);
            $content=$this->parser->parse('users/signup_form', $new_member_insert_data, true);
            $data=array('header'=> $header, 'content'=> $content, 'footer'=> $footer);
            $this->parser->parse('users/layouts/template', $data);
        } else {
            log_message('info', 'listo validacion, insertando registro en bd...');
            $query=$this->user->create_member($new_member_insert_data);
            if ($query) {
                // ------------------ Vista signup_form.php ------------------
                log_message('info', 'registro exitoso...');
                $header=$this->parser->parse('users/layouts/header', array('titlePage'=> 'Sign Up!'), true);
                $footer=$this->parser->parse('users/layouts/footer', array(), true);
                $content=$this->parser->parse('users/signup_successful', array(), true);
                $data=array('header'=> $header, 'content'=> $content, 'footer'=> $footer);
                $this->parser->parse('users/layouts/template', $data);
            } else {
                log_message('info', 'no se pudo insertar registro en bd...');
                $header=$this->parser->parse('users/layouts/header', array('titlePage'=> 'Sign Up!'), true);
                $footer=$this->parser->parse('users/layouts/footer', array(), true);
                $content=$this->parser->parse('users/signup_form', $new_member_insert_data, true);
                $data=array('header'=> $header, 'content'=> $content, 'footer'=> $footer);
                $this->parser->parse('users/layouts/template', $data);
            }
        }
    }
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('');
    }
}
