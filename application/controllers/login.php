<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	function Login() {
		parent::__Construct();
		$this->load->library('session');
		$this->load->model('usermodel');
		if ($this->session->userdata('logged')) {
			redirect('admin/dashboard');
		}
	}

	function index(){
		if ($this->input->post('username')) {
			if ($this->usermodel->checklogin($this->input->post('username'),$this->input->post('password'))) {
				$this->session->set_userdata('logged',true);
				redirect('admin/dashboard');
			}
		}
		$this->dwootemplate->display('admin/login.tpl');
	}
}