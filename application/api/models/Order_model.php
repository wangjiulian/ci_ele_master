<?php if (!defined('BASEPATH')) {
	exit('No direct access script allowed');
}

/*
 * @Todo:
 * @Author: avery
 * @Date:2018-05-19 10:12:42
 *
 */

class Order_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	public function get_order_info($idstr, $offset, $perpage) {
		$sql = " SELECT * FROM order_info
		WHERE user_id = {$idstr}
		LIMIT {$offset},{$perpage} ";

		$list = $this->db->query($sql)->result_array();
		$target = array();
		foreach ($list as $lv) {
			$order = $lv;
			$id_arr = explode(",", $lv['goods_idstr']);
			$num_arr = explode(",", $lv['goods_numstr']);
			$price_arr = explode(",", $lv['goods_pricestr']);
			$good_arr = array();
			$i = 0;
			foreach ($id_arr as $id) {
				$good = $this->db->query(" SELECT * FROM goods WHERE id = {$id} ")->row_array();
				$good['price'] = $price_arr[$i];
				$good['num'] = $num_arr[$i];
				$good['img'] = IMG_URL . $good['img'];
				$good_arr[] = $good;
				$i++;
			}
			$order['good'] = $good_arr;
			unset($order['goods_idstr']);
			unset($order['goods_numstr']);
			unset($order['goods_pricestr']);
			$target[] = $order;
		}

		return $target;
	}
}
