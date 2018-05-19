<?php if (!defined('BASEPATH')) {
	exit('No direct access script allowed');
}

class Comm_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	//获取商品分类
	public function get_menu_info() {
		$target = array();
		$sql = " SELECT * FROM business_sort a WHERE 1 ";
		$res = $this->db->query($sql)->result_array();
		foreach ($res as $lv) {
			$target[$lv['id']] = $lv['name'];
		}
		return $target;
	}

	//获取商家
	public function get_business_info($condition = '') {
		$sql = " SELECT * FROM business a WHERE 1 ";
		if ($condition) {
			$sql .= $condition;
		}
		$res = $this->db->query($sql)->result_array();
		return $res;
	}

	//获取商品分类
	public function get_goods_sort_info($condition = '') {
		$sql = " SELECT * FROM goods_sort a WHERE 1 ";
		if ($condition) {
			$sql .= $condition;
		}
		$res = $this->db->query($sql)->result_array();
		return $res;
	}

}