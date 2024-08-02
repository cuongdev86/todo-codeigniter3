<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user');
        $this->load->helper('url');
        $this->load->library('session');
        if (!$this->user->isLoggedIn()) {
            redirect(base_url() . 'login');
        }
    }
    public function index($page = 'user')
    {
        if (!file_exists(APPPATH . 'views/' . $page . '/index.php')) {
            show_404();
        }
        $data['title'] = ucfirst('Users');
        $users = $this->user->getList();
        $data['content'] =  $this->load->view($page . '/index', ['users' => $users], TRUE); //tham số TRUE giúp content trả về dưới dạng chuỗi
        $this->load->view('layouts/admin', $data);
    }
    public function create($page = 'user')
    {
        if (!file_exists(APPPATH . 'views/' . $page . '/create.php')) {
            show_404();
        }
        $data['title'] = ucfirst('Create user');
        $data['content'] =  $this->load->view($page . '/create', null, TRUE);
        $this->load->view('layouts/admin', $data);
    }
    public function store()
    {
        $this->user->store();
        flashMessage('success', 'User created successfully');
        redirect(base_url() . 'users');
    }
    public function edit($id)
    {
        $user = $this->user->getById($id);
        if (!$user) {
            show_404();
        }
        $data['title'] = ucfirst('Edit user');
        $data['user'] = $user;
        $data['content'] =  $this->load->view('user/edit', $data, TRUE);
        $this->load->view('layouts/admin', $data);
    }
    public function update($id)
    {
        $this->user->update($id);
        flashMessage('success', 'User updated successfully');
        redirect(base_url() . 'users');
    }
    public function delete($id)
    {
        $this->user->delete($id);
        flashMessage('success', 'User deleted successfully');
        redirect(base_url() . 'users');
    }
}
