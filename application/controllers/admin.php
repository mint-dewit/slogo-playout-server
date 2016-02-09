<?php if (!defined('BASEPATH')) exit();

class Admin extends CI_Controller {
	function Admin() {
		parent::__Construct();

		$this->load->library('session');
		if ($this->session->userdata('logged') != '1') {
			redirect('admin');
		}
	}

	function index() {
		$this->dwootemplate->display('admin/dashboard.tpl');
	}

	function programmering() {
		$this->dwootemplate->display('admin/programmering.tpl');
	}

	function logout() {
		$this->session->unset_userdata('logged');
		redirect('admin');
	}
}