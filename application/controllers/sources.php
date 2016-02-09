<?php if ( !defined('BASEPATH') ) exit();

Class Sources extends CI_Controller {

	function Sources() {
		parent::__Construct();

		$this->load->library('session');
		if ($this->session->userdata('logged') != '1') {
			redirect('admin');
		}

		$this->load->model('programmamodel');
	}

	function index() {
		if ($this->input->post('sources')) {
			$this->programmamodel->update_sourcelist($this->input->post('sources'));

			redirect('admin/sources');
		}
		$sources = $this->programmamodel->get_sourcelist();
		$this->dwootemplate->assign('sources',$sources);

		$this->dwootemplate->display('admin/source_list.tpl');
	}

	function delete() {
		$id = $this->input->get('id');

		if (!is_numeric($id)) exit();

		$this->programmamodel->delete_source($id);
	}

}