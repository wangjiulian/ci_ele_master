<?php
/*
 * @Todo:
 * @Author: avery
 * @Date:2018-05-19 10:20:30
 *
 */

class Info_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	//获取商家分类
	public function get_business_sort() {
		$sql = " SELECT * FROM business_sort WHERE 1 ";
		$list = $this->db->query($sql)->result_array();
		return $list;
	}

	//获取商家
	public function get_business($idstr, $offset, $perpage) {
		$sql = " SELECT * FROM business
		WHERE sort_id = {$idstr}
		LIMIT {$offset}, {$perpage} ";
		$list = $this->db->query($sql)->result_array();
		return $list;
	}

	//获取商品
	public function get_goods($idstr) {
		$target = array();
		//获取商品分类
		$sortRes = $this->get_goods_sort($idstr);
		foreach ($sortRes as $sort) {
			$data = array();
			$goods_res = $this->get_goods_with_businessid_with_sortid($idstr, $sort['id']);
			$goods_list = array();
			foreach ($goods_res as $good) {
				$goods_list[] = array(
					'id' => $good['id'],
					'name' => $good['name'],
					'img' => $good['img'],
					'price' => $good['price'],
					'introdue' => $good['introduce']);
			}
			$data['title'] = $sort['name'];
			$data['goods'] = $goods_list;
			$target[] = $data;
		}
		return $target;
	}

	//获取商品分类
	public function get_goods_sort($idstr) {
		$sql = " SELECT * FROM goods_sort
		WHERE business_id = {$idstr} ";
		$list = $this->db->query($sql)->result_array();
		return $list;
	}

	//获取商品
	public function get_goods_with_businessid_with_sortid($business_id, $sort_id) {
		$sql = " SELECT * FROM goods WHERE 1 ";
		if ($business_id) {
			$sql .= " AND business_id = {$business_id} ";
		}
		if ($sort_id) {
			$sql .= " AND goods_sort_id = {$sort_id} ";
		}
		$list = $this->db->query($sql)->result_array();
		return $list;

	}

}
