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
		$res = $this->db->query($sql)->result_array();
		return $res;
	}
}
