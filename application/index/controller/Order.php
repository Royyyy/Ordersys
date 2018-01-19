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
		$data=['orderBeginDate'=>$orderBeginDate,'waiterId'=>$waiterId,'orderState'=>0,'tableId'=>$tableId];
//		$data=[$orderBeginDate,0,0,$tableId];
		$result = $order->insert($data);
		$orderId = $order->getLastInsID();
		$result2 = Db::table('table')->where(['tableId' => $tableId])->update(['tableState'=>1]);
		$this->assign('orderId',$orderId);
		if ($result){
			$this->success('选择桌子成功！您目前选择的是'+$orderId+'号桌子');
		} else {
			$this->error('选择桌子失败');
		}
//		return view('user/main');
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
	 * 显示订单列表
	 */
	public function showOrder(){
		$order = model('Order');
		$data = $order->select();
		return $this->fetch('showorder',['data'=>$data]);
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
}