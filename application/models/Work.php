<?php
class Work extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function getList()
    {
        $query =  $this->db->get('works');
        return $query->result_array();
    }
    public function getById($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('works');
        return $query->row_array();
    }
    public function store($randomFilename = false)
    {
        $data = [
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
        ];
        $folder = 'uploads/works';
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }
        if (!empty($_FILES['file'])) {
            $fileName = $_FILES['file']['name'];
            if ($randomFilename) {
                $fileName = md5(uniqid()) . '.' . pathinfo($fileName, PATHINFO_EXTENSION);
            }
            $filePath = $folder . '/' . $fileName;
            move_uploaded_file($_FILES['file']['tmp_name'], $filePath);
            $data['file'] = $filePath;
        }
        $result = $this->db->insert('works', $data);
    }
    public function update($id, $randomFilename = false)
    {
        $work = $this->getById($id);
        $data = [
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
        ];
        $folder = 'uploads/works';
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }
        if (!empty($_FILES['file']) && !empty($_FILES['file']['tmp_name'])) {
            $fileName = $_FILES['file']['name'];
            if ($randomFilename) {
                $fileName = md5(uniqid()) . '.' . pathinfo($fileName, PATHINFO_EXTENSION);
            }
            $filePath = $folder . '/' . $fileName;
            $file = move_uploaded_file($_FILES['file']['tmp_name'], $filePath);
            if ($file && isset($work['file']) && file_exists($work['file'])) {
                unlink($work['file']);
            }
            $data['file'] = $filePath;
        }
        $this->db->where('id', $id)->update('works', $data);
    }
    public function delete($id)
    {
        $work = $this->getById($id);
        if (isset($work['file']) && file_exists($work['file'])) {
            unlink($work['file']);
        }
        $this->db->where('id', $id)->delete('works');
    }
}
