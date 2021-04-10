<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nguyenlieu_model extends QLNH_Model {

	public $database;

	public function __construct()
	{
		parent::__construct();
		$this->database = 'nguyenlieu';
		
	}

}

/* End of file Nguyenlieu_model.php */
/* Location: ./application/models/Nguyenlieu_model.php */