<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends QLNH_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->session->sess_destroy();
		redirect(base_url());
	}

	public function index()
	{
		
	}

}

/* End of file Logout.php */
/* Location: ./application/controllers/Logout.php */