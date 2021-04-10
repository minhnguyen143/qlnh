<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

date_default_timezone_set('Asia/Ho_Chi_Minh');

class QLNH_Controller extends CI_Controller {

    function __construct() {
    	parent::__construct();
        setlocale(LC_MONETARY, 'vi_VN');
        $this->load->config('uiConfig');
        //load model
        $this->load->model('Login_model');
        //checkk login
        $this->Login_model->check_login();

        $this->load->model('Order_model');
        $this->load->model('Nguyenlieu_model');
        $this->load->model('Monan_model');
        $this->load->model('Menu_model');
        $this->load->model('ChitietMonan_model');
        $this->load->model('ChitietMenu_model');
        $this->load->model('Nguoidung_model');
        
       
    }
    function unique_multidim_array($array, $key) {
        $temp_array = array();
        $i = 0;
        $key_array = array();
       
        foreach($array as $val) {
            if (!in_array($val[$key], $key_array)) {
                $key_array[$i] = $val[$key];
                $temp_array[$i] = $val;
            }
            $i++;
        }
        return $temp_array;
    }

    function groupDataByKey($array, $key){
        $result = array();
        foreach ($array as $element) {
            $result[$element->$key][] = $element;
        }
        return $result;
    }
    function upload_image()  
    {  
        if(isset($_FILES['hinh']))  
        {  
            $extension = explode('.', $_FILES['hinh']['name']);  
            $new_name = rand() . '.' . $extension[1];  
            $destination = '/home/qlnhahang/domains/qlnhahang.testprj.site/public_html/public/assets/images/products/' . $new_name;  
            move_uploaded_file($_FILES['hinh']['tmp_name'], $destination);  
            return $new_name;  
        }  
    } 

}
