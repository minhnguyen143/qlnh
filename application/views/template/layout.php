<?php 
	$data['info'] = $this->config->item('info');
    $data['nav'] = $this->config->item('primary_nav');
    $curUrl = strtolower($this->uri->segment(1));
    $data['curPage'] = 'Quản lý nhà hàng';
    foreach ($data['nav'] as $value) {
    	if ($value['url'] == base_url($curUrl)) {
    		$data['curPage'] = $value['nameDisplay'];
    	}
    }
	$this->load->view('template/header',$data);
	$this->load->view($temp);
	$this->load->view('template/footer',$data);
 ?>