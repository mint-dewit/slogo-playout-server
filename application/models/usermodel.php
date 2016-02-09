<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed!');

class Usermodel extends CI_Model {
	function checklogin($username,$password){
		$result = $this->db->get_where('users',array('username'=>$username,'password'=>MD5($password)))->result_array();
		if (count($result) > 0) {
			return true;
		} else {
			return false;
		}
	}
}