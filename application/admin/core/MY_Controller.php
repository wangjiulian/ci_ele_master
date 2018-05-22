<?php

/*
 * @Todo:
 * @Author: avery
 * @Date:2018-05-19 09:42:12
 *
 */

class MY_Controller extends CI_Controller {
	function __construct() {
		parent::__construct();
		$adm_uid = $this->session->userdata('adm_uid') ?: 0;
		if (empty($adm_uid)) {
			redirect(HOSTDOMAIN . '/welcome/login');
		}

	}

}
