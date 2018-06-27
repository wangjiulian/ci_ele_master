<?php if (!defined('BASEPATH')) {
	exit('No direct access script allowed');
}

class Business extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('business_model');
		$this->load->model('comm_model');
		error_reporting(-1);
		ini_set('display_errors', 1);
	}

	public function index() {
		$offset = $this->uri->segment('5') ? ($this->uri->segment('5') - 1) * PERPAGE : 0;
		$perpage = PERPAGE;
		$key = $this->input->post('q');
		if ($key) {
			$key = addslashes(trim($key));
			$condition = " AND a.`name` like '%" . $key . "%'";
		} else {
			$condition = '';
		}

		//分页
		$res = $this->business_model->get_business_list($condition, $offset, $perpage);
		$config['total_rows'] = $res['total'];
		$config['uri_segment'] = 5;
		$config['base_url'] = '/base/business/index/99/';
		$this->pagination->initialize($config);
		$page = $this->pagination->create_links();

		$data = array(
			'list' => $res['list'],
			'sort' => $this->comm_model->get_menu_info(),
			'key' => $key,
			'page' => $page);
		$this->load->view('header', $page_title = array('page_title' => '商家列表'));
		$this->load->view('base/business_list', $data);
		$this->load->view('footer');
	}

	//新增menu
	public function add_info() {
		$post = $this->input->post();
		if ($post) {
			$post = $this->commfunctions->arrayTrim($post);
			$insertData = array(
				'name' => $post['iftitle'],
				'img_cover' => $post['tpimg'],
				'sort_id' => $post['sort_type']);
			$this->db->trans_start();
			$this->dbcomfunctions->saveData('business', $insertData);
			$this->db->trans_complete();
			redirect('/base/business/index/99/1');exit;
		}

		$data = array('sort' => $this->comm_model->get_menu_info());

		$this->load->view('header', $page_title = array('page_title' => '新增商家'));
		$this->load->view('base/business_add', $data);
		$this->load->view('footer');
	}

	public function edit_info() {
		$businessid = $this->uri->segment('4');
		$post = $this->input->post();
		if ($post) {
			$post = $this->commfunctions->arrayTrim($post);
			$upData = array(
				'set' => array(
					'name' => $post['iftitle'],
					'img_cover' => $post['tpimg'],
					'sort_id' => $post['sort_type']),
				'where' => array(
					'id' => $businessid),
				'limit' => 1);
			$this->db->trans_start();
			$this->dbcomfunctions->updateData('business', $upData);
			$this->db->trans_complete();
			redirect('/base/business/index/99/1');exit;
		}
		$target = $this->business_model->get_business_info($businessid);
		$data = array(
			'target' => $target,
			'sort' => $this->comm_model->get_menu_info());
		$this->load->view('header', $page_title = array('page_title' => '编辑商家'));
		$this->load->view('base/business_edit', $data);
		$this->load->view('footer');
	}

}