<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Stud extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->database();
    }

    public function index()
    {
        $query = $this->db->get("stud");
        $data['records'] = $query->result();

        $this->load->helper('url');
        $this->load->view('stud/stud_view', $data);
    }

    public function add_student_view()
    {
        $this->load->helper('form');
        $this->load->view('stud/stud_add');
    }

    public function add_student()
    {
        $this->load->model('Stud_Model');

        $data = array(
            'ci' => $this->input->post('ci'),
            'name' => $this->input->post('name')
        );

        $this->Stud_Model->insert($data);

        $query = $this->db->get("stud");
        $data['records'] = $query->result();
        redirect('stud');
    }

    public function update_student_view()
    {
        $this->load->helper('form');
        $ci = $this->uri->segment('3');
        $query = $this->db->get_where('stud', array('ci' => $ci));
        $data['records'] = $query->result();
        $data['old_ci'] = $ci;
        $this->load->view('stud/stud_edit', $data);
    }

    public function update_student()
    {
        $this->load->model('Stud_Model');

        $data = array(
            'ci' => $this->input->post('ci'),
            'name' => $this->input->post('name')
        );

        $old_ci = $this->input->post('old_ci');
        $this->Stud_Model->update($data, $old_ci);

        $query = $this->db->get("stud");
        $data['records'] = $query->result();
        redirect('stud');
    }

    public function delete_student()
    {
        $this->load->model('Stud_Model');
        $ci = $this->uri->segment('3');
        $this->Stud_Model->delete($ci);

        $query = $this->db->get("stud");
        $data['records'] = $query->result();
        redirect('stud');
    }
}
