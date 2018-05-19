<?php if (!defined('BASEPATH')) {
	exit('No direct access script allowed');
}

/*
 * @Todo:
 * @Author: avery
 * @Date:2018-05-19 09:53:27
 *
 */

class Comm extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('comm_model');
	}
	function index() {
		echo "string";
	}

	/**
	 * @api {GET} http://api.wangjl.work/comm/verification_code 获取验证码
	 * @apiName verification_code
	 * @apiGroup comm
	 * @apiVersion 1.0.0
	 * @apiDescription 获取验证码
	 * @apiPermission anyone
	 * @apiSampleRequest http://api.wangjl.work/comm/verification_code
	 *
	 * @apiParamExample {jsonp} Request Example
	 *   GET /comm/verification_code
	 */
	public function verification_code() {
		$this->load->helper('captcha');
		if (!file_exists('captcha')) {
			$this->commfunctions->mkpath('captcha');
		}
		$vals = array(
			'word' => rand(1000, 10000),
			'img_path' => './captcha/',
			'img_url' => 'http://localhost/ci/captcha/',
			//'font_path' => './path/to/fonts/texb.ttf',
			'img_width' => '150',
			'img_height' => 30,
			'expiration' => 10,
		);

		$cap = create_captcha($vals);
		$data = array(
			'captcha_time' => $cap['time'],
			'ip_address' => $this->input->ip_address(),
			'word' => $cap['word'],
		);
		$query = $this->db->insert_string('captcha', $data);
		$this->db->query($query);
		$filepath = 'http://' . $_SERVER['HTTP_HOST'] . '/captcha/' . $cap['filename'];
		echo "<img src='" . $filepath . "' />";
		exit;
	}

}
