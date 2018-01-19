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
	public function setTableNumI($tableId,$waiterId){
		$order = model('Order');
		$orderBeginDate = strtotime(date("Y-m-d H:i:s"));
		$data=['orderBeginDate'=>$orderBeginDate,'waiterId'=>$waiterId,'orderState'=>0,'tableId'=>$tableId];
//		$data=[$orderBeginDate,0,0,$tableId];
		$result = $order->insert($data);
		$orderId = $order->getLastInsID();
		$result2 = Db::table('table')->where(['tableId' => $tableId])->update(['tableState'=>1]);
//		$this->assign('orderId',$orderId);
		if ($result && $result2 !=0){
			return show($orderId);
		}else{
			return show('null');
		}
//		return view('user/main');
	}

	/**
	 * 显示订单功能
	 *
	 */
	public function showOrderI($orderId){

		$data = Db::table('orderdishes')->alias('od')->join('dishes d','od.dishes = d.dishesId')->field('od.*,d.dishesName')->where(['od.orderId'=>$orderId])->select();
		if ($data != null) {
			return show($data);

		} else {
			return show('null');
		}
	}

	/**
	 * 显示订单列表功能
	 *
	 */
	public function showOrderListI(){
		$order = model('Order');
		$data = $order->select();
		if ($data != null) {
			return show($data);

		} else {
			return show('null');
		}
	}




	/**
	 * 订单结单功能(0-正在用餐，1-准备结账，2-已经结账，3-免单订单)
	 * @param $orderId		订单id
	 * @param $orderState	订单状态
	 */
	public function orderEndI($orderId,$orderState){
		$order = model('Order');
		$result = $order->where('orderId',$orderId)->update('orderState',$orderState);
		$tableId = $order->where('orderId',$orderId)->select('tableId');
		$result2 = Db::table('table')->where(['tableId' => $tableId])->update('tableState',1);
		if ($result != 0) {
			return show($result);
		} else {
			return show('null');
		}
	}



}