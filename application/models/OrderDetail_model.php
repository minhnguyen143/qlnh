<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class OrderDetail_model extends QLNH_Model {

	public $database;

	public function __construct()
	{
		parent::__construct();
		$this->database = 'order-detail';
	}

}

/* End of file OrderDetail_model.php */
/* Location: ./application/models/OrderDetail_model.php */