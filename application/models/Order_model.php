<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order_model extends QLNH_Model {

	public $database;

	public function __construct()
	{
		parent::__construct();
		$this->database = 'order-detail';
	}

}

/* End of file Order_model.php */
/* Location: ./application/models/Order_model.php */