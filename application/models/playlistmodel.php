<?php

class Playlistmodel extends CI_Model {

	function insert_playlist($data)
	{
		$this->db->insert('playlists',$data);
		return $this->db->insert_id();
	}

	function update_playlist($id, $data)
	{
		$this->db->where('playlist_id',$id);
		$this->db->update('playlists',$data);
	}

	function update_days($id, $days)
	{
		$this->db->delete('playlists_days',array('playlist_id'=>$id));
		foreach ($days as $day => $none) {
			$this->db->insert('playlists_days',array('playlist_id'=>$id,'day'=>$day));
		}
	}

	function update_times($id, $times) {
		foreach ($times as $time_id => $time) {
			if ($time_id != 'new') {
				$this->db->where('time_id',$time_id);
				$this->db->update('playlists_times',array('start'=>$time['start'],'end'=>$time['end']));
			} else {
				foreach ($time as $new_time) {
					$this->db->insert('playlists_times',array('start'=>$new_time['start'],'end'=>$new_time['end'],'playlist_id'=>$id));
				}
			}
		}
	}

	function update_periods($id, $periods) {
		foreach ($periods as $period_id => $period) {
			if ($period_id != 'new') {
				$this->db->where('period_id',$period_id);
				$this->db->update('playlists_periods',array('start'=>$period['start'],'end'=>$period['end']));
			} else {
				foreach ($period as $new_period) {
					$this->db->insert('playlists_periods',array('start'=>$new_period['start'],'end'=>$new_period['end'],'playlist_id'=>$id));
				}
			}
		}
	}

	function update_sources($id, $sources) {
		foreach ($sources as $source_id => $source) {
			if ($source_id != 'new') {
				$this->db->where('source_id',$source_id);
				$this->db->update('playlists_sources',array('source'=>$source));
			} else {
				foreach ($source as $new_source) {
					$this->db->insert('playlists_sources',array('source'=>$new_source, 'playlist_id'=>$id));
				}
			}
		}
	}

	function get_all_playlists() {
		return $this->db->get('playlists')->result_array();
	}

	function get_playlist($id) {
		$playlist = $this->db->get_where('playlists',array('playlist_id'=>$id))->row_array();

		$days = $this->db->get_where('playlists_days',array('playlist_id'=>$id))->result_array();
		$playlist['days'] = array();
		foreach ($days as $day) $playlist['days'][$day['day']] = TRUE;
		// get times
		$playlist['times'] = $this->db->get_where('playlists_times',array('playlist_id'=>$id))->result_array();
		// get periods
		$playlist['periods'] = $this->db->get_where('playlists_periods',array('playlist_id'=>$id))->result_array();
		// get sources
		$playlist['sources'] = $this->db->get_where('playlists_sources',array('playlist_id'=>$id))->result_array();

		return $playlist;
	}

	function delete_playlist($id) {
		$this->db->where('playlist_id',$id);
		$this->db->delete('playlists');

		$this->db->where('playlist_id',$id);
		$this->db->delete('playlists_periods');
	}

	function delete_time($id) {
		$this->db->where('time_id',$id);
		$this->db->delete('playlists_times');
	}

	function delete_period($id) {
		$this->db->where('period_id',$id);
		$this->db->delete('playlists_periods');
	}

	function delete_source($id) {
		$this->db->where('source_id',$id);
		$this->db->delete('playlists_sources');
	}
}