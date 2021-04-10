<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nguoidung extends QLNH_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['temp']='Nguoidung';
		$this->load->view('template/layout',$data);
	}
	public function getList()
	{
		$tmp = $this->Nguoidung_model->getAll();
		$output = array("data" => $tmp);
		echo json_encode($output);
	}

	public function getOne()
	{
		$id = $this->input->post('id');
		$tmp = $this->Nguoidung_model->getOne(array('id' => $id));
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
		if ($this->Nguoidung_model->update($tmp, $conditions)) {
			echo 1;
		}
	}

	public function add()
	{
		$tmp = $this->input->post('data');
		$tmp = json_decode($tmp);
		$tmp->password = '123456';
		// check trùng user
		$tmpUser = $this->Nguoidung_model->getOne(array('username' => $tmp->username));
		if (empty($tmpUser)) {
			if ($this->Nguoidung_model->addNew($tmp)) {
				echo 1;
			}
		}else{
			echo 2;
		}
		
	}

	public function resetPwd()
	{
		$id = $this->input->post('id');
		$conditions = array(
			'id' => intval( $id)
		);
		
		if ($this->Nguoidung_model->update(array('password'=> '123456'), $conditions)) {
			echo 1;
		}
	}
	public function delete()
	{
		$id = $this->input->post('id');
		$conditions = array(
			'id' => intval( $id)
		);
		
		if ($this->Nguoidung_model->delete( $conditions)) {
			echo 1;
		}
	}
	public function changePass()
	{
		$old = $this->input->post('old');
		$new = $this->input->post('new');
		$conditions = array(
			'id' => intval($this->session->userdata('id'))
		);
		if ($old != $this->session->userdata('password')) {
			echo 2;
			return;
		}else{
			if ($this->Nguoidung_model->update(array('password'=> $new), $conditions)) {
				echo 1;
			}
		}
	}
}

/* End of file NguoiDung.php */
/* Location: ./application/controllers/NguoiDung.php */