<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nguoidung_model extends QLNH_Model {

	public $database;

	public function __construct()
	{
		parent::__construct();
		$this->database = 'taikhoan';
	}

}

/* End of file Nguoidung_model.php */
/* Location: ./application/models/Nguoidung_model.php */