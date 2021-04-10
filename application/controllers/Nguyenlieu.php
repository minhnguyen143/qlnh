<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nguyenlieu extends QLNH_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['temp']='Nguyenlieu';
		$this->load->view('template/layout',$data);
	}
	public function getList()
	{
		$tmp = $this->Nguyenlieu_model->getAll();
		$output = array("data" => $tmp);
		echo json_encode($output);

	}
	public function getOne()
	{
		$id = $this->input->post('id');
		$tmp = $this->Nguyenlieu_model->getOne(array('id' => $id));
		echo json_encode($tmp);
	}
	public function update()
	{
		$tmp = $this->input->post('data');
		$tmp = json_decode($tmp);
		$conditions = array(
			'id' => intval( $tmp->id)
		);
		unset($tmp->id);
		if ($this->Nguyenlieu_model->update($tmp, $conditions)) {
			echo 1;
		}
	}
	public function add()
	{
		$tmp = $this->input->post('data');
		$tmp = json_decode($tmp);
		// check trùng tenNguyenLieu
		$tmpUser = $this->Nguyenlieu_model->getOne(array('tenNguyenLieu' => $tmp->tenNguyenLieu));
		if (empty($tmpUser)) {
			if ($this->Nguyenlieu_model->addNew($tmp)) {
				echo 1;
			}
		}else{
			echo 2;
		}
		
	}
	public function delete()
	{
		$id = $this->input->post('id');
		$conditions = array(
			'id' => intval( $id)
		);
		
		if ($this->Nguyenlieu_model->delete( $conditions)) {
			echo 1;
		}
	}

	public function getSelect()
	{
		$conditions = array(
			'soLuong>' => 0
		);
		$rs = $this->Nguyenlieu_model->getAll($conditions);
		if ($rs) {
			foreach ($rs as $value) {
				$sub = array();
				$sub['id'] = $value->id;
				$sub['text'] = $value->tenNguyenLieu;
				$sub['title'] = $value->tenNguyenLieu;
                
				$arrRs[] = $sub;
			}
		}
		echo json_encode($arrRs);
	}
	
}

/* End of file Nguyenlieu.php */
/* Location: ./application/controllers/Nguyenlieu.php */