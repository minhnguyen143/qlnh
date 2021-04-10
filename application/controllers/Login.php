<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('isLogin') == true) {
			redirect(base_url(),'refresh');
		}
		$this->load->model('Login_model');
		if ($this->input->post('login-username') && $this->input->post('login-password')) {
            $dataLogin = array(
            	'username' => $this->input->post('login-username'),
            	'password' => $this->input->post('login-password')
            );

            $login = $this->Login_model->getOne($dataLogin);
            if (!empty($login)) {
                $login['isLogin'] = true;
                $this->session->set_userdata( $login );
                redirect(base_url(),'refresh');
            }
        }
	}

	public function index()
	{
		$this->load->view('template/login');
	}
	public function login()
	{
		
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url());
	}
}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */