<?php

/*
 * @Todo:
 * @Author: avery
 * @Date:2018-05-08 14:03:10
 *
 */

class Goods_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	//获取商品分类
	public function get_goods_list($condition, $offset, $perpage) {
		$sql = "SELECT  a.*,b.`name` as business_name,c.`name` as sort_name
		FROM goods a LEFT JOIN business b ON a.business_id = b.id
		LEFT JOIN goods_sort c ON a.goods_sort_id = c.id WHERE 1 ";
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

	public function get_goods_info($idstr) {
		$sql = " SELECT * FROM goods WHERE id = {$idstr} ";
		$res = $this->db->query($sql)->row_array();
		return $res;
	}
}