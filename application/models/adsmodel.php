<?php

Class Adsmodel extends CI_Model {

	function save_block($block, $ordered, $sources) {
		foreach ($ordered['blok'] as $order => $id) {
			if (is_numeric($id)) {
				$data = array('order'=>$order,
					'source'=>$sources[$id]['source'],
					'dur'=>$sources[$id]['dur']);
				$this->db->where('source_id',$id);
				$this->db->update('commercials',$data);

				if (!empty($sources[$id]['days'])) {
					$this->db->where('source_id',$id);
					$this->db->delete('commercials_days');
					foreach ($sources[$id]['days'] as $day => $blank) {
						$this->db->insert('commercials_days',array('source_id'=>$id,'day'=>$day));
					}
				}
			} else {
				$data = array('blok'=>$block,
					'order'=>$order,
					'source'=>$sources['new'][substr($id, 3)]['source'],
					'dur'=>$sources['new'][substr($id, 3)]['dur']);
				$this->db->insert('commercials',$data);
				$new_id = $this->db->insert_id();

				if (!empty($sources['new'][substr($id, 3)]['days'])) {
					foreach ($sources['new'][substr($id, 3)]['days'] as $day => $blank) {
						$this->db->insert('commercials_days',array('source_id'=>$new_id,'day'=>$day));
					}
				}
			}
		}
	}

	function get_block($block) {
		$this->db->order_by('order','asc');
		$block = $this->db->get_where('commercials',array('blok'=>$block))->result_array();

		foreach ($block as &$source) {
			$days = $this->db->get_where('commercials_days',array('source_id'=>$source['source_id']))->result_array();
			$source['days'] = array();
			foreach ($days as $day) $source['days'][$day['day']] = TRUE;
		}

		return $block;
	}

	function delete_source($id) {
		$this->db->where('source_id',$id);
		$this->db->delete('commercials');
	}
}