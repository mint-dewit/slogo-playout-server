<?php

class Teksttvmodel extends CI_Model {

	function get_templates() {
		return $this->db->get('texttv_templates')->result_array();
	}

	function get_playlist() {
		$this->db->select('texttv_playlist.*,texttv_templates.color');
		$this->db->order_by('order');
		$this->db->join('texttv_templates','texttv_templates.id = texttv_playlist.template');
		return $this->db->get('texttv_playlist')->result_array();
	}

	function insert_item($data) {
		$this->db->insert('texttv_playlist',$data);
		return $this->db->insert_id();
	}

	function get_item($id) {
		return $this->db->get_where('texttv_playlist',array('id'=>$id))->row_array();
	}

	function update_item($id,$data) {
		$this->db->where('id',$id);
		$this->db->update('texttv_playlist',$data);
	}

	function delete_item($id) {
		$this->db->delete('texttv_playlist',array('id'=>$id));
		$this->db->delete('texttv_values',array('playlistitem_id'=>$id));
	}

	function get_templates_with_keys() {
		$templates = $this->db->get('texttv_templates')->result_array();

		foreach ($templates as &$template) {
			$template['keys'] = $this->db->get_where('texttv_keys',array('template_id'=>$template['id']))->result_array();
		}

		return $templates;
	}

	function get_values($id) {
		$result = $this->db->get_where('texttv_values',array('playlistitem_id'=>$id))->result_array();

		$values = array();
		foreach ($result as $value) {
			$values[$value['key_id']] = $value['value'];
		}

		return $values;
	}

	function update_values($id, $template, $data) {
		if (!empty($data[$template])) {
			$this->db->delete('texttv_values', array('playlistitem_id'=>$id));

			$batch = array();
			foreach ($data[$template] as $key => $item) {
				$batch[] = array(
					'playlistitem_id'=>$id,
					'key_id'=>$key,
					'template_id'=>$template,
					'value'=>$item);
			}

			$this->db->insert_batch('texttv_values',$batch);
		}
	}

}