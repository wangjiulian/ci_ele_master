<?php

/*
 * @Todo:
 * @Author: avery
 * @Date:2018-05-19 09:56:25
 *
 */

class MY_Controller extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->library('apifunction');
		$this->load->library('commfunctions');
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
	}
}
