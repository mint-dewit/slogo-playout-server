<?php if ( ! defined('BASEPATH') ) exit();

class Playoutmodel extends CI_Model {
	function get_videos($day) {
        date_default_timezone_set('UTC');
        $base_time = new DateTime();
        if ($day == 'next') date_add($base_time, date_interval_create_from_date_string('24 hours'));
        $datetime = date_format($base_time, 'Y-m-d H:i:s');
        $items = array();
        $programmes = array();
 
        $this->db->where('periods.period_start <', $datetime);
        $this->db->where('periods.period_end >',$datetime);
        $this->db->where('tv_episodes_days.day', date_format($base_time, 'w'));
        $this->db->join('tv_episodes_periods as periods','periods.episode_id = tv_episodes_days.episode_id');

		foreach ($this->db->get('tv_episodes_days')->result_array() as $item) {
			foreach ($this->db->get_where('tv_episodes_times',array('episode_id'=>$item['episode_id']))->result_array() as $time) {
				$curstarttime = $time['time'];
				$programme['start'] = $curstarttime;
				$this->db->order_by('order','asc');
				$sources = $this->db->get_where('tv_episode_has_sources',array('episode_id'=>$time['episode_id']))->result_array();
				foreach ($sources as $source) {
					$data = array();
					if ($source['source_id'] != NULL) {
						$src = $this->db->get_where('tv_sources', array( 'source_id'=>$source['source_id'] ))->row_array();
						$data['source'] = $src['source'];
						$data['start'] = date('H:i:s',strtotime($curstarttime));
						$source['duration'] = '1970-01-01 '.$src['duration'];
						$data['end'] = date('H:i:s',strtotime($curstarttime) + strtotime($source['duration']));
						$data['audio'] = $src['audio'];
						$data['host'] = $src['host'];
						$curstarttime = $data['end'];
					} else {
						$data['host'] = 'template';
						$data['audio'] = 0;
						$html = $this->db->get_where('tv_episodes_html_items', array( 'html_id'=>$source['html_id'] ))->row_array();
						$this->db->join('tv_episodes_html_items', 'tv_episodes_html_items.html_id = tv_episodes_html_values.html_id');
						$this->db->join('texttv_keys', 'texttv_keys.template_id = tv_episodes_html_items.template_id');
						$vals = $this->db->get_where('tv_episodes_html_values', array( 'tv_episodes_html_values.html_id'=>$source['html_id'] ))->result_array();
						$template = $this->db->get_where('texttv_templates', array( 'id'=>$html['template_id'] ))->row_array();
						$data['source'] = $template['title'];
						$data['start'] = date('H:i:s',strtotime($curstarttime));
						$source['duration'] = '1970-01-01 '.$html['dur'];
						$data['end'] = date('H:i:s',strtotime($curstarttime) + $html['dur']);
						$curstarttime = $data['end'];
						foreach ($vals as $val) {
							$data['keys'][$val['key_name']] = $val['value'];
						}
						$data['keys']['duration'] = $html['dur'];
						$data['keys']['title'] = $html['title'];
					}


					$items[] = $data;
				}
				$programme['end'] = $curstarttime;
				$programmes[] = $programme;
			}
		}

		$roadmovies = $this->db->get('tv_roadmovies')->result_array();
		$day = intval(date('z')) + 1;
		$tot_roadmovies = count($roadmovies);
		$todays_movie = $day - floor($day / $tot_roadmovies)*$tot_roadmovies;
		$roadmovie = $roadmovies[$todays_movie];

		for ($h = 00; $h < 24; $h++) {
			if ($h <= 9 ) $roadmovie_start = '0'.$h.':00:00';
			else $roadmovie_start = $h.':00:00';
			$roadmovie_end = date('H:i:s', strtotime($roadmovie_start) + strtotime('1970-01-01 '.$roadmovie['duration']) + 20);
			$show_movie = true;
			foreach ($programmes as $item) {
				//echo strtotime('1970-01-01 '.$item['start']) . ' ' .strtotime($roadmovie_start). '<br>';
				if (strtotime($item['start']) == strtotime($roadmovie_start)) $show_movie = false;
				elseif (strtotime($item['start']) > strtotime($roadmovie_start) && strtotime($item['start']) < strtotime($roadmovie_end)) $show_movie = false;
				elseif (strtotime($item['end']) > strtotime($roadmovie_start) && strtotime($item['end']) < strtotime($roadmovie_end)) $show_movie = false;
				elseif (strtotime($item['start']) < strtotime($roadmovie_start) && strtotime($item['end']) > strtotime($roadmovie_end)) $show_movie = false;
				elseif (strtotime($item['end']) == strtotime($roadmovie_end)) $show_movie = false;
			}
			if ($show_movie == true) {
				$items[] = array('host' => 'local',
					'audio' => 0,
					'source' => 'idents/intro_roadmovie_enc',
					'type' => 'video/mp4',
					'start' => $roadmovie_start,
					'end' => date('H:i:s',strtotime($roadmovie_start)+10));
				$items[] = array('host' => 'local',
					'audio' => 0,
					'source' => 'roadmovies/'.$roadmovie['file'],
					'type' => 'video/mp4',
					'start' => date('H:i:s',strtotime($roadmovie_start)+10),
					'end' => date('H:i:s',strtotime($roadmovie_end)-10));
				$items[] = array('host' => 'template',
					'audio' => 0,
					'source' => 'roadmovies_outro',
					'type' => 'template/html',
					'start' => date('H:i:s',strtotime($roadmovie_end)-10),
					'end' => $roadmovie_end,
					'keys' => array(
						'location' => $roadmovie['location'],
						'dur' => 10));
				$programmes[] = array('start'=>$roadmovie_start,'end'=>$roadmovie_end);
			}
		} 

		$commercials = array();
		for ($i = 0; $i < 5; $i++) {
			$container = array();
			$this->db->join('commercials_days','commercials_days.source_id = commercials.source_id');
			$this->db->order_by('order','asc');
			$container['items'] = $this->db->get_where('commercials',array('commercials.blok'=>$i,'commercials_days.day'=>date('w')))->result_array();
			$container['total_dur'] = 0;
			foreach ($container['items'] as $item) {
				$container['total_dur'] += strtotime('1970-01-01 '.$item['dur']);
			}
			$commercials[$i] = $container;
		}

		$temp_items = array();
		for ($h = 00; $h < 24; $h++) {
			for ($m = 0; $m <5; $m++) {
				$min = $m*12;
				$ad_time = '1970-01-01 '.$h.':'.$min.':00';
				$before = true;
				$after = true;
				foreach ($programmes as $item) {
					if ( strtotime('1970-01-01 '.$item['start']) <= strtotime($ad_time) && strtotime('1970-01-01 '.$item['end']) > strtotime($ad_time) ) {
						$after = false;
					}
					if ( strtotime('1970-01-01 '.$item['start']) <= strtotime($ad_time)-$commercials[$m]['total_dur'] && strtotime('1970-01-01 '.$item['end']) > strtotime($ad_time)-$commercials[$m]['total_dur'] ) {
						$before = false;
					}
					if ($after) {
						$interval = strtotime($ad_time) - strtotime('1970-01-01' . $item['end']);
						if ( $interval < 180 && $interval > 0 ) {
							$ad_time = '1970-01-01' . $item['end'];
						}
					}
					elseif (!$after && !$before) {
						$interval = strtotime('1970-01-01 '.$item['end']) - strtotime($ad_time);
						if ( $interval < 180 && $interval > 0 ) {
							//echo $ad_time . 'moet naar ' . $item['end'] . ' om aan te sluiten <br />';
							$ad_time = '1970-01-01 '.$item['end'];
							$after = true;
						}
					}
				}

				if ($after) {
					//echo 'commercial ' . $m . '; at time: '.date('H:i:s',strtotime($ad_time)).';<br />';
					$curstarttime = $ad_time;
					foreach ($commercials[$m]['items'] as $source) {
						$data = array();
						$data['source'] = 'reclames/'.$source['source'];
						$data['start'] = date('H:i:s',strtotime($curstarttime));
						$data['end'] = date('H:i:s',strtotime($curstarttime) + strtotime('1970-01-01 '.$source['dur']));
						$data['audio'] = false;
						$data['host'] = 'local';
						$curstarttime = $data['end'];

						$items[] = $data;
					}
				} elseif ($before) {
					//echo 'commercial ' . $m . '; at time: '.date('H:i:s',strtotime($ad_time)-$commercials[$m]['total_dur']).'; <br />';
					$curstarttime = date('1970-01-01 H:i:s',strtotime($ad_time)-$commercials[$m]['total_dur']);
					foreach ($commercials[$m]['items'] as $source) {
						$data = array();
						$data['source'] = 'reclames/'.$source['source'];
						$data['start'] = date('H:i:s',strtotime($curstarttime));
						$data['end'] = date('H:i:s',strtotime($curstarttime) + strtotime('1970-01-01 '.$source['dur']));
						$data['audio'] = false;
						$data['host'] = 'local';
						$curstarttime = $data['end'];

						$items[] = $data;
					}
				}
			}
		};

		function sort_by_time($a, $b) {
			if ($a['start'] > $b['start']) { return 1; }
			elseif ($a['start'] < $b['start']) { return -1; }
			else { 
				if ($a['end'] > $b['end']) { return 1; }
				elseif ($a['end'] < $b['end']) { return -1; }
				else { return 0; };
			};
		}; 

		usort($items, 'sort_by_time');

		return $items;
	}

	function get_teksttv() {
		$this->db->select('texttv_playlist.*, texttv_templates.title as template_title');
		$this->db->where('period_start <',date('Y-m-d  H:i:s'));
		$this->db->where('period_end >',date('Y-m-d H:i:s'));
		$this->db->join('texttv_templates','texttv_playlist.template = texttv_templates.id');
		$this->db->order_by('texttv_playlist.order','asc');
		$result = $this->db->get('texttv_playlist')->result_array();

		$data = array();
		foreach ($result as $item) {
			$this->db->select('texttv_values.value, texttv_values.playlistitem_id, texttv_keys.key_name');
			$this->db->where('texttv_values.playlistitem_id',$item['id']);
			$this->db->join('texttv_keys','texttv_keys.key_id = texttv_values.key_id');
			$values = $this->db->get('texttv_values')->result_array();

			$playlistitem = array('title'=>$item['title'],
				'type'=>$item['template_title'],
				'dur'=>$item['dur']);
			
			foreach ($values as $value) {
				$playlistitem[$value['key_name']] = $value['value'];
			}

			if ($item['template_title'] == 'external_playlist') {
				$external = json_decode(file_get_contents($playlistitem['source']), true);

				foreach ($external as $part) {
					$data[] = $part;
				}
			} else {
				$data[] = $playlistitem;
			}
		}


		return $data;
	}

	function get_audiostreams($day) {
		date_default_timezone_set('UTC');
        $base_time = new DateTime();
        if ($day == 'next') date_add($base_time, date_interval_create_from_date_string('24 hours'));
        $datetime = date_format($base_time, 'Y-m-d H:i:s');
		$items = array();

		$this->db->where('periods.start <', $datetime);
		$this->db->where('periods.end >',$datetime);
		$this->db->where('livestreams_days.day', date_format($base_time, 'w'));
		$this->db->join('livestreams','livestreams.livestream_id = livestreams_days.livestream_id');
		$this->db->join('livestreams_periods as periods','periods.livestream_id = livestreams_days.livestream_id');

		foreach ($this->db->get('livestreams_days')->result_array() as $item) {
			foreach ($this->db->get_where('livestreams_times',array('livestream_id'=>$item['livestream_id']))->result_array() as $time) {
				$data = array();
				$data['source'] = $item['source'];
				$data['start'] = date('H:i:s',strtotime($time['start']));
				$data['end'] = date('H:i:s',strtotime($time['end']));

				$items[] = $data;
			}
		}

		function sort_by_time($a, $b) {
			if ($a['start'] > $b['start']) { return 1; }
			elseif ($a['start'] < $b['start']) { return -1; }
			else { return 0; };
		}; 

		usort($items, 'sort_by_time');

		return $items;
	}

	function get_music() {
		date_default_timezone_set('Europe/Amsterdam');

		$datetime = date('Y-m-d H:i:s');
		$items = array('items'=>array(),'forceupdate'=>'false');

		$this->db->where('periods.start <', $datetime);
		$this->db->where('periods.end >',$datetime);
		$this->db->where('playlists_days.day', date('w'));
		$this->db->join('playlists_periods as periods','periods.playlist_id = playlists_days.playlist_id');

		foreach ($this->db->get('playlists_days')->result_array() as $item) {
			foreach ($this->db->get_where('playlists_times',array('playlist_id'=>$item['playlist_id'],'start <'=>date('H:i:s'),'end >'=>date('H:i:s')))->result_array() as $time) {
				if (time() - strtotime(date('Y-m-d ').$time['start']) <= 60) $items['forceupdate'] = 'true';
				$sources = $this->db->get_where('playlists_sources',array('playlist_id'=>$time['playlist_id']))->result_array();
				foreach ($sources as $source) {
					$data = array();
					$data['source'] = $source['source'];

					$items['items'][] = $data;
				}
			}
		}

		return $items;
	}

	function update_sources($sources) {
        foreach ($sources as $source) {
            $this->db->where('host',$source['host']);
            $this->db->where('source',strtoupper($source['source']));
            $this->db->update('tv_sources',$source);
        }
 
        $db_sources = $this->db->get('tv_sources')->result_array();
        foreach ($db_sources as $db_source) {
            $found = false;
            if ($db_source['host'] == 'live') $found = true;
            foreach ($sources as $source) {
                if (strtoupper($db_source['source']) == $source['source'] && $db_source['host'] == $source['host']) {
                    $found = true;
                }
            }
            if ($found == false) {
                $this->db->where('host',$db_source['host']);
                $this->db->where('source',$db_source['source']);
                $this->db->update('tv_sources',array('duration'=>'00:00:00'));
            }
        }
    }
}