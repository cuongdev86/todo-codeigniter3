<?php
defined('BASEPATH') or exit('No direct script access allowed');

class WorkController extends CI_Controller
{
    private $decryptionKey;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user');
        $this->load->model('work');
        $this->load->helper('url');
        $this->load->library('session');

        if (!$this->user->isLoggedIn()) {
            redirect(base_url() . 'login');
        }
        $this->decryptionKey = 'work-encrypt-image';
        // var_dump($config);
        // die();
    }
    public function datatable()
    {
        $data = $this->work->jsonData();
        // var_dump($data);
        // die();
        echo json_encode($data);
    }
    public function index($page = 'work')
    {
        if (!file_exists(APPPATH . 'views/' . $page . '/index.php')) {
            show_404();
        }
        $data['title'] = ucfirst('Works');
        // $q = null;
        // if (isset($_GET['q'])) {
        //     $q = $_GET['q'];
        // }
        // $works = $this->work->getList($q);
        $data['content'] =  $this->load->view('work/index', ['decryptionKey' => $this->decryptionKey], TRUE); //tham số TRUE giúp content trả về dưới dạng chuỗi
        $this->load->view('layouts/admin', $data);
    }
    public function create($page = 'work')
    {
        if (!file_exists(APPPATH . 'views/' . $page . '/create.php')) {
            show_404();
        }
        $data['title'] = ucfirst('Create work');
        $data['content'] =  $this->load->view('work/create', null, TRUE);
        $this->load->view('layouts/admin', $data);
    }
    public function store()
    {
        $this->work->store(false);
        flashMessage('success', 'Work created successfully');
        redirect(base_url() . 'works');
    }
    public function edit($id)
    {
        $work = $this->work->getById($id);
        if (!$work) {
            show_404();
        }
        $data['title'] = ucfirst('Edit work');
        $data['work'] = $work;
        $data['decryptionKey'] = $this->decryptionKey;
        $data['content'] =  $this->load->view('work/edit', $data, TRUE);
        $this->load->view('layouts/admin', $data);
    }
    public function update($id)
    {
        $this->work->update($id);
        flashMessage('success', 'Work updated successfully');
        redirect(base_url() . 'works');
    }
    public function delete($id)
    {
        $this->work->delete($id);
        flashMessage('success', 'Work deleted successfully');
        redirect(base_url() . 'works');
    }
    public function deletes()
    {
        $ids = $this->input->get('ids');
        if (!empty($ids)) {
            $this->work->deletes($ids);
        }
        echo json_encode(['result' => true, 'message' => 'Deleted successfully']);
    }
}
