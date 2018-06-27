<?php if (!defined('BASEPATH')) {
	exit('No direct access script allowed');
}

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
	//上传文件配置
	private function set_upload_options($path) {
		if (!file_exists($path)) {
			$this->mkpath($path);
		}
		//upload image option
		$config['upload_path'] = '.' . $path;
		$config['allowed_types'] = 'jpg|jpeg|png|doc|txt|mp4|svg|flv|zip|mov';
		$config['max_size'] = 1024 * 10;
		$config['max_width'] = 1024 * 5;
		$config['max_height'] = 1024 * 5;
		$config['encrypt_name'] = TRUE;
		return $config;
	}

	public function uploadFile($param, $path = '/uploads/tmp/') {
		$this->CI->load->library('upload', $this->set_upload_options($path));
		if (!$this->CI->upload->do_upload($param)) {
			$error = array('error' => $this->CI->upload->display_errors());
			return $error;
		} else {
			$tpdata = $this->CI->upload->data();
			$end = substr($tpdata['file_name'], strpos($tpdata['file_name'], '.'));
			if (in_array($end, array('.jpg', '.jpeg', '.png', '.svg'))) {
				$this->thumbimg($path . $tpdata['file_name']);
			}
			return array($path . $tpdata['file_name']);
		}

	}

	// 缩略图
	public function thumbimg($path, $width = 320, $height = 320) {
		$firstStr = mb_substr($path, 0, 1);
		if ($firstStr != '.') {
			$path = '.' . $path;
		}
		$fileName = mb_substr($path, strrpos($path, '/') + 1);

		$config['image_library'] = 'gd2';
		$config['source_image'] = $path;
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['width'] = $width;
		$config['height'] = $height;
		$config['thumb_marker'] = '';
		$config['new_image'] = 'thumb_' . $fileName;
		// var_dump($config['new_image']);exit;
		$this->CI->load->library('image_lib');
		$this->CI->image_lib->initialize($config);

		if (!$this->CI->image_lib->resize()) {
			return $this->CI->image_lib->display_errors();exit;
		}
		return TRUE;
	}

}
