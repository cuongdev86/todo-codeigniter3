<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class ExcelController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('work');
        $this->load->helper('url');
    }


    public function export_excel_works()
    {
        // Lấy dữ liệu từ model
        $data = $this->work->getListExport();

        // Tạo một đối tượng Spreadsheet mới
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Thiết lập tiêu đề cột
        $sheet->setCellValue('A1', 'Name');
        $sheet->setCellValue('B1', 'Description');
        // Thêm tiêu đề cột khác nếu cần...

        // Điền dữ liệu vào các ô
        $row = 2;
        foreach ($data as $datum) {
            $sheet->setCellValue('A' . $row, $datum['name']);
            $sheet->setCellValue('B' . $row, $datum['description']);



            $fileEnc = $datum['file'];
            $imageData = base64DecryptImage($datum['file'], 'work-encrypt-image'); //base64
            $imagePath = 'uploads/exports/image_' . $row . '_' . uniqid() . '.jpg'; // Đường dẫn để lưu hình ảnh
            base64ToImage($imageData, $imagePath);

            // Thêm hình ảnh vào ô C
            $drawing = new Drawing();
            $drawing->setName('Image');
            $drawing->setDescription('Image');
            $drawing->setPath($imagePath);
            $drawing->setHeight(50); // Chiều cao của hình ảnh
            $drawing->setCoordinates('C' . $row);
            $drawing->setWorksheet($sheet);


            $row++;
        }

        // Đặt tên file và xuất file Excel
        $filename = 'Export_work_' . date('Ymd') . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
}
