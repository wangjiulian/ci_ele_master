<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2009, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */
// ------------------------------------------------------------------------

/**
 * System Functions Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		Admin
 */
class Commfunctions {
	function __construct() {
		$this->CI = &get_instance();
	}

	/**
	 *
	 * 创建多级目录
	 *
	 * @access public
	 * @param mkpath 创建目录的路径
	 * @param mode 目录权限
	 */
	public function mkpath($mkpath, $mode = 0777) {
		$path_arr = explode('/', $mkpath);
		foreach ($path_arr as $value) {
			if (!empty($value)) {
				if (empty($path)) {
					$path = $value;
				} else {
					$path .= '/' . $value;
				}
				is_dir($path) OR mkdir($path, $mode);
			}
		}

	}

}