<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Monan_model extends QLNH_Model {

	public $database;

	public function __construct()
	{
		parent::__construct();
		$this->database = 'monan';
	}

}

/* End of file Monan_model.php */
/* Location: ./application/models/Monan_model.php */