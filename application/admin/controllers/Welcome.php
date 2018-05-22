<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index() {

		$adm_uid = $this->session->userdata('adm_uid') ?: 0;
		if ($adm_uid) {

			$this->load->view('header');
			$this->load->view('welcome_message');
			$this->load->view('footer');

		} else {
			redirect(HOSTDOMAIN . '/welcome/login');

		}

	}

	public function login() {
		$post = $this->input->post();
		if ($post) {
			$post = $this->commfunctions->arrayTrim($post);
			$post['u'] = isset($post['u']) ? $post['u'] : 0;
			$post['p'] = isset($post['p']) ? $post['p'] : 0;
			$u = addslashes($post['u']);
			$p = md5(addslashes($post['p']));
			$user = $this->db->query(" SELECT id,nick_name from admin_user WHERE account = '" . $u . "' AND pwd = '" . $p . "'")->row_array();

			if ($user) {
				//登录成功
				$sdata = array(
					'adm_uid' => $user['id'],
					'adm_username' => $user['nick_name']);
				$this->session->set_userdata($sdata);
				echo "110";exit;
			} else {
				echo "119";exit;
			}

		}

		$this->load->view('login');

	}
}
