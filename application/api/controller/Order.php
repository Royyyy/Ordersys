<?php
/**
 * Created by PhpStorm.
 * User: chok
 * Date: 2018/1/5
 * Time: 23:54
 */

namespace app\api\controller;
use think\Db;
use think\Controller;

class Order extends Controller
{
	/**
	 * 设定桌号功能
	 * @param $tableId		桌号
	 */
	public function setTableNumI($tableId){

	}

	/**
	 * 点餐功能
	 * @param $orderData	菜单内容
	 */
	public function orderI($orderData){

	}

	/**
	 * 买单功能
	 * @param $orderId		订单id
	 */
	public function payI($orderId){

	}

	/**
	 * 订单结单功能(0-正在用餐，1-准备结账，2-已经结账，3-免单订单)
	 * @param $orderId		订单id
	 * @param $orderState	订单状态
	 */
	public function orderEndI($orderId,$orderState){

	}

	/**
	 * 准备结账功能
	 * @param $orderId		订单id
	 */
	public function orderReadyI($orderId){

	}

}