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

		$orderBeginDate = strtotime(date("Y-m-d H:i:s"));
		$data=['orderBeginDate'=>$orderBeginDate,'waiterId'=>$waiterId,'orderState'=>0,'tableId'=>$tableId];
//		$data=[$orderBeginDate,0,0,$tableId];
		$result = Db::table('order')->insert($data);
		$orderId = Db::table('order')->getLastInsID();
		
	
//		$this->assign('orderId',$orderId);
		if ($result!=0){
			$result2 = Db::table('table')->where(['tableId' => $tableId])->update(['tableState'=>1]);
			return show(intval($orderId));
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

		$data = Db::table('orderdishes')->join('dishes d','orderdishes.dishes = d.dishesId')->join('order','order.orderId = orderdishes.orderId')->join('user u','order.waiterId = u.userId')->field('orderdishes.*,d.dishesPrice,d.dishesName,u.userAccount,order.orderBeginDate,order.orderEndDate,order.tableId,order.price')->where(['orderdishes.orderId'=>$orderId])->find();
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

		$data = Db::table('order')->select();
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
		$result = Db::table('order')->where('orderId',$orderId)->update(['orderState'=>$orderState]);
		$tableId = Db::table('order')->where('orderId',$orderId)->select();
		$result2 = Db::table('table')->where('tableId' ,$tableId[0]['tableId'])->update(['tableState'=>0]);
		
		if ($result != 0) {
			return show($result);
		} else {
			return show(2);
		}
	}
	public function cartAdd($orderData){
		$data = json_decode($orderData,true);
		$count = count($data);
		$price = 0;
		for($i=0;$i<$count;$i++){
			$od = ['orderId'=>$data[$i]['orderId'],'dishes'=>$data[$i]['dishesId'],'num'=>$data[$i]['number'],'state'=>0];
			$result = Db::table('orderdishes')->insert($od);
			$price = ($data[$i]['price']*$data[$i]['number'])+$price;
		
		}
		$pri = Db::table('order')->where(['orderId'=>$data[0]['orderId']])->update(['price'=>$price]);
		
		if ($result) {
			return show($result);
		}else{
			return show('null');
		}
		
	}


}