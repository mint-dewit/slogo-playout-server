<?php if ( !defined('BASEPATH') ) exit();

class Teksttv extends CI_Controller {

	function Teksttv() {
		parent::__Construct();

		$this->load->library('session');
		if ($this->session->userdata('logged') != '1') {
			redirect('admin');
		}

		$this->load->model('teksttvmodel');
		$this->load->model('templatemodel');
	}

	function index() {
		$this->dwootemplate->assign('templates',$this->teksttvmodel->get_templates());
		$this->dwootemplate->assign('playlist',$this->teksttvmodel->get_playlist());

		$this->dwootemplate->display('admin/teksttv.tpl');
	}

	function playlist($id) {
		$templates = array();
		foreach ($this->teksttvmodel->get_templates() as $template) $templates[$template['id']] = $template['title'];
		$this->dwootemplate->assign('templates',$templates);
		
		$templates_keys = $this->teksttvmodel->get_templates_with_keys();
		$this->dwootemplate->assign('templates_keys',$templates_keys);


		if (is_numeric($id)) {
			if ($this->input->post()) {
				$data = array();
				$data['dur'] = $this->input->post('dur');
				$data['title'] = $this->input->post('title');
				$data['template'] = $this->input->post('template');
				$data['period_start'] = $this->input->post('period_start');
				$data['period_end'] = $this->input->post('period_end');
				$this->teksttvmodel->update_item($id,$data);

				$this->teksttvmodel->update_values($id, $data['template'], $this->input->post('values'));
				redirect('admin/teksttv/playlist/'.$id);
			}

			$this->dwootemplate->assign('values',$this->teksttvmodel->get_values($id));
			$this->dwootemplate->assign('item',$this->teksttvmodel->get_item($id));
			$this->dwootemplate->display('admin/teksttv_edit/edit_item.tpl');
		} else {
			if ($this->input->post()) {
				$data = array();
				$data['dur'] = $this->input->post('dur');
				$data['title'] = $this->input->post('title');
				$data['template'] = $this->input->post('template');
				$data['period_start'] = $this->input->post('period_start');
				$data['period_end'] = $this->input->post('period_end');
				$insert_id = $this->teksttvmodel->insert_item($data);
				$this->teksttvmodel->update_values($insert_id, $data['template'], $this->input->post('values'));
				redirect('admin/teksttv/playlist/'.$insert_id);
			}

			$this->dwootemplate->display('admin/teksttv_edit/new_item.tpl');
		}
	}

	function delete($id) {
		$this->teksttvmodel->delete_item($id);
		redirect('admin/teksttv');
	}

	function templates() {
		$this->dwootemplate->assign('templates', $this->templatemodel->get_templates());
		$this->dwootemplate->display('admin/teksttv_edit/templates.tpl');
	}

	function update_list() {
		$list = array();
		foreach ($this->input->get('order') as $order => $id) {
			$list[$id] = $order;
		}
		$this->templatemodel->update_order($list);
	}

	function templates_edit($id) {
		if (is_numeric($id)) {
			if ($this->input->post()) {
				$this->templatemodel->update_template(array(
						'title'=>$this->input->post('title'),
						'color'=>$this->input->post('color')
					), $id);
				if ($this->input->post('fields')) {
					$this->templatemodel->update_fields($this->input->post('fields'), $id);
				}

				redirect('admin/templates/edit/'.$id);
			}
			$this->dwootemplate->assign('template',$this->templatemodel->get_template($id));
			$this->dwootemplate->display('admin/teksttv_edit/edit_template.tpl');
		} else {
			if ($this->input->post()) {
				$insert_id = $this->templatemodel->insert_template(array(
						'title'=>$this->input->post('title'),
						'color'=>$this->input->post('color')
					));
				if ($this->input->post('fields')) {
					$this->templatemodel->update_fields($this->input->post('fields'), $insert_id);
				}

				redirect('admin/templates/edit/'.$insert_id);
			}
			$this->dwootemplate->display('admin/teksttv_edit/new_template.tpl');
		}
	}

	function templates_delete() {
		$type = $this->input->get('type');
		$id = $this->input->get('id');
		$redirect = $this->input->get('redirect');

		if (!is_numeric($id)) die();

		if ($type == 'key') {
			$this->templatemodel->delete_key($id);
		} elseif ($type == 'template') {
			$this->templatemodel->delete_template($id);
		}

		if (!empty($redirect)) redirect($redirect);
	}

}