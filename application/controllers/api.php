<?php

class Api extends CI_Controller {

	function Api(){
        parent::__Construct();
        $this->load->model('playoutmodel');
		header('Access-Control-Allow-Origin: *');
	}
	
	function teksttv(){
		function is_assoc($array) {
		  foreach (array_keys($array) as $k => $v) {
		    if ($k !== $v)
		      return true;
		  }
		  return false;
		}

		echo '{ "forceupdate": "false", "platen": [ { "title": "","type": "main-tekst","dur": "0" } ';

		$platen = $this->playoutmodel->get_teksttv();
		if (!empty($platen)) echo ", ";

		function recursive($array, $level = 1){
			$cur = 1;
		    foreach($array as $key => $value){
		        //If $value is an array.
		        if(is_array($value)){
		        	if (!is_numeric($key)) {
		        		echo '"' . $key . '": ';
		        	}
		        	if (is_assoc($value)) {
		        		echo '{ ';
		        	} else {
		        		echo '[ ';
		        	}
		            //We need to loop through it.
		            recursive($value, $level + 1);
		            if (is_assoc($value)) {
		        		echo ' }';
		        	} else {
		        		echo ' ]';
		        	}
		        } else{
		            //It is not an array, so print it out.
		            echo '"' . $key . '": "' . $value, '"';
		        }
		        if ($cur != count($array)) {
		        	echo ', ';
		        }
		        $cur++;
		    }
		}
		recursive($platen);

		echo '] }';
	}

	function audiostreams($day='cur'){
		$this->dwootemplate->assign('streams',$this->playoutmodel->get_audiostreams($day));
		$this->dwootemplate->display('json/audiostreams.tpl');
	}

	function videos($day='cur'){
		$this->dwootemplate->assign('videos',$this->playoutmodel->get_videos($day));
		$this->dwootemplate->display('json/programmering-tv.tpl');
	}

	function music(){
		$this->dwootemplate->assign('music',$this->playoutmodel->get_music());
		$this->dwootemplate->display('json/muziek.tpl');
	}

	function get_radioslogo(){
		$postdata = http_build_query(
		    array(
		        'action' => 'current_program_json_callback'
		    )
		);

		$opts = array('http' =>
		    array(
		        'method'  => 'POST',
		        'header'  => 'Content-type: application/x-www-form-urlencoded',
		        'content' => $postdata
		    )
		);

		$context  = stream_context_create($opts);

		echo file_get_contents('http://www.rtvslogo.nl/wpr/wp-admin/admin-ajax.php', false, $context);
	}

	function downloads(){
		$type = $this->input->get('type');
		if ($type == "youtube") {
			$this->dwootemplate->assign('videos',$this->playoutmodel->get_yt_downloads());
			$this->dwootemplate->display('json/downloads.tpl');
		}
		if ($type == "yt_adaptive") {
			$video_id = $this->input->get('video');
			$youtube_data = file_get_contents('http://www.youtube.com/get_video_info?asv=3&el=detailpage&hl=en_US&video_id='.$video_id);
			$decoded = urldecode($youtube_data);
			parse_str($decoded, $get_array);

			echo $get_array['dashmpd'];
		}
	}

	function yt() {
		$video_id = $this->input->get('v');
		$youtube_data = file_get_contents('http://www.youtube.com/get_video_info?asv=3&el=detailpage&hl=en_US&video_id='.$video_id);
		$decoded = urldecode($youtube_data);
		parse_str($decoded, $get_array);

		$video_data = simplexml_load_file($get_array['dashmpd']);

		echo $get_array['dashmpd'];

		echo '{"success":"true","audio":"'.$video_data->Period->AdaptationSet[0]->Representation->BaseURL.'","video":"'.$video_data->Period->AdaptationSet[2]->Representation[2]->BaseURL.'"}';
	}

    function update_sources() {
    	//json_decode($this->input->get('sources'),true);

    	if ($this->input->post()) {
    		$sources = $this->input->post('clips');
    		print_r($sources);
    		$this->playoutmodel->update_sources($sources);
    		echo 'POST SOURCES SUCCESS';
    	}

    	//
    }

    function silence($channel, $state, $secret) {
		if ($secret == '') {
	    	$this->load->library('email');

			$this->email->from('warning@igo.nl', 'RTV Slogo Playout');
			$this->email->to('balte.dewit@gmail.com');

			$this->email->subject('Silence Detection warning! '.date('Y-m-d H:i:s'));
			$this->email->message('Channel '.$channel.' reports audio was '.$state);	

			$this->email->send();
		}
	}

	function late_frame($time, $secret) {
		if ($secret == '') {
	    	$this->load->library('email');

			$this->email->from('warning@igo.nl', 'RTV Slogo Playout');
			$this->email->to('balte.dewit@gmail.com');

			$this->email->subject('Warning! late frame! '.date('Y-m-d H:i:s'));
			$this->email->message('frame was  '.$time.' late...');	

			$this->email->send();
		}
	}

}
