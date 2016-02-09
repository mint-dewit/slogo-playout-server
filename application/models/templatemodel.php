<?php

Class Templatemodel extends CI_Model {

	function get_templates() {
		return $this->db->get('texttv_templates')->result_array();
	}

	function get_template($id) {
		$this->db->where('id',$id);
		$data = $this->db->get('texttv_templates')->row_array();
		$data['keys'] = $this->db->get_where('texttv_keys',array('template_id'=>$id))->result_array();
		return $data;
	}

	function insert_template($data) {
		$this->db->insert('texttv_templates',$data);
		return $this->db->insert_id();
	}

	function update_template($data, $id) {
		$this->db->where('id',$id);
		$this->db->update('texttv_templates',$data);
	}

	function update_fields($data, $id) {
		foreach ($data as $field_id => $field) {
			if (is_numeric($field_id)) {
				if (!empty($field['WYSIWYG'])) {
					$field['WYSIWYG'] = 1;
				} else {
					$field['WYSIWYG'] = 0;
				}
				$this->db->where('key_id',$field_id);
				$this->db->update('texttv_keys',$field);
			} else {
				foreach ($field as $new_field) {
					if (!empty($new_field['WYSIWYG'])) {
						$new_field['WYSIWYG'] = 1;
					} else {
						$new_field['WYSIWYG'] = 0;
					}
					$this->db->insert('texttv_keys',array('template_id'=>$id, 'key_name'=>$new_field['key_name'], 'WYSIWYG'=>$new_field['WYSIWYG']));
				}
			}
		}
	}

	function delete_key($id) {
		$this->db->where('key_id',$id);
		$this->db->delete('texttv_keys');
	}

	function delete_template($id) {
		$this->db->where('template_id',$id);
		$this->db->delete('texttv_keys');

		$this->db->where('id',$id);
		$this->db->delete('texttv_templates');
	}

	function update_order($list) {
		foreach ($list as $id => $order) {
			$this->db->where('id',$id);
			$this->db->update('texttv_playlist', array('order'=>$order));
		}
	}

}