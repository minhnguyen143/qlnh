<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ChitietMenu_model extends QLNH_Model {

	public $database;

	public function __construct()
	{
		parent::__construct();
		$this->database = 'detail_menu';
	}

}

/* End of file ChitietMenu_model.php */
/* Location: ./application/models/ChitietMenu_model.php */