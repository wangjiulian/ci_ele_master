<?php if (!defined('BASEPATH')) {
	exit('No direct access script allowed');
}

class Comm extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('comm_model');
	}

}