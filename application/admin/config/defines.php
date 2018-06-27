<?php if (!defined('BASEPATH')) {
	exit('No direct access script allowed');
}

$config = array();

define('HOSTDOMAIN', 'http://' . $_SERVER['HTTP_HOST']);
// define('HOSTDOMAIN', 'http://admin.wechat.com');

define('PERPAGE', 10); //分页

define('ADMINTMP', 'theme/adminlte'); //theme

define('HASHVERIFY', '$2y$10$tQg0gmwqSKSGdeUllLGPR.gN66kktrTLkJc29JJLM0pxbTATXgSu6'); //加密字符串
