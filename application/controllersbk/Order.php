<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends QLNH_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('OrderDetail_model');
	}

	public function index()
	{
		$data['temp']='Order';
		
		$data['arrMon'] = $this->getList();
		$data['orderList'] = $this->getOrderList();
		
		$this->load->view('template/layout',$data);
	}

	public function getList()
	{
		// collect data
		$nextDay = strtotime(date('d-m-Y', time()+24*60*60));
		$menus = $this->Menu_model->getAll(array('day' => $nextDay));
		$arrMon = array();
		foreach ($menus as $menu) {
			//get list món
			$Mons = $this->ChitietMenu_model->getAll(array('idMenu'=>$menu->id));
			foreach ($Mons as $mon) {
				/// get info món
				$tmpMon = $this->Monan_model->getOne(array('id'=>$mon->idMon));
				$tmpMon['gia'] = money_format('%.0n', $tmpMon['gia']);
				$arrMon[] = $tmpMon;
			}
		}
		$arrMon = $this->unique_multidim_array($arrMon, 'tenMon');
		if (empty($arrMon)) {
			$retrunData = 'Chưa có thực đơn cho ngày mai!';	
		}else{
			$retrunData = $arrMon;
		}
		return $retrunData;
	}

	public function getOrderList()
	{
		$curUser = $this->session->userdata('id');
		$conditions = array(
			'idAccount' => $curUser
		);
		$tmp = $this->OrderDetail_model->getAll($conditions);
		return $tmp;

	}

	public function addOrder()
	{
		echo 1;
	}


}

/* End of file monan.php */
/* Location: ./application/controllers/monan.php */