<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu_model extends QLNH_Model {

	public $database;

	public function __construct()
	{
		parent::__construct();
		$this->database = 'menuOrder';
	}

}

/* End of file Menu_model.php */
/* Location: ./application/models/Menu_model.php */