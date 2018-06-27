<?php if (!defined('BASEPATH')) {
	exit('No direct access script allowed');
}

/*
 * @Todo:
 * @Author: avery
 * @Date:2018-05-19 10:10:14
 *
 */

class Order extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('order_model');
	}

	/**
	 * @api {POST} http://api.wangjl.work/order/make_order 下单
	 * @apiName make_order
	 * @apiGroup order
	 * @apiVersion 1.0.0
	 * @apiDescription 下单
	 * @apiPermission anyone
	 * @apiSampleRequest http://api.wangjl.work/order/make_order
	 *
	 * @apiParam {string} user_id （必填）用户id
	 * @apiParam {string} business_id （必填）商店id
	 * @apiParam {string} goods_idstr （必填）商品id字符串，多个商品逗号隔开
	 * @apiParam {string} goods_numstr （必填）商品数量串，多个商品逗号隔开
	 * @apiParam {string} goods_pricestr （必填）商品价格字符串，多个商品逗号隔开
	 * @apiParam {string} lift_fee （必填）配送费
	 * @apiParam {string} total_price （必填）总价
	 *
	 * @apiParamExample {jsonp} Request Example
	 *   POST /test_ele/make_order
	 *  {
	 *"code": "success",
	 *"re_info": "下单成功"
	 *}
	 *
	 */
	public function make_order() {
		$user_id = $this->get_m_post('user_id', true);
		$business_id = $this->get_m_post('business_id', true);
		$goods_idstr = $this->get_m_post('goods_idstr', true);
		$goods_numstr = $this->get_m_post('goods_numstr', true);
		$goods_pricestr = $this->get_m_post('goods_pricestr', true);
		$lift_fee = $this->get_m_post('lift_fee', true);
		$total_price = $this->get_m_post('total_price', true);

		if (empty($user_id) || empty($business_id) || empty($goods_idstr) || empty($goods_numstr) || empty($goods_pricestr) || empty($lift_fee) || empty($total_price)) {
			$this->apifunction->show_json_msg('error', '参数不足');
			exit;
		}
		$order_num = md5($user_id . $business_id . time());
		$inserData = array(
			'user_id' => $user_id,
			'business_id' => $business_id,
			'goods_idstr' => $goods_idstr,
			'goods_numstr' => $goods_numstr,
			'goods_pricestr' => $goods_pricestr,
			'lift_fee' => $lift_fee,
			'total_price' => $total_price,
			'order_num' => $order_num,
			'create_time' => time());
		$this->db->trans_start();
		$this->apifunction->saveData('order_info', $inserData);
		$this->db->trans_complete();
		$this->apifunction->show_json_msg('success', '下单成功');
	}

/**
 * @api {POST} http://api.wangjl.work/order/order_info 用户订单
 * @apiName order_info
 * @apiGroup order
 * @apiVersion 1.0.0
 * @apiDescription 用户订单
 * @apiPermission anyone
 * @apiSampleRequest http://api.wangjl.work/order/order_info
 *
 * @apiParam {string} user_id （必填）用户id
 * @apiParam {string} page （非必填）默认0
 *
 * @apiParamExample {jsonp} Request Example
 *   POST /test_ele/order_info
 *   {
 *   "code": "success",
 *   "re_info": [
 *        {
 *           "id": "1",//订单id
 *           "user_id": "1",//用户id
 *           "business_id": "2",//商家id
 *           "lift_fee": "6",//配送费
 *           "total_price": "7",//总价
 *           "order_num": "6513dbe76cd0050b502218b3e9a80061",//订单号
 *           "pay_style": "1",//'1 在线支付'
 *           "pay_type": "1",// '1 微信',
 *           "nick_name": "",//昵称
 *           "mobile": "",//手机号
 *           "address": "",//地址
 *           "create_time": "1526644808",//下单时间
 *           "good": [
 *               {
 *                   "id": "1",//商品id
 *                   "business_id": "2",//商家id
 *                   "goods_sort_id": "5",//商品分类
 *                   "name": "拌面",//商品名称
 *                   "img": "http://img0.imgtn.bdimg.com/it/u=799415717,1915037875&fm=27&gp=0.jpg",//商品图片
 *                   "price": "5",//商品价格
 *                   "introduce": "拌面",//商品简介
 *                   "num": "4"//购买商品数量
 *              }
 *           ]
 *       }
 *   ]
 *}
 *
 */
	public function order_info() {
		$user_id = $this->get_m_post('user_id', true);
		$perpage = 10;
		$offset = $this->get_m_post('page', true) ? ((int) $this->get_m_post('page', true) - 1) * $perpage : 0;
		if (empty($user_id)) {
			$this->apifunction->show_json_msg('error', '参数不足');
			exit;
		}
		$res = $this->order_model->get_order_info($user_id, $offset, $perpage);
		if (empty($res)) {
			$this->apifunction->show_json_msg('empty', $res);
			exit;
		}
		$this->apifunction->show_json_msg('success', $res);
		exit;
	}

}
