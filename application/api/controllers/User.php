<?php if (!defined('BASEPATH')) {
	exit('No allowed ');
}

/*
 * @Todo:
 * @Author: avery
 * @Date:2018-05-19 10:03:51
 *
 */
class User extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('user_model');
	}

/**
 * @api {POST} http://api.wangjl.work/user/login 登录
 * @apiName login
 * @apiGroup user
 * @apiVersion 1.0.0
 * @apiDescription 登录
 * @apiPermission anyone
 * @apiSampleRequest http://api.wangjl.work/user/login
 *
 * @apiParam {string} mobile （必填）手机号
 * @apiParam {string} pwd （必填）密码
 * @apiParam {string} verword （必填）验证码
 *
 * @apiParamExample {jsonp} Request Example
 *   POST /test_ele/login
 *   {
 *   "code": "success",
 *   "re_info": {
 *       "id": "4",
 *       "user_name": "",
 *       "pwd": "e10adc3949ba59abbe56e057f20f883e",
 *       "mobile": "15985866257",
 *       "nick_name": null,
 *       "avatar": null
 *   }
 * }
 *
 */
	public function login() {
		$mobile = addslashes(trim($this->get_m_post('mobile')));
		$pwd = addslashes(trim($this->get_m_post('pwd')));
		$verword = addslashes(trim($this->get_m_post('verword')));
		// First, delete old captchas
		$expiration = time() - 7200; // Two hour limit
		$this->db->where('captcha_time < ', $expiration)
			->delete('captcha');

		// Then see if a captcha exists:
		$sql = 'SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?';
		$binds = array($verword, $this->input->ip_address(), $expiration);
		$query = $this->db->query($sql, $binds);
		$row = $query->row();

		if ($row->count == 0) {
			$this->apifunction->show_json_msg('error', '验证码错误！');
		} else {
			//检查数据库
			$re = $this->db->query(" SELECT * FROM user WHERE mobile = {$mobile} ")->row_array();
			if (!empty($re)) {
				//匹配密码
				$re = $this->db->query(" SELECT * FROM user WHERE mobile = {$mobile} AND pwd = '" . md5($pwd) . "'")->row_array();
				if (empty($re)) {
					echo "密码错误";
					exit;
				} else {
					$this->apifunction->show_json_msg('success', $re);
					exit;
				}

			} else {
				//第一次登录注册，插入数据库
				$this->db->trans_start();
				$inserData = array(
					'mobile' => $mobile,
					'pwd' => md5($pwd));
				$save_id = $this->apifunction->saveData('user', $inserData);
				$this->db->trans_complete();
				$re = $this->db->query(" SELECT * FROM user WHERE id = {$save_id} ")->row_array();
				$this->apifunction->show_json_msg('success', $re);
				exit;
			}

		}

	}
}