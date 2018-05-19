<?php if (!defined('BASEPATH')) {
	exit('No direct access script allowed');
}

class Comm extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('comm_model');
	}

}