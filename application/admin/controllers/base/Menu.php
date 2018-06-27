<?php if (!defined('BASEPATH')) {
	exit('No direct access script allowed');
}

class Menu extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('menu_model');
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
		$res = $this->menu_model->get_menu_list($condition, $offset, $perpage);
		$config['total_rows'] = $res['total'];
		$config['uri_segment'] = 5;
		$config['base_url'] = '/base/menu/index/99/';
		$this->pagination->initialize($config);
		$page = $this->pagination->create_links();

		$data = array(
			'list' => $res['list'],
			'key' => $key,
			'page' => $page);
		$this->load->view('header', $page_title = array('page_title' => '菜单栏'));
		$this->load->view('base/menu_list', $data);
		$this->load->view('footer');
	}

	//新增menu
	public function add_info() {
		$post = $this->input->post();
		if ($post) {
			$post = $this->commfunctions->arrayTrim($post);

			$insertData = array(
				'name' => $post['iftitle'],
				'img' => $post['tpimg']);
			$this->db->trans_start();
			$this->dbcomfunctions->saveData('business_sort', $insertData);
			$this->db->trans_complete();
			redirect('/base/menu/index/99/1');exit;
		}

		$this->load->view('header', $page_title = array('page_title' => '新增Menu'));
		$this->load->view('base/menu_add');
		$this->load->view('footer');

	}

	public function edit_info() {
		$menuid = $this->uri->segment('4');
		$post = $this->input->post();
		if ($post) {
			$post = $this->commfunctions->arrayTrim($post);
			$upData = array(
				'set' => array(
					'name' => $post['iftitle'],
					'img' => $post['tpimg']),
				'where' => array(
					'id' => $menuid),
				'limit' => 1);
			$this->db->trans_start();
			$this->dbcomfunctions->updateData('business_sort', $upData);
			$this->db->trans_complete();
			redirect('/base/menu/index/99/1');exit;
		}
		$target = $this->menu_model->get_menu_info($menuid);
		$data = array('target' => $target);
		$this->load->view('header', $page_title = array('page_title' => '编辑menu'));
		$this->load->view('base/menu_edit', $data);
		$this->load->view('footer');
	}

}
