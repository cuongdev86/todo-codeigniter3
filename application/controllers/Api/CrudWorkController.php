<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CrudWorkController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('work');
        $this->load->helper('url');
    }
    public function index()
    {
        $data = $this->work->getList();
        returnSucess($data);
    }
    public function create()
    {
        $name = $this->input->post('name');
        $description = $this->input->post('description');
        $file = null;
        if (!empty($_FILES['file']) && $_FILES['file']['name']) {
            $file = $_FILES['file'];
        }
        $data = $this->work->apiStore($name, $description, $file, true);
        if ($data) returnSucess($data, 'Created successfully');
        returnError('Failed to create work');
    }
    public function show($id)
    {
        $data = $this->work->getById($id);
        if ($data) returnSucess($data);
        returnNotfound('Work not found');
    }
    public function update($id)
    {
        $name = $this->input->post('name');
        $description = $this->input->post('description');
        $file = null;
        if (!empty($_FILES['file']) && $_FILES['file']['name']) {
            $file = $_FILES['file'];
        }
        $data = $this->work->apiUpdate($id, $name, $description, $file, true);
        if ($data) returnSucess($data, 'Updated successfully');
        returnError('Failed to update work');
    }
    public function delete($id)
    {
        $this->work->delete($id, true);
        returnSucess(null, 'Deleted successfully');
    }
}
