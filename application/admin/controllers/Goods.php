<?php if (!defined('BASEPATH')) {
	exit('No direct access script allowed');
}

class Goods extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('goods_model');
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
		$res = $this->goods_model->get_goods_list($condition, $offset, $perpage);
		$config['total_rows'] = $res['total'];
		$config['uri_segment'] = 4;
		$config['base_url'] = '/goods/index/99/';
		$this->pagination->initialize($config);
		$page = $this->pagination->create_links();

		$data = array(
			'list' => $res['list'],
			'key' => $key,
			'page' => $page);

		$this->load->view('header', $page_title = array('page_title' => '商品列表'));
		$this->load->view('goods_list', $data);
		$this->load->view('footer');
	}

	//新增商品
	public function add_info() {
		$post = $this->input->post();
		if ($post) {
			$post = $this->commfunctions->arrayTrim($post);
			$sort = explode('##', $post['sort_id']);
			$insertData = array(
				'business_id' => $post['business_id'],
				'goods_sort_id' => $sort[0],
				'name' => $post['iftitle'],
				'img' => $post['ifimg'],
				'price' => $post['ifprice'],
				'introduce' => $post['ifintroduce']);
			$this->db->trans_start();
			$this->dbcomfunctions->saveData('goods', $insertData);
			$this->db->trans_complete();
			redirect('/goods/index/99/1');exit;
		}

		$business = $this->comm_model->get_business_info();
		$sort = $this->comm_model->get_goods_sort_info(" AND a.`business_id` = {$business[0]['id']}");
		$data = array(
			'business' => $business,
			'sort' => $sort);
		$this->load->view('header', $page_title = array('page_title' => '新增商品'));
		$this->load->view('goods_add', $data);
		$this->load->view('footer');
	}

	//编辑商品
	public function edit_info() {
		$goodsid = $this->uri->segment('3');
		$post = $this->input->post();
		if ($post) {
			$post = $this->commfunctions->arrayTrim($post);
			$sort = explode('##', $post['sort_id']);
			$upData = array(
				'set' => array(
					'business_id' => $post['business_id'],
					'goods_sort_id' => $sort[0],
					'name' => $post['iftitle'],
					'img' => $post['ifimg'],
					'price' => $post['ifprice'],
					'introduce' => $post['ifintroduce']),
				'where' => array(
					'id' => $goodsid),
				'limit' => 1);
			$this->db->trans_start();
			$this->dbcomfunctions->updateData('goods', $upData);
			$this->db->trans_complete();
			redirect('/goods/index/99/1');exit;
		}
		$target = $this->goods_model->get_goods_info($goodsid);
		$business = $this->comm_model->get_business_info();
		$sort = $this->comm_model->get_goods_sort_info(" AND a.`business_id` = {$target['business_id']} ");
		$data = array(
			'target' => $target,
			'business' => $business,
			'sort' => $sort);

		$this->load->view('header', $page_title = array('page_title' => '编辑商品'));
		$this->load->view('goods_edit', $data);
		$this->load->view('footer');
	}

	//AJAX 获取商品分类
	public function get_goods_sort() {
		$businessid = $this->input->post('businessid');
		$res = $this->db->query(" SELECT id,name FROM goods_sort WHERE business_id = {$businessid} ")->result_array();
		$str = '';
		foreach ($res as $lv) {
			$str .= '<option value=' . $lv['id'] . '##' . $lv['name'] . '>' . $lv['name'] . '</option>';
		}
		echo $str;exit;

	}

}