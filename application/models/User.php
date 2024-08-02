<?php
class User extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }
    public function getList()
    {
        $query =  $this->db->get('users');
        return $query->result_array();
    }
    public function getById($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('users');
        return $query->row_array();
    }
    public function store()
    {
        $username = $this->input->post('username');
        $this->db->where('username', $username);
        $query = $this->db->get('users');

        if ($query->num_rows() > 0) {
            flashMessage('error', 'User already exists');
            redirect(base_url() . 'users/create');
            exit;
        }
        $data = [
            'name' => $this->input->post('name'),
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'password' => md5($this->input->post('password'))
        ];
        $result = $this->db->insert('users', $data);
    }
    public function update($id)
    {
        $username = $this->input->post('username');
        $this->db->where('username', $username);
        $this->db->where('id !=', $id);
        $query = $this->db->get('users');
        if ($query->row_array()) {
            flashMessage('error', 'User already exists');
            redirect(base_url() . 'users/edit/' . $id);
            exit;
        }



        $data = [
            'name' => $this->input->post('name'),
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
        ];
        $this->db->where('id', $id)->update('users', $data);
    }
    public function delete($id)
    {
        $this->db->where('id', $id)->delete('users');
    }

    public function login($array = [], $remember = false)
    {
        $user = null;
        foreach ($array as $key => $arr) {
            if ($key != 'password') {
                if ($this->db->where($key, $arr)->get('users')->row_array()) {
                    $user = $this->db->where($key, $arr)->get('users')->row_array();
                }
            }
        }
        if ($user && md5($array['password']) == $user['password']) {
            $this->session->set_userdata($user);
            // if ($remember) {
            //     $this->session->set_cookie_params(3600 * 24 * 30);
            // }
            return true;
        }
        return false;
    }
    public function isLoggedIn()
    {
        return ($this->session->userdata() && $this->session->userdata('id')) ? true : false;
    }
    public function logout()
    {
        $this->session->sess_destroy();
        return true;
    }
    public function data()
    {
        return ($this->session->userdata() && $this->session->userdata('id')) ? $this->session->userdata() : null;
    }
}
