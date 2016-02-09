<?php

class Tv extends CI_Controller {

	function templates() {
		$video_id = $this->input->get('v');
		$youtube_data = file_get_contents('http://www.youtube.com/get_video_info?asv=3&el=detailpage&hl=en_US&video_id='.$video_id);
		$decoded = urldecode($youtube_data);
		parse_str($decoded, $get_array);

		$video_data = simplexml_load_file($get_array['dashmpd']);

		echo '{"success":"true","audio":"'.$video_data->Period->AdaptationSet[0]->Representation->BaseURL.'","video":"'.$video_data->Period->AdaptationSet[1]->Representation[4]->BaseURL.'"}';
	}
}