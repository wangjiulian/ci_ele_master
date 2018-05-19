<?php if (!defined('BASEPATH')) {
	exit('No direct access script allowed');
}

class Dbcomfunctions {

	public function __construct() {
		$this->CI = &get_instance();
	}

	//新增一条数据
	public function saveData($table, $data) {
		$this->CI->db->insert($table, $data);
		return $this->CI->db->insert_id();
	}

	//批量增加
	public function saveBatch($table, $data) {
		$this->CI->db->insert_batch($table, $data);
		return TRUE;
	}

	//更新一条
	public function updateData($table, $data) {
		$bool = $this->CI->db->update($table, $data['set'], $data['where'], $data['limit']);
		return $bool;
	}

	//删除
	public function delData($table, $data) {
		$bool = $this->CI->db->delete($table, $data['where'], $data['limit']);
		return $bool;
	}
}
