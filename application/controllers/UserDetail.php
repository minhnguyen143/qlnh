<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserDetail extends QLNH_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('OrderDetail_model');
	}

	public function index()
	{
		$data['totalOrder'] = $this->countOrder();
		$data['temp']='UserDetail';
		$this->load->view('template/layout',$data);
	}

	public function countOrder()
	{
		return $this->OrderDetail_model->count(array('idAccount' => $this->session->userdata('id')));
	}

}

/* End of file UserDetail.php */
/* Location: ./application/controllers/UserDetail.php */