<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends QLNH_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['temp']='Menu';
		$this->load->view('template/layout',$data);
	}
	public function getList()
	{
		$tmp = $this->Menu_model->getAll();
		for ($i = 0; $i < count($tmp) ; $i++) {
			//load món ăn
			$tmpMon = $this->ChitietMenu_model->getAll(array('idMenu' => $tmp[$i]->id));
			$arrMon = array();
			foreach ($tmpMon as $value) {
				$tmpCt = $this->Monan_model->getOne(array('id' => $value->idMon));
				$arrMon[] = $tmpCt['tenMon'];
			}
			$tmp[$i]->tenMon = $arrMon;
			$tmp[$i]->day = date('d-m-Y' , $tmp[$i]->day);
		}
		$output = array("data" => $tmp);
		echo json_encode($output);
	}
	public function add()
	{
		$tmp = $this->input->post('data');
		$tmp = json_decode($tmp);
		//convert to timestamp
		if (empty($tmp->day)) { // nếu ko nhập ngày mặc định lấy ngày hôm nay
			$tmp->day = date('d-m-Y', time());
		}
		$tmp->day = strtotime($tmp->day);

		$tmp2 = clone($tmp);
		unset($tmp->monan);
		$id = $this->Menu_model->addNew($tmp);
		//add item menu
		foreach ($tmp2->monan as $value) {
			$dataAdd = array(
				'idMenu' => $id,
				'idMon' => $value
			);
			$this->ChitietMenu_model->addNew($dataAdd);
		}
		echo 1;
	}
	public function delete()
	{
		echo 2;
	}

	public function getOne()
	{
		$id = $this->input->post('id');
		$tmp = $this->Menu_model->getOne(array('id' => $id));
		$tmp['day'] = date('d-m-Y' , $tmp['day']); 
		//get nguyen lieu
		$tmpNl = $this->ChitietMenu_model->getAll(array('idMenu' => $tmp['id']));
		foreach ($tmpNl as $value) {
			$tmp['monAn'][] = $value->idMon;	
		}
		
		echo json_encode($tmp);
	}
	public function update()
	{
		$tmp = $this->input->post('data');
		$tmp = json_decode($tmp);
		
		//kiểm tra chi tiết
		$arrReAdd = array();
		foreach ($tmp->monAn as $value) {
			$item = array(
				'idMenu' => $tmp->id,
				'idMon' => $value
			);
			$arrReAdd[] = $item;
		}
		// xoá trong chi tiết
		$this->ChitietMenu_model->delete(array('idMenu' => $tmp->id));
		if (!empty($arrReAdd)) {

			foreach ($arrReAdd as $itemReAdd) {
				$this->ChitietMenu_model->addNew($itemReAdd);
			}
		}
		// cập nhật menu
		$id = intval($tmp->id);
		unset($tmp->id);
		unset($tmp->monAn);
		$tmp->day = strtotime($tmp->day);
		
		$this->Menu_model->update( $tmp , array( 'id' => $id));
		echo 1;
	}

}

/* End of file Menu.php */
/* Location: ./application/controllers/Menu.php */