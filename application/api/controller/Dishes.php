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
	public function dishesList(){

	}

	/**
	 * 查看菜品信息
	 * @param $dishesId			菜品id
	 */
	public function dishesDetail($dishesId){

	}

	/**
	 * 删除菜品功能
	 * @param $dishesId			菜品id
	 */
	public function dishesDelI($dishesId){

	}

	/**
	 * 修改菜品信息功能
	 * @param $dishesId			菜品id
	 * @param $dishesData		菜品信息
	 */
	public function dishesUpdateI($dishesId,$dishesData){

	}

	/**
	 * 添加菜品功能
	 * @param $dishesData		菜品信息
	 */
	public function dishesAddI($dishesData){

	}
}