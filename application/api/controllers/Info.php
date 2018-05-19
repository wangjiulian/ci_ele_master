<?php if (!defined('BASEPATH')) {
	exit('No direct access script allowed');
}

/*
 * @Todo:
 * @Author: avery
 * @Date:2018-05-19 10:18:30
 *
 */

class Info extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('info_model');
	}

	/**
	 * @api {POST} http://api.wangjl.work/Info/menu_sort 获取主页菜单分类
	 * @apiName menu_sort
	 * @apiGroup Info
	 * @apiVersion 1.0.0
	 * @apiDescription 获取主页菜单分类
	 * @apiPermission anyone
	 * @apiSampleRequest http://api.wangjl.work/Info/menu_sort
	 *
	 *
	 * @apiParamExample {jsonp} Request Example
	 *   POST /Info/menu_sort
	 *   {
	 *      "code": "success",
	 *      "re_info": [
	 *       {
	 *         "id": "3",
	 *         "name": "甜品饮品",
	 *         "img": "https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1525669536243&di=c99787f72e7708b6732bbdda82063502&imgtype=0&src=http%3A%2F%2Fimg3.redocn.com%2Ftupian%2F20141224%2Fyinliao_3755500.jpg"
	 *       },
	 *      {
	 *         "id": "4",
	 *         "name": "商超便利",
	 *         "img": "https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1525669536243&di=c99787f72e7708b6732bbdda82063502&imgtype=0&src=http%3A%2F%2Fimg3.redocn.com%2Ftupian%2F20141224%2Fyinliao_3755500.jpg"
	 *      }
	 *     ]
	 *   }
	 *
	 */

	public function menu_sort() {
		$res = $this->info_model->get_business_sort();
		if (empty($res)) {
			$this->apifunction->show_json_msg('empty', $res);exit;
		}
		$this->apifunction->show_json_msg('success', $res);
	}

	/**
	 * @api {POST} http://api.wangjl.work/Info/business 获取商家
	 * @apiName business
	 * @apiGroup Info
	 * @apiVersion 1.0.0
	 * @apiDescription 获取商家
	 * @apiPermission anyone
	 * @apiSampleRequest http://api.wangjl.work/Info/business
	 *
	 * @apiParam {string} sort_id （必填）菜单分类id
	 *
	 * @apiParamExample {jsonp} Request Example
	 *   POST /Info/business
	 *   {
	 *      "code": "success",
	 *      "re_info": [
	 *       {
	 *          "id": "1",
	 *          "sort_id": "3",//分类id
	 *          "name": "沙县小吃",//商家名称
	 *          "img_cover": "https://ss0.bdstatic.com/70cFuHSh_Q1YnxGkpoWK1HF6hhy/it/u=1665207864,746409922&fm=27&gp=0.jpg",//商家封面
	 *          "lift_fee": "10",//起送费
	 *          "dispatch_fee": "2",//配送费
	 *          "colligate_score",//综合评分
	 *          "service_attitude": "0.0",//服务态度
	 *          "dishes_evaluate": "0.0",//商品评价
	 *          "notice": "通告"//商家通告
	 *        }
	 *      ]
	 *    }
	 *
	 */

	public function business() {
		$sort_id = (int) $this->input->post('sort_id');
		$offset = $this->input->post('page') ? (int) $this->input->post('page') * 10 : 0;
		if (empty($sort_id)) {
			$this->apifunction->show_json_msg('error', '请求无效，请联系客服');exit;
		}
		$res = $this->info_model->get_business($sort_id, $offset, 10);
		if (empty($res)) {$this->apifunction->show_json_msg('empty', $res);exit;}
		$this->apifunction->show_json_msg('success', $res);
	}

	/**
	 * @api {POST} http://api.wangjl.work/Info/goods 获取商品
	 * @apiName goods
	 * @apiGroup Info
	 * @apiVersion 1.0.0
	 * @apiDescription 获取商品
	 * @apiPermission anyone
	 * @apiSampleRequest http://api.wangjl.work/Info/goods
	 *
	 * @apiParam {string} business_id （必填）商家id
	 *
	 * @apiParamExample {jsonp} Request Example
	 *   POST /Info/goods
	 *   {
	 *      "code": "success",
	 *      "re_info": [
	 *       {
	 *          "title": "小吃",//商品分类
	 *          "goods": [
	 *           {
	 *             "id": "1",
	 *             "name": "拌面",//商品名称
	 *             "img": "http://img0.imgtn.bdimg.com/it/u=799415717,1915037875&fm=27&gp=0.jpg",//商品图片
	 *            "price": "1.00",//商品价格
	 *            "introduce": "拌面介绍"//商品介绍
	 *           },
	 *          {
	 *          "id": "3",
	 *          "name": "馄饨",
	 *          "img": "https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1525709688466&di=42016b9ac15652a5c29b929c1b008e73&imgtype=0&src=http%3A%2F%2Fpic.qiantucdn.com%2F58pic%2F22%2F91%2F94%2F57ea52806026b_1024.jpg",
	 *          "price": "1.00",
	 *          "introduce": "馄饨介绍"
	 *           }
	 *         ]
	 *      }
	 *     ]
	 *    }
	 *
	 */
	public function goods() {
		$business_id = (int) $this->input->post('business_id');
		if (empty($business_id)) {
			$this->apifunction->show_json_msg('error', '请求无效，请联系客服');exit;
		}
		$res = $this->info_model->get_goods($business_id);
		if (empty($res)) {$this->apifunction->show_json_msg('empty', $res);exit;}
		$this->apifunction->show_json_msg('success', $res);
	}
}
