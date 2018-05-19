<?php if (!defined('BASEPATH')) {
	exit('No direct access script allowed');
}

class Commfunctions {
	function __construct() {
		$this->CI = &get_instance();
	}

	//去除提交数组空格
	public function arrayTrim($data) {
		if (is_array($data)) {
			$res = array();
			foreach ($data as $key => $value) {
				if (is_array($value)) {
					$accept = $this->arrayTrim($value);
				} else {
					$accept = trim($value);
				}
				$res[$key] = $accept;
			}
			return $res;

		} else {
			return trim($data);
		}

	}

}
