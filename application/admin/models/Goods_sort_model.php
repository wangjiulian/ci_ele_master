<?php if (!defined('BASEPATH')) {
	exit('No direct access script allowed');
}

/*
 * @Todo:
 * @Author: avery
 * @Date:2018-05-08 09:12:18
 *
 */

class Goods_sort_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	//获取商品分类
	public function get_goods_sort_list($condition, $offset, $perpage) {
		$sql = " SELECT a.`name`,a.`id`,b.`name` business_name
		FROM goods_sort a LEFT JOIN business b ON a.business_id = b.id WHERE 1 ";
		$all = $this->db->query($sql)->result_array();
		$total = count($all);
		if ($condition) {
			$sql .= $condition;
		}
		$sql .= " LIMIT {$offset},{$perpage} ";
		$list = $this->db->query($sql)->result_array();
		$res = array(
			'list' => $list,
			'total' => $total);
		return $res;
	}

	public function get_goods_sort_info($idstr) {
		$sql = " SELECT * FROM goods_sort
		WHERE  id = {$idstr} ";
		$res = $this->db->query($sql)->row_array();
		return $res;
	}

}
