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
use think\Session;

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
		$data=['orderBeginDate'=>$orderBeginDate,'waiterId'=>$waiterId,'orderState'=>0,'tableId'=>$tableId];
//		$data=[$orderBeginDate,0,0,$tableId];
		$result = $order->insert($data);
		$orderId = $order->getLastInsID();
		$result2 = Db::table('table')->where(['tableId' => $tableId])->update(['tableState'=>1]);
		Session::set('orderBeginDate',date("Y-m-d H:i:s"));
		Session::set('orderId',$orderId);

		if ($result){
			$this->success('选择桌子成功');
		} else {
			$this->error('选择桌子失败');
		}
//		return view('user/main');
	}

	/**
	 * 点餐功能
	 * @param $orderData	菜单内容
	 */
	public function orderAdd($orderId,$price){
		$order = model('Order');
		$cart = Db::table('cart')->where(['orderId'=>$orderId])->field('orderId,dishes,num')->select();
		$orderRes = $order->where(['orderId'=>$orderId])->Update(['price'=>$price]);
		$result = Db::table('orderdishes')->insertAll($cart);
		if ($result){
			$cart = Db::table('cart')->where(['orderId'=>$orderId])->delete();
			if ($cart){
				$this->success('点餐成功');
			}else{
				$this->error('点餐失败');
			}
		}else{
			$this->error('点餐失败');
		}

//		$orderData = ['orderId'=>$orderId,'dishes'=>$dishes,'num'=>$num];
//		$result = Db::table('orderdishes')->insert($orderData);

	}


//
//	/**
//	 * 专门设置给外带的客人
//	 * @param $orderData
//	 */
//	public function orderWaiMai($waiterId){
//		$order = model('Order');
//		$orderBeginDate = strtotime(date("Y-m-d H:i:s"));
//		$data=[$orderBeginDate,$waiterId,0];
//		$result = $order->insert($data);
//		$orderId = $order->getLastInsID();
//		$this->assign('orderId',$orderId);
//		return view();
//	}

	/**
	 * 显示订单列表
	 */
	public function showOrder(){

//		$data = $order->paginate(10);
		$data = Db::table('order')->join('user u','order.waiterId = u.userId')->field('order.*,u.userAccount')->select();
		for ($i=0;$i<count($data);$i++){
			if ($data[$i]['orderState'] == 0){
				$data[$i]['orderState'] = '未付款';
			}elseif ($data[$i]['orderState'] == 1){
				$data[$i]['orderState'] = '已付款';
			}elseif ($data[$i]['orderState'] == 2){
				$data[$i]['orderState'] = '免单';
			}

		}
		$this->assign('data',$data);
		return view();
	}

	/**
	 * 查看订单详细情况
	 * @param $orderId		订单id
	 */
	public function orderDetail($orderId){
		$order = model('Order');
		$data = $order->where(['orderId' => $orderId])->select();
		$this->assign('data',$data);
		return view();
	}

	/**
	 * 订单结单功能(0-正在用餐，1-准备结账，2-已经结账，3-免单订单)
	 * @param $orderId		订单id
	 * @param $orderState	订单状态
	 */
	public function orderEnd($orderId,$orderState){
		$order = model('Order');
		$result = $order->where('orderId',$orderId)->update('orderState',$orderState);
		$tableId = $order->where('orderId',$orderId)->select('tableId');
		$result2 = Db::table('table')->where(['tableId' => $tableId])->update('tableState',1);
		if ($result != 0) {
			$this->success('订单结单成功');
		} else {
			$this->error('订单结单失败');
		}
	}



	/**
	 * 通过订单的状态来判断是否为空桌子
	 */
	public function showTableState(){
		$order = model('Order');
		$table = Db::table('table')->where('tableState',0)->select();
		$this->assign('table',$table);
		return view('user/table');
		//		return $this->fetch('user/table',['table'=>$table]);
	}

	/**
	 * 点击菜品放进购物车功能
	 * @param $dishes		菜品Id
	 * @param $orderId		订单Id
	 * @return \think\response\View
	 */

	public function cart($dishes,$orderId){
		$result = Db::table('cart')->where(['dishes'=>$dishes,'orderId'=>$orderId])->select();
		if ($result){
			$result2 = Db::table('cart')->where(['dishes'=>$dishes,'orderId'=>$orderId])->setInc('num',1);
		}else{
			$data = ['dishes'=>$dishes,'orderId'=>$orderId,'num'=>1];
			$result = Db::table('cart')->insert($data);
		}
		$result3 = Db::table('cart')->join('dishes d','cart.dishes = d.dishesId')->field('cart.*,d.dishesPrice,d.dishesName')->where(['orderId'=>$orderId])->select();
		$dishesPrice = 0;
		for ($i = 0;$i<count($result3);$i++){
			$dishesPrice = $result3[$i]['dishesPrice']*$result3[$i]['num']+$dishesPrice;
		}
		$result3['price'] = $dishesPrice;
		$this->assign('cart',$result3);
		return view();
	}

}