<?php if ( !defined('BASEPATH') ) exit();

Class Ads extends CI_Controller {

	function Ads() {
		parent::__Construct();

		$this->load->library('session');
		if ($this->session->userdata('logged') != '1') {
			redirect('admin');
		}

		$this->load->model('adsmodel');
	}

	function index() {
		$this->dwootemplate->display('admin/ads.tpl');
	}

	function edit($blok) {
		if ($blok > 5) redirect('admin/ads');
		if ($this->input->post('order')) {
			parse_str($this->input->post('order'), $order);
			$this->adsmodel->save_block($blok, $order, $this->input->post('source'));
			redirect('admin/ads/edit/'.$blok);
		}
		$this->dwootemplate->assign('sources',$this->adsmodel->get_block($blok));
		$this->dwootemplate->display('admin/ads_edit.tpl');
	}

	function delete() {
		$id = $this->input->get('id');
		if (!is_numeric($id)) exit();

		$this->adsmodel->delete_source($id);
	}

}