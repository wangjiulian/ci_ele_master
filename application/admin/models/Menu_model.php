<?php if (!defined('No direct access script allowed'));

class Menu_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	public function get_menu_list($condition, $offset, $perpage) {
		$sql = " SELECT * FROM business_sort a WHERE 1 ";
		if ($condition) {
			$sql .= $condition;
		}
		$all = $this->db->query($sql)->result_array();
		$total = count($all);
		$sql .= " LIMIT $offset,$perpage ";
		$list = $this->db->query($sql)->result_array();
		$res = array(
			'list' => $list,
			'total' => $total);

		return $res;
	}

	public function get_menu_info($idstr) {
		$sql = " SELECT * FROM business_sort
		WHERE  id = {$idstr} ";
		$res = $this->db->query($sql)->row_array();
		return $res;
	}
}