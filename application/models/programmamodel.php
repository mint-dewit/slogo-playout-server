<?php

Class Programmamodel extends CI_Model {

	function get_all_programmas() {
		$this->db->join('tv_programme_categories as categories','tv_programmes.category = categories.category_id');
		return $this->db->get('tv_programmes')->result_array();
	} 

	function get_all_categories() {
		return $this->db->get('tv_programme_categories')->result_array();
	}

	function get_programme_data($programme_id,$episode=null) {
		// get general info
		$this->db->join('tv_programme_categories','tv_programme_categories.category_id = tv_programmes.category');
		$programme = $this->db->get_where('tv_programmes',array('tv_programmes.programme_id'=>$programme_id))->row_array();

		// foreach episode
		if (!empty($episode)) {
			$programme['episodes'] = $this->db->get_where('tv_episodes',array('programme_id'=>$programme_id,'episode_id'=>$episode))->result_array();
		} else {
			$programme['episodes'] = $this->db->get_where('tv_episodes',array('programme_id'=>$programme_id))->result_array();
		}
		foreach ($programme['episodes'] as &$episode) {
			// get days
			$days = $this->db->get_where('tv_episodes_days',array('episode_id'=>$episode['episode_id']))->result_array();
			$episode['days'] = array();
			foreach ($days as $day) $episode['days'][$day['day']] = TRUE;
			// get times
			$episode['times'] = $this->db->get_where('tv_episodes_times',array('episode_id'=>$episode['episode_id']))->result_array();
			// get periods
			$episode['periods'] = $this->db->get_where('tv_episodes_periods',array('episode_id'=>$episode['episode_id']))->result_array();
			// get sources
			$this->db->where('sourelist.episode_id', $episode['episode_id']);
			$this->db->order_by('order','asc');
			$episode['sources'] = $this->db->get('tv_episode_has_sources as sourelist')->result_array();

			foreach ($episode['sources'] as &$source) {
				if (!empty($source['html_id'])) {
					$source = array_merge($source, $this->db->get_where('tv_episodes_html_items', array( 'html_id'=>$source['html_id'] ))->row_array());
					$source['keys'] = $this->db->get_where('tv_episodes_html_values', array( 'html_id'=>$source['html_id'] ))->result_array();
				}
			}
		}

		return $programme;
	}

	function update_programme($id, $data) {
		$this->db->where('programme_id',$id);
		$this->db->update('tv_programmes',$data);
	}

	function update_episode($id, $data) {
		$this->db->where('episode_id',$id);
		$this->db->update('tv_episodes',$data);
	}

	function update_days($id, $days) {
		$this->db->delete('tv_episodes_days',array('episode_id'=>$id));
		foreach ($days as $day => $val) {
			if ($val === 'true') $this->db->insert('tv_episodes_days',array('episode_id'=>$id,'day'=>$day));
		}
	}

	function update_times($id, $times) {
		foreach ($times as $time_id => $time) {
			if ($time_id != 'new') {
				$this->db->where('id',$time_id);
				$this->db->update('tv_episodes_times',array('time'=>$time));
			} else {
				foreach ($time as $new_time) {
					$this->db->insert('tv_episodes_times',array('episode_id'=>$id,'time'=>$new_time));
				}
			}
		}
	}

	function update_periods($id, $periods) {
		foreach ($periods as $period_id => $period) {
			if ($period_id != 'new') {
				$this->db->where('id',$period_id);
				$this->db->update('tv_episodes_periods',array('period_start'=>$period['start'],'period_end'=>$period['end']));
			} else {
				foreach ($period as $new_period) {
					$this->db->insert('tv_episodes_periods',array('period_start'=>$new_period['start'],'period_end'=>$new_period['end'],'episode_id'=>$id));
				}
			}
		}
	}

	function update_sourcelinks($id, $sources) {
		foreach ($sources['videos'] as $link_id => $source) {
			if ($link_id != 'new') {
				$this->db->where('link_id',$link_id);
				$this->db->update('tv_episode_has_sources',array( 'order'=>$source['order'], 'source_id'=>$source['id'] ));
			} else {
				foreach ($source as $new_source) {
					$this->db->insert('tv_episode_has_sources', array( 'episode_id'=>$id, 'source_id'=>$new_source['id'], 'order'=>$new_source['order'] ));
				}
			}
		}

		foreach ($sources['html'] as $link_id => $template) {
			if ($link_id != 'new') {
				$orig = $this->db->get_where('tv_episode_has_sources', array('link_id'=>$link_id))->row_array();

				$this->db->where('link_id',$link_id);
				$this->db->update('tv_episode_has_sources', array( 'order'=>$template['order'] ));

				$this->db->where('html_id', $orig['html_id']);
				$this->db->update('tv_episodes_html_items', array( 'template_id'=>$template['template_id'], 'title'=>$template['title'], 'dur'=>$template['dur'] ));

				$this->db->where('html_id', $orig['html_id']);
				$this->db->delete('tv_episodes_html_values');
				foreach ($template['keys'] as $key_id => $key_val) {
					$this->db->insert('tv_episodes_html_values', array( 'html_id'=>$orig['html_id'], 'key'=>$key_id, 'value'=>$key_val ));
				}
			} else {
				foreach ($template as $new_template) {
					$this->db->insert('tv_episodes_html_items', array( 'template_id'=>$new_template['template_id'], 'title'=>$new_template['title'], 'dur'=>$new_template['dur'] ));
					$insert_id = $this->db->insert_id();
					$this->db->insert('tv_episode_has_sources', array( 'episode_id'=>$id, 'html_id'=>$insert_id, 'order'=>$new_template['order'] ));
					foreach ($new_template['keys'] as $key_id => $key_val) {
						$this->db->insert('tv_episodes_html_values', array( 'html_id'=>$insert_id, 'key'=>$key_id, 'value'=>$key_val ));
					}
				}
			}
		}
	}

	function delete_time($id) {
		$this->db->delete('tv_episodes_times',array('id'=>$id));
	}

	function delete_period($id) {
		$this->db->deleter('tv_episodes_periods',array('id'=>$id));
	}

	function delete_sourcelink($id) {
		$this->db->delete('tv_episode_has_sources',array('link_id'=>$id));
	}

	function delete_html($id) {
		$orig = $this->db->get_where('tv_episode_has_sources', array('link_id'=>$id))->row_array();
		$this->db->delete('tv_episode_has_sources', array('link_id'=>$id));
		$this->db->delete('tv_episodes_html_items', array('html_id'=>$orig['html_id']));
		$this->db->delete('tv_episodes_html_values', array('html_id'=>$orig['html_id']));
	}

	function delete_programme($id) {
		$this->db->delete('tv_programmes',array('programme_id'=>$id));
	}

	function delete_episode($id) {
		$this->db->delete('tv_episodes',array('episode_id'=>$id));
	}

	function insert_programme($data) {
		$this->db->insert('tv_programmes',$data);
		return $this->db->insert_id();
	}

	function insert_episode($data) {
		$this->db->insert('tv_episodes',$data);
		return $this->db->insert_id();
	}

	function duplicate_episode($id) {
		// duplicate episode and get new id
		$episode = $this->db->get_where('tv_episodes',array('episode_id'=>$id))->row_array();
		unset($episode['episode_id']);
		$this->db->insert('tv_episodes',$episode);
		$new_id = $this->db->insert_id();
		// duplicate days
		$days = $this->db->get_where('tv_episodes_days',array('episode_id'=>$id))->result_array();
		foreach ($days as &$day) {
			$day['episode_id'] = $new_id;
		}
		$this->db->insert_batch('tv_episodes_days',$days);
		// duplicate periods
		$periods = $this->db->get_where('tv_episodes_periods',array('episode_id'=>$id))->result_array();
		foreach ($periods as &$period) {
			$period['episode_id'] = $new_id;
			unset($period['id']);
		}
		$this->db->insert_batch('tv_episodes_periods',$periods);
		// duplicate times
		$times = $this->db->get_where('tv_episodes_times',array('episode_id'=>$id))->result_array();
		foreach ($times as &$time) {
			$time['episode_id'] = $new_id;
			unset($time['id']);
		}
		$this->db->insert_batch('tv_episodes_times',$times);
		// duplicate source_list
		$sourcelist = $this->db->get_where('tv_episode_has_sources',array('episode_id'=>$id))->result_array();
		foreach ($sourcelist as &$source) {
			$source['episode_id'] = $new_id;
		}
		$this->db->insert_batch('tv_episode_has_sources',$sourcelist);

		return $new_id;
	}

	function get_sourcelist() {
		return $this->db->get('tv_sources')->result_array();
	}

	function update_sourcelist($sources) {
		foreach ($sources as $source_id => $source) {
			if ($source_id != 'new') {
				$audio = 0;
				if (!empty($source['audio'])) $audio = 1;
				$this->db->where('source_id',$source_id);
				$this->db->update('tv_sources',array('source'=>$source['file'],'duration'=>$source['duration'],'audio'=>$audio,'host'=>$source['host']));
			} else {
				foreach ($source as $new_source) {
					$audio = 0;
					if (!empty($new_source['audio'])) $audio = 1;
					$this->db->insert('tv_sources',array('source'=>$new_source['file'],'duration'=>$new_source['duration'],'audio'=>$audio, 'host'=>$new_source['host']));
				}
			}
		}
	}

	function delete_source($id) {
		$this->db->delete('tv_sources',array('source_id'=>$id));
		$this->db->delete('tv_episode_has_sources',array('source_id'=>$id));
	}


}

/* end of file */