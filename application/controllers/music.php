<?php if (!defined('BASEPATH')) exit();

class Music extends CI_Controller {

	function Music() {
		parent::__Construct();

		$this->load->library('session');
		if ($this->session->userdata('logged') != '1') {
			redirect('admin');
		}

		$this->load->model('playlistmodel');
		$this->load->model('livestreammodel');
	}

	function index() {
		$this->dwootemplate->assign('playlists',$this->playlistmodel->get_all_playlists());
		$this->dwootemplate->assign('streams',$this->livestreammodel->get_all_livestreams());
		$this->dwootemplate->display('admin/music_edit/music.tpl');
	}

	function playlist($id) {
		if (is_numeric($id)) {
			if ($this->input->post()) {
				$data = array(
					'name'=>$this->input->post('name')
				);
				$this->playlistmodel->update_playlist($id,$data);
				if ($this->input->post('days')) $this->playlistmodel->update_days($id,$this->input->post('days'));
				if ($this->input->post('times')) $this->playlistmodel->update_times($id,$this->input->post('times'));
				if ($this->input->post('periods')) $this->playlistmodel->update_periods($id,$this->input->post('periods'));
				if ($this->input->post('sources')) $this->playlistmodel->update_sources($id,$this->input->post('sources'));

				redirect('admin/music/playlist/'.$id);
			};

			$playlist = $this->playlistmodel->get_playlist($id);
			$this->dwootemplate->assign('playlist',$playlist);
			$this->dwootemplate->display('admin/music_edit/playlist.tpl');
		} elseif ($id == 'new') {
			if ($this->input->post()) {
				$data = array(
					'name'=>$this->input->post('name')
				);
				$insert_id = $this->playlistmodel->insert_playlist($data);
				if ($this->input->post('days')) $this->playlistmodel->update_days($insert_id,$this->input->post('days'));
				if ($this->input->post('times')) $this->playlistmodel->update_times($insert_id,$this->input->post('times'));
				if ($this->input->post('periods')) $this->playlistmodel->update_periods($insert_id,$this->input->post('periods'));
				if ($this->input->post('sources')) $this->playlistmodel->update_sources($insert_id,$this->input->post('sources'));

				redirect('admin/music/playlist/'.$insert_id);
			}

			$this->dwootemplate->display('admin/music_edit/new_playlist.tpl');
		}
	}

	function livestream($id) {
		if (is_numeric($id)) {
			if ($this->input->post()) {
				$data = array(
					'name'=>$this->input->post('name'),
					'source'=>$this->input->post('source')
				);
				$this->livestreammodel->update_livestream($id,$data);
				if ($this->input->post('days')) $this->livestreammodel->update_days($id,$this->input->post('days'));
				if ($this->input->post('times')) $this->livestreammodel->update_times($id,$this->input->post('times'));
				if ($this->input->post('periods')) $this->livestreammodel->update_periods($id,$this->input->post('periods'));
				if ($this->input->post('sources')) $this->livestreammodel->update_sources($id,$this->input->post('sources'));

				redirect('admin/music/livestream/'.$id);
			};

			$livestream = $this->livestreammodel->get_livestream($id);
			$this->dwootemplate->assign('livestream',$livestream);
			$this->dwootemplate->display('admin/music_edit/stream.tpl');
		} elseif ($id == 'new') {
			if ($this->input->post()) {
				$data = array(
					'name'=>$this->input->post('name'),
					'source'=>$this->input->post('source')
				);
				$insert_id = $this->livestreammodel->insert_livestream($data);
				if ($this->input->post('days')) $this->livestreammodel->update_days($insert_id,$this->input->post('days'));
				if ($this->input->post('times')) $this->livestreammodel->update_times($insert_id,$this->input->post('times'));
				if ($this->input->post('periods')) $this->livestreammodel->update_periods($insert_id,$this->input->post('periods'));
				if ($this->input->post('sources')) $this->livestreammodel->update_sources($insert_id,$this->input->post('sources'));

				redirect('admin/music/livestream/'.$insert_id);
			}

			$this->dwootemplate->display('admin/music_edit/new_stream.tpl');
		}
	}

	function delete() {
		$type = $this->input->get('type');
		$id = $this->input->get('id');
		$redirect = $this->input->get('redirect');

		if (!is_numeric($id)) die();

		if ($type == 'playlist_time') {
			$this->playlistmodel->delete_time($id);
		} elseif ($type == 'playlist_period') {
			$this->playlistmodel->delete_period($id);
		} elseif ($type == 'playlist_source') {
			$this->playlistmodel->delete_source($id);
		} elseif ($type == 'playlist') {
			$this->playlistmodel->delete_playlist($id);
		} elseif ($type == 'livestream_time') {
			$this->livestreammodel->delete_time($id);
		} elseif ($type == 'livestream_period') {
			$this->livestreammodel->delete_period($id);
		} elseif ($type == 'livestream_source') {
			$this->livestreammodel->delete_source($id);
		} elseif ($type == 'livestream') {
			$this->livestreammodel->delete_livestream($id);
		}

		if (!empty($redirect)) redirect($redirect);
	}
}