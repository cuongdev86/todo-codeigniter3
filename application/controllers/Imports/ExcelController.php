<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ExcelController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('work');
        $this->load->helper('url');
        $this->load->library('session');
    }
    public function import_excel_works_test()
    {
        if (isset($_FILES['excel_file']['name'])) {
            $config['upload_path'] = FCPATH . 'uploads/';
            $config['allowed_types'] = 'xlsx|xls';
            $config['file_name'] = $_FILES['excel_file']['name'];

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('excel_file')) {
                $upload_data = $this->upload->data();
                $inputFileName = $upload_data['full_path'];

                try {
                    $spreadsheet = IOFactory::load($inputFileName);
                    $sheet = $spreadsheet->getActiveSheet();
                    $data = $sheet->toArray(null, true, true, true);

                    foreach ($data as $row) {
                        // Bỏ qua tiêu đề cột
                        if ($row['A'] == 'Name' && $row['B'] == 'Description') {
                            continue;
                        }

                        // Lấy dữ liệu từ mỗi hàng
                        $name = $row['A'];
                        $description = $row['B'];
                        $image = $row['C'];

                        // Lưu dữ liệu vào cơ sở dữ liệu
                        $work_data = array(
                            'name' => $name,
                            'description' => $description,
                            // 'file' => $image // Nếu lưu ảnh dưới dạng base64 hoặc đường dẫn
                        );

                        $this->work->importExcel($work_data);
                    }

                    echo "Import dữ liệu thành công!";
                } catch (Exception $e) {
                    echo "Lỗi khi import: " . $e->getMessage();
                }
            } else {
                echo "Lỗi khi tải lên tệp: " . $this->upload->display_errors();
            }
        } else {
            echo "Không có tệp nào được chọn.";
        }
    }
    public function import_excel_works()
    {
        if (isset($_FILES['excel_file']['name'])) {
            // var_dump(pathinfo($_FILES['excel_file']['name'], PATHINFO_EXTENSION));
            // die();
            $folder = 'uploads/imports/excel';
            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
            }
            $filePath = $folder . '/' . uniqid() . '.' . pathinfo($_FILES['excel_file']['name'], PATHINFO_EXTENSION);
            move_uploaded_file($_FILES['excel_file']['tmp_name'], $filePath);
            try {
                $spreadsheet = IOFactory::load($filePath);
                $sheet = $spreadsheet->getActiveSheet();
                $data = $sheet->toArray(null, true, true, true);


                foreach ($data as $row) {
                    // Bỏ qua tiêu đề cột
                    if ($row['A'] == 'Name' && $row['B'] == 'Description') {
                        continue;
                    }

                    // Lấy dữ liệu từ mỗi hàng
                    $name = $row['A'];
                    $description = $row['B'];
                    $image = $row['C'];

                    // Lưu dữ liệu vào cơ sở dữ liệu
                    $work_data = array(
                        'name' => $name,
                        'description' => $description,
                        // 'file' => $image // Nếu lưu ảnh dưới dạng base64 hoặc đường dẫn
                    );

                    $this->work->importExcel($work_data);
                }

                flashMessage('success', 'Import Successfully');
                redirect(base_url() . 'works');
            } catch (Exception $e) {
                flashMessage('error', 'Error import: ' . $e->getMessage());
                redirect(base_url() . 'works');
            }
        } else {
            flashMessage('warning', 'No file selected');
            redirect(base_url() . 'works');
        }
    }
}
