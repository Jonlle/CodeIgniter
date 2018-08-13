<?php

class Users_model extends CI_Model
{
    public function create_member($data)
    {
        $insert = $this->db->insert('membership', $data);
        return $insert;
    }

    public function validate_credentials($data)
    {
        $this->db->where('username', $data['username']);
        $this->db->where('password', $data['password']);
        $query = $this->db->get('membership');
        log_message('info', 'query->num_rows: ' . json_encode($query->num_rows()));
        return $query;
    }

    public function get_users()
    {
        $query = $this->db->get("membership");
        return $query;
    }
    public function get_user($user)
    {
        $this->db->where('username', $user);
        $query = $this->db->get("membership");
        return $query;
    }
    public function delete_user($user)
    {
        $this->db->delete("membership", array('username' => $user));
    }

    public function update_member($data)
    {
        log_message('info', 'Datos recibidos e update_member: ' . json_encode($data));
        $user = array(
'username' => $data['username'],
'email_address' => $data['email_address'],
'role' => $data['role'],
);
        log_message('info', 'Actualizando usuario: ' . json_encode($user));
        log_message('info', 'Con ID# ' . $data['id']);
        $this->db->set($user);
        $this->db->where("id", $data['id']);
        $this->db->update("membership", $user);
    }
}
