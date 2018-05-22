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

	//支持js post请求
	protected function get_m_post($index) {
		$mpost = $this->input->post();
		if (empty($mpost)) {
			$mpost = json_decode(file_get_contents("php://input"), true);
		}
		if (isset($mpost[$index])) {
			return $mpost[$index];
		}
		return '';

	}
}
