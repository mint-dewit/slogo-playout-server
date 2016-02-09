<?php

class Livestreammodel extends CI_Model {

	function insert_livestream($data)
	{
		$this->db->insert('livestreams',$data);
		return $this->db->insert_id();
	}

	function update_livestream($id, $data)
	{
		$this->db->where('livestream_id',$id);
		$this->db->update('livestreams',$data);
	}

	function update_days($id, $days)
	{
		$this->db->delete('livestreams_days',array('livestream_id'=>$id));
		foreach ($days as $day => $none) {
			$this->db->insert('livestreams_days',array('livestream_id'=>$id,'day'=>$day));
		}
	}

	function update_times($id, $times) {
		foreach ($times as $time_id => $time) {
			if ($time_id != 'new') {
				$this->db->where('time_id',$time_id);
				$this->db->update('livestreams_times',array('start'=>$time['start'],'end'=>$time['end']));
			} else {
				foreach ($time as $new_time) {
					$this->db->insert('livestreams_times',array('start'=>$new_time['start'],'end'=>$new_time['end'],'livestream_id'=>$id));
				}
			}
		}
	}

	function update_periods($id, $periods) {
		foreach ($periods as $period_id => $period) {
			if ($period_id != 'new') {
				$this->db->where('period_id',$period_id);
				$this->db->update('livestreams_periods',array('start'=>$period['start'],'end'=>$period['end']));
			} else {
				foreach ($period as $new_period) {
					$this->db->insert('livestreams_periods',array('start'=>$new_period['start'],'end'=>$new_period['end'],'livestream_id'=>$id));
				}
			}
		}
	}

	function get_all_livestreams() {
		return $this->db->get('livestreams')->result_array();
	}

	function get_livestream($id) {
		$livestream = $this->db->get_where('livestreams',array('livestream_id'=>$id))->row_array();

		$days = $this->db->get_where('livestreams_days',array('livestream_id'=>$id))->result_array();
		$livestream['days'] = array();
		foreach ($days as $day) $livestream['days'][$day['day']] = TRUE;
		// get times
		$livestream['times'] = $this->db->get_where('livestreams_times',array('livestream_id'=>$id))->result_array();
		// get periods
		$livestream['periods'] = $this->db->get_where('livestreams_periods',array('livestream_id'=>$id))->result_array();

		return $livestream;
	}

	function delete_livestream($id) {
		$this->db->where('livestream_id',$id);
		$this->db->delete('livestreams');

		$this->db->where('livestream_id',$id);
		$this->db->delete('livestreams_periods');
	}

	function delete_time($id) {
		$this->db->where('time_id',$id);
		$this->db->delete('livestreams_times');
	}

	function delete_period($id) {
		$this->db->where('period_id',$id);
		$this->db->delete('livestreams_periods');
	}
}