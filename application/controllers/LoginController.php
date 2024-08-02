<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LoginController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user');
        $this->load->helper('url');
        $this->load->library('session');
    }
    public function flashMessage($type, $message = '')
    {
        $this->session->set_flashdata('message_type', $type);
        $this->session->set_flashdata('message', $message);
    }
    public function login()
    {
        if ($this->user->isLoggedIn()) {
            redirect(base_url() . 'works');
        }
        $this->load->view('login');
    }
    public function postLogin()
    {
        $remember = !empty($this->input->post('remember')) ? true : false;
        if ($this->user->login([
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password')
        ], $remember)) {
            $this->flashMessage('success', 'Login successful');
            redirect(base_url() . 'works');
        } else {
            $this->flashMessage('error', 'Invalid credentials');
            redirect(base_url() . 'login');
        }
    }
}
