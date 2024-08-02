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
