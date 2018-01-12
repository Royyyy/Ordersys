<?php
/**
 * Created by PhpStorm.
 * User: chok
 * Date: 2018/1/8
 * Time: 14:38
 */

namespace app\index\controller;

use think\Db;
use think\Controller;

class Order extends Controller
{
	function __construct()
	{
		parent::__construct();
	}
	public function index(){
		return view('user');
	}

	/**
	 * 设定桌号功能
	 * @param $tableId		桌号
	 */
	public function setTableNum($tableId,$waiterId){
		$order = model('Order');
		$orderBeginDate = strtotime(date("Y-m-d H:i:s"));
		$data=[$orderBeginDate,$waiterId,0,$tableId];
		$result = $order->insert($data);
		$orderId = $order->getLastInsID();
		$this->assign('orderId',$orderId);
		return view();
	}

	/**
	 * 点餐功能
	 * @param $orderData	菜单内容
	 */
	public function cartAdd($orderData){
		$order = model('Order');
		$orderId = $orderData['orderId'];
		$result = Db::table('orderdishes')->insert($orderData);
		if ($result) {
			return 1;
		}else{
			return 2;
		}
	}

	/**
	 * 专门设置给外带的客人
	 * @param $orderData
	 */
	public function orderWaiMai($waiterId){
		$order = model('Order');
		$orderBeginDate = strtotime(date("Y-m-d H:i:s"));
		$data=[$orderBeginDate,$waiterId,0];
		$result = $order->insert($data);
		$orderId = $order->getLastInsID();
		$this->assign('orderId',$orderId);
		return view();
	}
	/**
	 * 买单功能
	 * @param $orderId		订单id
	 */
	public function pay($orderId){

	}

	/**
	 * 订单结单功能(0-正在用餐，1-准备结账，2-已经结账，3-免单订单)
	 * @param $orderId		订单id
	 * @param $orderState	订单状态
	 */
	public function orderEnd($orderId,$orderState){

	}

	/**
	 * 准备结账功能
	 * @param $orderId		订单id
	 */
	public function orderReady($orderId){

	}

	/**
	 * 通过订单的状态来判断是否为空桌子
	 */
	public function showTableState(){

	}
}