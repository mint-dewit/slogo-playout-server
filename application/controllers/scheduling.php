<?php if ( !defined('BASEPATH') ) exit();

Class Scheduling extends CI_Controller {

	function Programmering() {
		parent::__Construct();

		$this->load->library('session');
		if ($this->session->userdata('logged') != '1') {
			redirect('admin');
		}
	}

	function index() {
		$this->dwootemplate->display('admin/scheduling/main.tpl');
	}

	function edit() {
		$this->dwootemplate->display('admin/scheduling/edit.tpl');
	}

	function config() {
		$this->dwootemplate->display('admin/scheduling/config.tpl');
	}

}