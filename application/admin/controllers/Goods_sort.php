<?php if (!defined('BASEPATH')) {
	exit('No direct access script allowed');
}

class Goods_sort extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('goods_sort_model');
		$this->load->model('comm_model');
	}

	public function index() {
		$offset = $this->uri->segment('4') ? ($this->uri->segment('4') - 1) * PERPAGE : 0;
		$perpage = PERPAGE;
		$key = $this->input->post('q');
		if ($key) {
			$key = addslashes(trim($key));
			$condition = " AND a.`name` like '%" . $key . "%'";
		} else {
			$condition = '';
		}

		//分页
		$res = $this->goods_sort_model->get_goods_sort_list($condition, $offset, $perpage);
		$config['total_rows'] = $res['total'];
		$config['uri_segment'] = 4;
		$config['base_url'] = '/goods_sort/index/99/';
		$this->pagination->initialize($config);
		$page = $this->pagination->create_links();

		$data = array(
			'list' => $res['list'],
			'key' => $key,
			'page' => $page);

		$this->load->view('header', $page_title = array('page_title' => '商品分类'));
		$this->load->view('goods_sort_list', $data);
		$this->load->view('footer');
	}

	//新增商品分类
	public function add_info() {
		$post = $this->input->post();
		if ($post) {
			$post = $this->commfunctions->arrayTrim($post);
			$business = explode('##', $post['business_id']);
			$insertData = array(
				'business_id' => $business[0],
				'name' => $post['iftitle']);
			$this->db->trans_start();
			$this->dbcomfunctions->saveData('goods_sort', $insertData);
			$this->db->trans_complete();
			redirect('/goods_sort/index/99/1');exit;
		}

		$data = array(
			'business' => $this->comm_model->get_business_info());
		$this->load->view('header', $page_title = array('page_title' => '新增商品分类'));
		$this->load->view('goods_sort_add', $data);
		$this->load->view('footer');
	}

	public function edit_info() {
		$sortid = $this->uri->segment('3');
		$post = $this->input->post();
		if ($post) {
			$post = $this->commfunctions->arrayTrim($post);
			$business = explode('##', $post['business_id']);
			$upData = array(
				'set' => array(
					'business_id' => $business[0],
					'name' => $post['iftitle']),
				'where' => array(
					'id' => $sortid),
				'limit' => 1);
			$this->db->trans_start();
			$this->dbcomfunctions->updateData('goods_sort', $upData);
			$this->db->trans_complete();
			redirect('/goods_sort/index/99/1');exit;
		}
		$target = $this->goods_sort_model->get_goods_sort_info($sortid);
		$data = array(
			'target' => $target,
			'business' => $this->comm_model->get_business_info());
		$this->load->view('header', $page_title = array('page_title' => '编辑分类'));
		$this->load->view('goods_sort_edit', $data);
		$this->load->view('footer');
	}

	//获取商家
	public function bussniess_info() {
		$key = $this->input->post('q');
		if ($key) {
			$key = addslashes(trim($key));
			$condition = " AND a.name LIKE '%" . $key . "%' ";
		} else {
			$condition = '';
		}
		$res = $this->comm_model->get_business_info($condition);
		$str = '';
		foreach ($res as $lv) {
			$str .= '<option value=' . $lv['id'] . '##' . $lv['name'] . '>' . $lv['name'] . '</option>';
		}
		echo $str;exit;
	}
}