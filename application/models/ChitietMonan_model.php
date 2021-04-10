<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ChitietMonan_model extends QLNH_Model {

	public $database;

	public function __construct()
	{
		parent::__construct();
		$this->database = 'chitietMonan';
	}

}

/* End of file ChitietMonan_model.php */
/* Location: ./application/models/ChitietMonan_model.php */