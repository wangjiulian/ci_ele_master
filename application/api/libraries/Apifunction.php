<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}
/*
 * @Todo:
 * @Author: avery
 * @Date:2018-04-28 14:11:56
 *
 */

/**
 *
 */
class Apifunction {

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

	/**
	 * [showJsonMsg 输出json格式数据]
	 * @param  String $st                  [返回状态'success','error']
	 * @param  String $msg                 [反馈信息]
	 * @return Null
	 */
	public function show_json_msg($st, $info) {
		header("Content-type: application/json;charset=utf-8");
		echo json_encode(array('code' => $st, 're_info' => $info));
		return FALSE;
	}

}