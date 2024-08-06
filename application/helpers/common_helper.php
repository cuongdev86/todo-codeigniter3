<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('flashMessage')) {
    function flashMessage($type, $message = '')
    {
        $CI = &get_instance();
        $CI->session->set_flashdata('message_type', $type);
        $CI->session->set_flashdata('message', $message);
    }
}

if (!function_exists('encryptImage')) {
    function encryptImage($sourceFile, $destFile, $encryptionKey)
    {
        $ivLength = openssl_cipher_iv_length('AES-256-CBC');
        $iv = openssl_random_pseudo_bytes($ivLength);
        $key = hash('sha256', $encryptionKey, true);

        $imageData = file_get_contents($sourceFile);
        $encryptedData = openssl_encrypt($imageData, 'AES-256-CBC', $key, 0, $iv);

        if ($encryptedData === false) {
            throw new Exception('Encryption failed: ' . openssl_error_string());
        }

        $result = $iv . $encryptedData;
        file_put_contents($destFile, $result);
    }
}


if (!function_exists('decryptImage')) {
    function decryptImage($encryptedFile, $encryptionKey)
    {
        $arrContextOptions = array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
            ),
        );

        $ivLength = openssl_cipher_iv_length('AES-256-CBC');
        $key = hash('sha256', $encryptionKey, true);

        $encryptedData = file_get_contents($encryptedFile, false, stream_context_create($arrContextOptions));

        $iv = substr($encryptedData, 0, $ivLength);
        $ciphertext = substr($encryptedData, $ivLength);

        $decryptedData = openssl_decrypt($ciphertext, 'AES-256-CBC', $key, 0, $iv);

        if ($decryptedData === false) {
            throw new Exception('Decryption failed: ' . openssl_error_string());
        }

        return $decryptedData;
    }
}

if (!function_exists('base64DecryptImage')) {
    function base64DecryptImage($encryptedFile, $decryptionKey = null)
    {
        try {
            $decryptedData = $encryptedFile ? decryptImage($encryptedFile, $decryptionKey) : null;
            if (!$decryptedData)
                return 'data:image/jpeg;base64,' . base64_encode(file_get_contents('uploads/default/image-default.jpg'));

            $base64Image = base64_encode($decryptedData);
            return 'data:image/jpeg;base64,' . $base64Image; // Điều chỉnh kiểu MIME nếu cần
        } catch (Exception $e) {
            // echo "Error: " . $e->getMessage();
            return 'data:image/jpeg;base64,' . base64_encode(file_get_contents('uploads/default/image-default.jpg')); // Hình ảnh mặc định
        }
    }
}

if (!function_exists('base64ToImage')) {
    function base64ToImage($base64_string, $output_file)
    {
        $file = fopen($output_file, "wb");
        $data = explode(',', $base64_string);
        fwrite($file, base64_decode($data[1]));
        fclose($file);
        return $output_file;
    }
}
