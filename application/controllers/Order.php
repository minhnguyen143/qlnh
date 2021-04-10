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
		//$data['orderList'] = $this->getOrderList();
		
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
				$tmpMon['idMenu'] = $menu->id;
				$tmpMon['hinh'] = !empty($tmpMon['hinh']) ? $tmpMon['hinh'] : 'monan.jpg';
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
		$idMon = $this->input->post('id');
		$idMenu = $this->input->post('idMenu');
		$dataOrder = array(
			'idMon' => $idMon,
			'idMenu' => $idMenu,
			'idAccount' => $this->session->userdata('id'),
			'dayOrder' => strtotime( date( 'd-m-Y' , time() ) )
		);
		$this->OrderDetail_model->addNew($dataOrder);
		// trừ số trong món ăn
		$tmpMon = $this->Monan_model->getOne(array('id' => $idMon));
		$sl = $tmpMon['soLuong'] -1;
		$this->Monan_model->update(array('soLuong'=>$sl ), array('id' => $idMon));
		echo 1;
	}

	public function listOrder()
	{
		$data['temp']='ListOrder';	
		$this->load->view('template/layout',$data);
	}
	public function getListOrder()
	{
		$curUser = $this->session->userdata('id');
		$conditions = array(
			'idAccount' => $curUser
		);
		$tmp = $this->OrderDetail_model->getAll($conditions);
		$arrData =array();
		
		///
		$tmp2 = $this->groupDataByKey($tmp, 'idMon');
		$count = 1;
		foreach ($tmp2 as $key => $value) {
			//get info món ăn
			$tmpMon = $this->Monan_model->getOne(array('id' => $key));
			$sub = array(
				'id' => $tmpMon['id'],
				'count' => $count++,
				'hinh' => !empty($tmpMon['hinh']) ? $tmpMon['hinh'] : 'monan.jpg',
				'tenMon' => $tmpMon['tenMon'],
				'gia' => $tmpMon['gia'],
				'soLuong' => count($value),
				'tong' => $tmpMon['gia'] *count($value),
				'dayOrder' => date('d-m-Y', $value[0]->dayOrder),
				'idMenu' => $value[0]->idMenu
			);
			$arrData[] = $sub;
		}
		$output = array("data" => $arrData);
		echo json_encode($output);
	}
	public function reportOrder()
	{
		$data['temp']='ReportOrder';	
		$this->load->view('template/layout',$data);
	}
	public function getListReportOrder()
	{
		$tmp = $this->OrderDetail_model->getAll();
		$arrData =array();
		
		///
		$tmp2 = $this->groupDataByKey($tmp, 'idMon');
		$count = 1;
		foreach ($tmp2 as $key => $value) {
			//get info món ăn
			$tmpMon = $this->Monan_model->getOne(array('id' => $key));
			//get info user
			$tmpUser = $this->Nguoidung_model->getOne(array('id' => $value[0]->idAccount));
			$sub = array(
				'count' => $count++,
				'user' => $tmpUser['fullName'],
				'hinh' => 'monan.jpg',
				'tenMon' => $tmpMon['tenMon'],
				'gia' => $tmpMon['gia'],
				'soLuong' => count($value),
				'tong' => $tmpMon['gia'] *count($value),
				'dayOrder' => date('d-m-Y', $value[0]->dayOrder)
			);
			$arrData[] = $sub;
		}
		$output = array("data" => $arrData);
		echo json_encode($output);
	}

	public function delete()
	{
		$conditions = array(
			'idMenu' => $this->input->post('idMenu'),
			'idMon' => $this->input->post('idMon'),
			'idAccount' => $this->session->userdata('id')
		);
		//trả lại số lượng cho món ăn
		$tmpMon = $this->Monan_model->getOne(array('id' =>  $this->input->post('idMon')));
		$soLuongMoi = $tmpMon['soLuong'] + $this->input->post('soLuong');
		$this->Monan_model->update(array('soLuong' => $soLuongMoi), array('id' => $this->input->post('idMon')));

		//xoá món ăn ra khõi order detail
		$this->OrderDetail_model->delete($conditions);
		echo 1;
	}
}

/* End of file monan.php */
/* Location: ./application/controllers/monan.php */