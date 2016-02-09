<?php if ( !defined('BASEPATH') ) exit();

Class Programmering extends CI_Controller {

	function Programmering() {
		parent::__Construct();

		$this->load->library('session');
		if ($this->session->userdata('logged') != '1') {
			redirect('admin');
		}

		$this->load->model('programmamodel');
	}

	function index(){
		$this->dwootemplate->assign('programmas',$this->programmamodel->get_all_programmas());
		$this->dwootemplate->assign('categories',$this->programmamodel->get_all_categories());
		$this->dwootemplate->display('admin/programmering.tpl');
	}

	function edit($id){
		$cats = $this->programmamodel->get_all_categories();
		$new_cats = array();
		foreach ($cats as $cat) $new_cats[$cat['category_id']] = $cat['name'];
		$this->dwootemplate->assign('categories',$new_cats);


		if (is_numeric($id)) {
			if ($this->input->post()) {
				$data = array(
					'Naam' => $this->input->post('name'),
					'Priority' => $this->input->post('priority'),
					'category' => $this->input->post('category')
				);
				$this->programmamodel->update_programme($id,$data);
				redirect('admin/programmering/edit/'.$id);
			}
			$programma = $this->programmamodel->get_programme_data($id);
			$this->dwootemplate->assign('programme_data',$programma);

			$this->dwootemplate->display('admin/programma_edit/programma.tpl');
		}
		elseif ($id == 'new') {
			if ($this->input->post()) {
				$data = array(
					'Naam' => $this->input->post('name'),
					'Priority' => $this->input->post('priority'),
					'category' => $this->input->post('category')
				);
				$insert_id = $this->programmamodel->insert_programme($data);

				redirect('admin/programmering/edit/'.$insert_id);
			}
			$this->dwootemplate->display('admin/programma_edit/new_programma.tpl');
		}
	}

	function episode($programme,$episode) {
		$programma = $this->programmamodel->get_programme_data($programme,$episode);
		$this->dwootemplate->assign('programme_data',$programma);

		$this->load->model('teksttvmodel');
		$templates = array();
		foreach ($this->teksttvmodel->get_templates() as $template) $templates[$template['id']] = $template['title'];
		$this->dwootemplate->assign('templatelist',$templates);

		$templates_keys = $this->teksttvmodel->get_templates_with_keys();
		$this->dwootemplate->assign('templates_keys',$templates_keys);

		$sourcelist = $this->programmamodel->get_sourcelist();
		$sources = array();
		foreach ($sourcelist as $source) {
			$sources[$source['source_id']] = $source['source'];
		}
		$this->dwootemplate->assign('sourcelist',$sources);

		if (is_numeric($episode)) {
			if ($this->input->post()) {
				print_r($this->input->post());
				$data = array(
					'episode_title'=>$this->input->post('title'),
					'episode_number'=>$this->input->post('number')
				);
				$this->programmamodel->update_episode($episode,$data);
				if ($this->input->post('days')) $this->programmamodel->update_days($episode,$this->input->post('days'));
				if ($this->input->post('times')) $this->programmamodel->update_times($episode,$this->input->post('times'));
				if ($this->input->post('periods')) $this->programmamodel->update_periods($episode,$this->input->post('periods'));
				if ($this->input->post('sources')) $this->programmamodel->update_sourcelinks($episode,$this->input->post('sources'));

				//redirect('admin/programmering/'.$programme.'/episode/'.$episode);
			};
			//print_r($programma);

			$this->dwootemplate->display('admin/programma_edit/episode.tpl');
		}
		elseif ($episode == 'new') {
			if ($this->input->post()) {
				$data = array(
					'episode_title'=>$this->input->post('title'),
					'episode_number'=>$this->input->post('number'),
					'programme_id'=>$programme
				);
				$insert_id = $this->programmamodel->insert_episode($data);
				if ($this->input->post('days')) $this->programmamodel->update_days($insert_id,$this->input->post('days'));
				if ($this->input->post('times')) $this->programmamodel->update_times($insert_id,$this->input->post('times'));
				if ($this->input->post('periods')) $this->programmamodel->update_periods($insert_id,$this->input->post('periods'));
				if ($this->input->post('sources')) $this->programmamodel->update_sourcelinks($insert_id,$this->input->post('sources'));

				redirect('admin/programmering/'.$programme.'/episode/'.$insert_id);
			}
			$this->dwootemplate->display('admin/programma_edit/new_episode.tpl');
		}
	}

	function delete() {
		$type = $this->input->get('type');
		$id = $this->input->get('id');
		$redirect = $this->input->get('redirect');

		if (!is_numeric($id)) die();

		if ($type == 'time') {
			$this->programmamodel->delete_time($id);
		} elseif ($type == 'period') {
			$this->programmamodel->delete_period($id);
		} elseif ($type == 'source') {
			$this->programmamodel->delete_sourcelink($id);
		} elseif ($type == 'html') {
			$this->programmamodel->delete_html($id);
		} elseif ($type == 'programma') {
			$this->programmamodel->delete_programme($id);
		} elseif ($type == 'episode') {
			$this->programmamodel->delete_episode($id);
		}

		if (!empty($redirect)) redirect($redirect);
	}

	function duplicate() {
		$id = $this->input->get('id');
		$programme_id = $this->input->get('programme');

		if (!is_numeric($id)) die();

		$new_id = $this->programmamodel->duplicate_episode($id);
		redirect('admin/programmering/'.$programme_id."/episode/".$new_id); 
	}
}

/* End of file */