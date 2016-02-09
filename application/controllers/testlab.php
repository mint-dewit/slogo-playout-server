<?php

class Testlab extends CI_Controller {

	function planner() {
		$this->dwootemplate->display('admin/testlab/planner.tpl');
	}
}