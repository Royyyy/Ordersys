<?php
/**
 * Created by PhpStorm.
 * User: chok
 * Date: 2018/1/5
 * Time: 23:53
 */

namespace app\api\controller;
use think\Db;
use think\Controller;

class Dishes extends Controller
{
	/**
	 * 后厨菜品烹饪确认功能（准备烹制0、烹制完毕1、正在烹制2）
	 * @param $dishesState		菜品烹饪状态
	 */
	public function dishesStateI($dishesState){

	}

	/**
	 * 菜品列表展示
	 */
	public function dishesListI(){
		$dishes = model('Dishes');
		$data = $dishes->table('dishes')->alias('d')->join('dishessort ds', 'd.dsId = ds.dsId','RIGHT')->field('d.*,ds.dsName')->where('d.dsId = ds.dsId')->select();
		if ($data != null) {
			return show($data);

		} else {
			return show('null');
		}
	}

	/**
	 * 查看菜品信息
	 * @param $dishesId			菜品id
	 */
	public function dishesDetailI($dishesId){
		$dishes = model('Dishes');
		$data = $dishes->where('dishesId',$dishesId)->select();
		$sort = $dishes->table('dishessort')->select();
		if ($data != null) {
			return show($data);

		} else {
			return show('null');
		}
	}

	/**
	 * 删除菜品功能
	 * @param $dishesId			菜品id
	 */
	public function dishesDelI($dishesId){
		$dishes = model('Dishes');
		$result = $dishes->where('dishesId',$dishesId)->delete();
		if ($result) {
//			$result = "可以删除删除成功";
			return show($result);

		} else {
			return show('null');
		}
	}

	/**
	 * 修改菜品信息功能
	 * @param $dishesId			菜品id
	 * @param $dishesData		菜品信息
	 */
	public function dishesUpdateI($dishesId,$dishesData){
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
			return show($result);

		} else {
			return show('null');
		}
	}

	/**
	 * 添加菜品功能
	 * @param $dishesData		菜品信息
	 */
	public function dishesAddI($dishesData){
		$data = input('post.');
		$dishes = model('Dishes');
		$result = $dishes->insert($data);
		if ($result) {
			return show($result);

		} else {
			return show('null');
		}
	}
}