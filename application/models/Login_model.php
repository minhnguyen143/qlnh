<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends QLNH_Model {

	public $database;

	public function __construct()
	{
		parent::__construct();
		$this->database = 'taikhoan';
	}
	public function check_login(){
		if ($this->session->userdata('isLogin')== true) {
        	return true;
        }else{

        	redirect(base_url('login'));
        }
	}


}

/* End of file Login_model.php */
/* Location: ./application/models/Login_model.php */