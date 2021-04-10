<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Monan extends QLNH_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['temp']='Monan';
		$this->load->view('template/layout',$data);
	}

	public function getList()
	{
		$tmp = $this->Monan_model->getAll();
		for ($i = 0; $i < count($tmp) ; $i++) {
			//get nguyên liệu
			$tmpNl = $this->ChitietMonan_model->getAll(array('idMonan' => $tmp[$i]->id));
			$arrNl = array();
			foreach ($tmpNl as $value) {
				$tmpCT = $this->Nguyenlieu_model->getOne(array('id' => $value->idNguyenLieu));
				$arrNl[] = $tmpCT['tenNguyenLieu'];
			}
			$tmp[$i]->nguyenLieu = $arrNl;
		}
		$output = array("data" => $tmp);
		echo json_encode($output);
	}

	public function getSelect()
	{
		$conditions = array(
			'soLuong>' => 0
		);
		$rs = $this->Monan_model->getAll($conditions);
		if ($rs) {
			foreach ($rs as $value) {
				$sub = array();
				$sub['id'] = $value->id;
				$sub['text'] = $value->tenMon;
				$sub['title'] = $value->tenMon;
                
				$arrRs[] = $sub;
			}
		}
		echo json_encode($arrRs);
	}

	public function add()
	{
		//$tmp = $this->input->post('formData');

		$hinh = $this->upload_image();
		if (empty($hinh)) {
			echo 2;
			return;
		}
		$tmp = $this->input->post();
		$tmp['hinh'] = $hinh;
		$nguyenLieu = $tmp['nguyenLieu'];
		$nguyenLieu = explode(',', $nguyenLieu);
		$tmp2 = clone((object)$tmp);
		unset($tmp['nguyenLieu']);
	
		// check trùng mosn
		$tmpMon = $this->Monan_model->getOne(array('tenMon' => $tmp['tenMon']));
		if (empty($tmpMon)) {
			
			//chuẩn bị data để update và insert
			$arrDetail = array();
			foreach ($nguyenLieu as $value) {
				//kiểm tra số lượng
				$tmpNl = $this->Nguyenlieu_model->getOne(array('id' => $value));
				if ($tmpNl['soLuong'] < $tmp['soluong']) {
					echo 3;
					return;
				}
				$dataDetail = array(
					'idNguyenLieu' => $value,
					'soLuong' => $tmp['soluong'],
					'soLuongTru' => $tmpNl['soLuong'] -  $tmp['soluong']
				);
				$arrDetail[] = $dataDetail;
			}

			//insert và update
			$id = $this->Monan_model->addNew($tmp);
			foreach ($arrDetail as $item) {
				//update
				$item['idMonan'] = $id;
				$this->Nguyenlieu_model->update( array('soLuong' => $item['soLuongTru']), array( 'id' => $item['idNguyenLieu']) );
				unset($item['soLuongTru']);
				$this->ChitietMonan_model->addNew($item);
			}
			echo 1;
		}else{
			echo 2;
		}
		
	}
	public function getOne()
	{
		$id = $this->input->post('id');
		$tmp = $this->Monan_model->getOne(array('id' => $id));
		//get nguyen lieu
		$tmpNl = $this->ChitietMonan_model->getAll(array('idMonan' => $tmp['id']));
		foreach ($tmpNl as $value) {
			$tmp['nguyenlieu'][] = $value->idNguyenLieu;	
		}
		
		echo json_encode($tmp);
	}

	public function update()
	{
		$tmp = $this->input->post('data');
		$tmp = json_decode($tmp);
		
		$tmp2 = clone($tmp);
		unset($tmp->nguyenlieu);

		$conditions = array(
			'id' => intval( $tmp->id)
		);
		unset($tmp->id);
		//chuẩn bị data để update 
		$arrUpdate = array();
		$arrAdd = array();
		foreach ($tmp2->nguyenlieu as $value) {
			//kiểm tra số lượng
			$tmpNl = $this->Nguyenlieu_model->getOne(array('id' => $value));
			$conditionsCt = array(
				'idNguyenLieu' => $value,
				'idMonan' => $tmp2->id
			);
			$tmpCt = $this->ChitietMonan_model->getOne($conditionsCt);
			$chenhLech = 0;
			if (!empty($tmpCt)) {
				
				if ($tmp2->soluong > $tmpCt['soLuong']) {
					// kiểm tra coi sl nguyên liệu còn đủ cho cái số lớn kia ko
					if ($tmpNl['soLuong'] < ($tmp2->soluong - $tmpCt['soLuong'])) {
						echo 3;
						return;
					}else{
						$chenhLech = $tmp2->soluong - $tmpCt['soLuong'];
					}
				}elseif ($tmp2->soluong < $tmpCt['soLuong']){
					$chenhLech = $tmp2->soluong - $tmpCt['soLuong'];
				}
			}else{
				// chưa có thì thêm
				// //kiểm tra số lượng
				$tmpNl = $this->Nguyenlieu_model->getOne(array('id' => $value));
				if ($tmpNl['soLuong'] < $tmp->soluong) {
					echo 3;
					return;
				}
				$dataAdd = array(
					'idNguyenLieu' => $value,
					'soLuong' => $tmp->soluong,
					'soLuongTru' => $tmpNl['soLuong'] - $tmp->soluong
				);
				$arrAdd[] = $dataAdd;
			}
			
			$dataUpdate = array(
				'idNguyenLieu' => $value,
				'soLuong' => $tmp->soluong,
				'id' => $tmpCt['id'],
				'soLuongMoi' => $tmpNl['soLuong'] - $chenhLech
			);
			$arrUpdate[] = $dataUpdate;
		}

		// => update phần chi tiết và nguyên liệu
		if (!empty($arrUpdate)) {
			foreach ($arrUpdate as $item) {
				$conditionsCtUpdate = array('id' => $item['id']);
				unset($item['id']);
				// điểu chỉnh số lượng của nguyên liệu
				$this->Nguyenlieu_model->update(array('soLuong' => $item['soLuongMoi']), array('id' => $item['idNguyenLieu']));
				//update chi tiếtt
				unset($item['soLuongMoi']);
				$this->ChitietMonan_model->update($item, $conditionsCtUpdate);
			}
		}
		// add thêm nguyên liệu
		if (!empty($arrAdd)) {
			foreach ($arrAdd as $itemAdd) {
				//update
				$itemAdd['idMonan'] = $tmp2->id;
				$this->Nguyenlieu_model->update( array('soLuong' => $itemAdd['soLuongTru']), array( 'id' => $itemAdd['idNguyenLieu']) );
				unset($itemAdd['soLuongTru']);
				$this->ChitietMonan_model->addNew($itemAdd);
			}
		}
		//cập nhật món ăn
		unset($tmp->nguyenlieu);
		if ($this->Monan_model->update($tmp, array('id' => $tmp2->id))) {
			echo 1;
		}else{
			echo 2;
		}
	}
	public function resetSoLuong()
	{
		$id = $this->input->post('id');
		$conditions = array(
			'id' => intval( $id)
		);
		
		if ($this->Monan_model->update(array('soLuong'=> 0) ,$conditions)) {
			echo 1;
		}
	}
	public function delete()
	{
		echo 2;
	}

}

/* End of file Monan.php */
/* Location: ./application/controllers/Monan.php */