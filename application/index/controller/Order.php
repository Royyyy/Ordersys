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
use think\paginator;

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
	public function orderAdd($orderId,$price)
	{
		$order = model('Order');
		$cart = Db::table('cart')->where(['orderId' => $orderId])->field('orderId,dishes,num')->select();
		$data = $order->where(['orderId' => $orderId])->select();
		$orderPrice = $data[0]['price']+$price;
		$orderRes = $order->where(['orderId' => $orderId])->Update(['price' => $orderPrice]);
		for ($i = 0; $i < count($cart); $i++) {
			$cart[$i]['state'] = 0;
		}
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




	public function showOrder(){
		$count = Db::table('order')->count();
		$data = Db::table('order')->join('user u','order.waiterId = u.userId')->field('order.*,u.userAccount')->order('orderId DESC')->where('orderState',0)->paginate(5,$count, ['type' => 'BootstrapAjax', 'var_page' => 'page', 'path'=>url('order/showOrder')]);

		$time = date("Y-m-d H:i:s");
		$list = $data->render();
//		$this->assign('page',$show);
		$this->assign('data',$data);
		$this->assign('page',$list);
		$this->assign('time',$time);
//		$this->assign('list',$list);
		return view();
	}

	public function showOrderChef(){
		$count = Db::table('order')->count();
		$data = Db::table('order')->join('user u','order.waiterId = u.userId')->field('order.*,u.userAccount')->order('orderId DESC')->where('orderState',0)->paginate(5,$count, ['type' => 'BootstrapAjax', 'var_page' => 'page', 'path'=>url('order/showOrder')]);

		$time = date("Y-m-d H:i:s");
		$list = $data->render();
//		$this->assign('page',$show);
		$this->assign('data',$data);
		$this->assign('page',$list);
		$this->assign('time',$time);
//		$this->assign('list',$list);
		return view();

	}
	/**
	 * 查看订单详细情况
	 * @param $orderId		订单id
	 */
	public function orderDetail($orderId){
		$order = model('Order');
		$data = $order->join('user u','order.waiterId = u.userId')->field('order.*,u.userAccount')->order('orderId DESC')->where(['orderId' => $orderId])->select();

		$result3 = Db::table('orderdishes')->join('dishes d','orderdishes.dishes = d.dishesId')->field('orderdishes.*,d.dishesPrice,d.dishesName')->where(['orderId'=>$orderId])->select();

		$time = date("Y-m-d H:i:s");
		$this->assign('data',$data);
		$this->assign('time',$time);
		$this->assign('dishes',$result3);
		return view();
	}

	public function orderDetailChef($orderId){
		$order = model('Order');
		$data = $order->join('user u','order.waiterId = u.userId')->field('order.*,u.userAccount')->order('orderId DESC')->where(['orderId' => $orderId])->select();

		$result3 = Db::table('orderdishes')->join('dishes d','orderdishes.dishes = d.dishesId')->field('orderdishes.*,d.dishesPrice,d.dishesName')->where(['orderId'=>$orderId])->select();

		$time = date("Y-m-d H:i:s");
		$this->assign('data',$data);
		$this->assign('time',$time);
		$this->assign('dishes',$result3);
		return view();
	}

	/**
	 * 后厨完成烹饪修改所定菜品的状态
	 */
	public function changeDishesState($odId){
		$result = Db::table('orderdishes')->where('odId',$odId)->update(['state'=>1]);
		if ($result != 0){
			echo 1;
		}else{
			echo 2;
		}

	}
	/**已付款账单总列表
	 * @return \think\response\View
	 */
	public function orderList(){

		$count = Db::table('order')->count();
		$data = Db::table('order')->join('user u','order.waiterId = u.userId')->field('order.*,u.userAccount')->order('orderId DESC')->where('orderState = 1 OR orderState=2')->paginate(5,$count, ['type' => 'BootstrapAjax', 'var_page' => 'page', 'path'=>url('order/orderList')]);
		$list = $data->render();
		$time = date("Y-m-d H:i:s");
		$this->assign('data',$data);
		$this->assign('page',$list);
		$this->assign('time',$time);
		return view();


	}


	/**
	 * 订单付款状态修改pay
	 * @param $orderId
	 */
	public function orderPay($orderId){
		$order = model('Order');
		$time = strtotime(date("Y-m-d H:i:s"));
		$result = $order->where('orderId',$orderId)->update(['orderState'=>1,'orderEndDate'=>$time]);
		$data = $order->where('orderId',$orderId)->select();
		$result2 = Db::table('table')->where(['tableId' => $data[0]['tableId']])->update(['tableState'=>0]);
		if ($result != 0) {
			echo 1;
		}else{
//			$result = "失败";
			echo 2;
		}
	}

	/**
	 * 订单付款状态修改free
	 * @param $orderId
	 */
	public function orderFree($orderId){
		$order = model('Order');
		$time = strtotime(date("Y-m-d H:i:s"));
		$result = $order->where('orderId',$orderId)->update(['orderState'=>2,'orderEndDate'=>$time]);
		$data = $order->where('orderId',$orderId)->select();
		$result2 = Db::table('table')->where(['tableId' => $data[0]['tableId']])->update(['tableState'=>0]);
		if ($result != 0) {
			echo 1;
		}else{
//			$result = "失败";
			echo 2;
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