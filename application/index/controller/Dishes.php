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

class Dishes extends Controller
{
	/**
	 * 后厨菜品烹饪确认功能（准备烹制0、烹制完毕1、正在烹制2）
	 * @param $dishesState		菜品烹饪状态
	 */
	public function dishesState($dishesState){

	}

	/**
	 * 菜品列表展示
	 */
	public function dishesList(){
		$dishes = model('Dishes');
		$data = $dishes->table('dishes')->alias('d')->join('dishessort ds', 'd.dsId = ds.dsId','RIGHT')->field('d.*,ds.dsName')->where('d.dsId = ds.dsId')->select();

		return $this->fetch('disheslist',['data'=>$data]);
	}

	/**
	 * 查看菜品信息
	 * @param $dishesId			菜品id
	 */
	public function dishesDetail($dishesId){
		$dishes = model('Dishes');
		$data = $dishes->where('dishesId',$dishesId)->select();
		$sort = $dishes->table('dishessort')->select();
		$this->assign('data',$data);
		$this->assign('sort',$sort);

		return view();
	}

	/**
	 * 删除菜品功能
	 * @param $dishesId			菜品id
	 */
	public function dishesDel($dishesId){
		$dishes = model('Dishes');
		$result = $dishes->where('dishesId',$dishesId)->delete();
		if ($result) {
//			$result = "可以删除删除成功";
			echo 1;
		}else{
//			$result = "删除失败";
			echo 2;
		}
	}

	/**
	 * 修改菜品信息功能
	 * @param $dishesId			菜品id
	 * @param $dishesData		菜品信息
	 */
	public function dishesUpdate($dishesId){
		$data = input('post.');
		$dishes = model('Dishes');
		$result = $dishes->where('dishesId', $dishesId)
			->update(['dishesName' =>  $data['dishesName'],
				      'dishesDiscript'  =>  $data['dishesDiscript'],
			 		  'dishesImg'  =>  $data['dishesImg'],
					  'dishesTxt'  =>  $data['dishesTxt'],
			  	  	  'recommend'  =>  $data['recommend'],
					  'dishesPrice'  =>  $data['dishesPrice'],
					  'dsId'  =>  $data['dsId']]);
		if ($result != 0) {
			$this->success('修改信息成功');
		} else {
			$this->error('修改信息失败');
		}
	}

	/**
	 * 添加菜品功能
	 * @param $dishesData		菜品信息
	 */
	public function dishesAdd(){
		$data = input('post.');
		$dishes = model('Dishes');
		$result = $dishes->insert($data);
		if ($result) {
			# code...
			$this->success('菜品添加成功！！');
		}else{
			$this->error('菜品添加失败！！');
		}
	}

	/**
	 * 菜品分类添加
	 */
	public function dishesAddView(){
		$dishes = model('Dishes');
		$sort = $dishes->table('dishessort')->select();
		$this->assign('sort',$sort);
		return view();
	}

	/**
	 * 菜品分类的添加页面的跳转
	 */
	public function dishesSortAddView(){
		return view();
	}

	/**
	 * 菜品分类的添加
	 */
	public function dishesSortAdd(){
		$data = input('post.');
		$result = Db::table('dishessort')->insert($data);
		if ($result) {
			# code...
			$this->success('菜品类别添加成功！！');
		}else{
			$this->error('菜品类别添加失败！！');
		}
	}

	/**
	 * 删除菜品类别功能
	 * @param $dishesId			菜品id
	 */
	public function dishesSortDel($dsId){

		$result = Db::table('dishessort')->where('dsId',$dsId)->delete();
		if ($result) {
//			$result = "可以删除删除成功";
			echo 1;
		}else{
//			$result = "删除失败";
			echo 2;
		}
	}

	/**
	 * 菜品类别列表展示
	 */
	public function dishesSortList(){

		$data = Db::table('dishessort')->select();
		return $this->fetch('dishessortlist',['data'=>$data]);
	}


	public function menu(){
		$dishes = model('Dishes');
		$data = $dishes->select();
		$sort = Db::table('dishessort')->select();
		$this->assign('data',$data);
		$this->assign('sort',$sort);
		return view('menu');
	}
}