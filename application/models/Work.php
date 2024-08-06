<?php
class Work extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function getList($q = null)
    {
        // if ($q) {
        //     $this->db->like('name', $q);
        //     $this->db->or_like('description', $q);
        // }
        $query =  $this->db->get('works');
        return $query->result_array();
    }
    public function importExcel($data)
    {
        $this->db->insert('works', $data);
    }
    public function getListExport()
    {
        if ($this->input->get('searchbyName')) {
            $this->db->like('name', $this->input->get('searchbyName'));
        }
        if ($this->input->get('searchbyDescription')) {
            $this->db->like('description', $this->input->get('searchbyDescription'));
        }
        if ($this->input->get('sortByName')) {
            $this->db->order_by('name', $this->input->get('sortByName'));
        }
        if ($this->input->get('sortByDescription')) {
            $this->db->order_by('description', $this->input->get('sortByDescription'));
        }
        $query =  $this->db->get('works');
        return $query->result_array();
    }
    public function jsonData()
    {
        $searchValue = $this->input->get('search');
        $searchName = $this->input->get('searchNameUrl');
        $searchDescription = $this->input->get('searchDescriptionUrl');

        $start = $this->input->get('start') ?? 0;
        $length = $this->input->get('length') ?? 10;

        if ($searchName) {
            $this->db->like('name', $searchName);
        }
        if ($searchDescription) {
            $this->db->like('description', $searchDescription);
        }
        if (isset($searchValue) && $searchValue['value']) {
            $this->db->like('name', $searchValue['value']);
            $this->db->or_like('description', $searchValue['value']);
        }



        $filteredQuery = clone $this->db;
        $recordsFiltered = $filteredQuery->count_all_results('works', FALSE); // FALSE để không reset query

        $columns = ['id', 'name', 'description', 'file', 'action'];
        $orderColumnIndex = $this->input->get('order')[0]['column'];
        $orderColumn = $columns[$orderColumnIndex];  // index starts at 0
        $orderDir = $this->input->get('order')[0]['dir'];

        if (!empty($orderColumn) && !empty($orderDir)) {
            if (!in_array($orderColumn, ['id', 'file', 'action'])) {
                $this->db->order_by($orderColumn, $orderDir);
            }
        }

        $this->db->limit($length, $start);
        $query = $this->db->get('works');


        // done apply the filtering
        $totalRecordsQuery = clone $this->db;
        $totalRecordsQuery->reset_query(); //
        $recordsTotal = $totalRecordsQuery->count_all('works');

        $data = $query->result_array();
        $data = array_map(function ($row) {
            $row['file_base64'] = $row['file'] ? base64DecryptImage($row['file'], 'work-encrypt-image') : null;
            $row['action'] = $row;
            return $row;
        }, $data);

        return [
            'draw' => $this->input->get('draw'),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
        ];
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

            // change file name after upload
            $encryptedFilePath = $folder . '/' . md5(uniqid()) . '.enc';
            // encryptedFilePath
            $encryptionKey = 'work-encrypt-image';
            encryptImage($filePath, $encryptedFilePath, $encryptionKey);

            // delete image root
            unlink($filePath);
            $data['file'] = $encryptedFilePath;



            // $data['file'] = $filePath;
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

            // change file name after upload
            $encryptedFilePath = $folder . '/' . md5(uniqid()) . '.enc';
            // encryptedFilePath
            $encryptionKey = 'work-encrypt-image';
            encryptImage($filePath, $encryptedFilePath, $encryptionKey);

            if ($encryptedFilePath && isset($work['file']) && file_exists($work['file'])) {
                unlink($work['file']);
            }
            // delete image root
            unlink($filePath);
            $data['file'] = $encryptedFilePath;

            // if ($file && isset($work['file']) && file_exists($work['file'])) {
            //     unlink($work['file']);
            // }
            // $data['file'] = $filePath;
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
    public function deletes($ids)
    {
        $this->db->where_in('id', $ids)->delete('works');
    }

    //api
    public function apiStore($name, $description, $file = null, $randomFilename = false)
    {
        $data = [
            'name' => $name,
            'description' => $description,
        ];
        $folder = 'uploads/works';
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }
        if ($file) {
            $fileName = $file['name'];
            if ($randomFilename) {
                $fileName = md5(uniqid()) . '.' . pathinfo($fileName, PATHINFO_EXTENSION);
            }
            $filePath = $folder . '/' . $fileName;
            move_uploaded_file($file['tmp_name'], $filePath);

            // change file name after upload
            $encryptedFilePath = $folder . '/' . md5(uniqid()) . '.enc';
            // encryptedFilePath
            $encryptionKey = 'work-encrypt-image';
            encryptImage($filePath, $encryptedFilePath, $encryptionKey);

            // delete image root
            unlink($filePath);
            $data['file'] = $encryptedFilePath;
        }
        if ($this->db->insert('works', $data)) {
            $insert_id = $this->db->insert_id();
            return $this->getById($insert_id);
        } else {
            return false;
        }
    }
    public function apiUpdate($id, $name, $description, $file = null, $randomFilename = false)
    {
        $work = $this->getById($id);
        $data = [
            'name' => $name,
            'description' => $description,
        ];
        $folder = 'uploads/works';
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }
        if ($file) {
            // var_dump($file);
            // die();
            $fileName = $file['name'];
            if ($randomFilename) {
                $fileName = md5(uniqid()) . '.' . pathinfo($fileName, PATHINFO_EXTENSION);
            }
            $filePath = $folder . '/' . $fileName;
            $fileUpload = move_uploaded_file($file['tmp_name'], $filePath);
            // change file name after upload
            $encryptedFilePath = $folder . '/' . md5(uniqid()) . 'abc.enc';
            // encryptedFilePath
            $encryptionKey = 'work-encrypt-image';
            encryptImage($filePath, $encryptedFilePath, $encryptionKey);

            if ($encryptedFilePath && isset($work['file']) && file_exists($work['file'])) {
                unlink($work['file']);
            }
            // delete image root
            unlink($filePath);
            $data['file'] = $encryptedFilePath;
        }
        $result = $this->db->where('id', $id)->update('works', $data);
        if ($result) {
            return $this->getById($id);
        }
        return false;
    }
}
