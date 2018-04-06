<?php
/**
 * Created by PhpStorm.
 * dishes: chok
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
	public function dishesStateI(){
		$result = Db::table('orderdishes')->where('odId',$odId)->update(['state'=>1]);
		if ($result != 0) {
			return show($result);

		} else {
			return show('null');
		}
	}

	/**
	 * 菜品列表展示
	 */
	public function dishesListI($dsId){

		//$data = Db::table('dishes')->table('dishes')->alias('d')->join('dishessort ds', 'd.dsId = ds.dsId','RIGHT')->field('d.*,ds.dsName')->where('d.dsId = ds.dsId')->select();
		if ($dsId != -1) {
			$data = Db::table('dishes')->alias('d')->join('dishessort ds', 'd.dsId = ds.dsId','RIGHT')->field('d.*,ds.dsName')->where(['d.dsId'=>$dsId])->select();
		
		}else{
			$data = Db::table('dishes')->select();
		}
		if ($data != null) {
			return show($data);

		} else {
			return show(2);
		}
	}

	/**
	 * 查看菜品信息
	 * @param $dishesId			菜品id
	 */
	public function dishesDetailI($dishesId){

		$data = Db::table('dishes')->where('dishesId',$dishesId)->find();
		$sort = Db::table('dishes')->table('dishessort')->select();
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

		$result = Db::table('dishes')->where('dishesId',$dishesId)->delete();
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
	public function dishesUpdateI($dishesData){
		
		$data = json_decode($dishesData,true);
		$dishesId = $data['dishesId'];
		if ($data['dishesImg'] == null) {
			if ($data['dishesName'] == null) {
				$result = Db::table('dishes')->where('dishesId', $dishesId)
				->update([
					'dishesDiscript'  =>  $data['dishesDiscript'],
					'dishesTxt'  =>  $data['dishesTxt'],
					'recommend'  =>  $data['recommend'],
					'dishesPrice'  =>  $data['dishesPrice'],
					'dsId'  =>  $data['dsId']]);
			}elseif ($data['dishesDiscript'] == null){
				$result = Db::table('dishes')->where('dishesId', $dishesId)
				->update(['dishesName' =>  $data['dishesName'],
					
					'dishesTxt'  =>  $data['dishesTxt'],
					'recommend'  =>  $data['recommend'],
					'dishesPrice'  =>  $data['dishesPrice'],
					'dsId'  =>  $data['dsId']]);
			}elseif ($data['dishesTxt'] == null){
				$result = Db::table('dishes')->where('dishesId', $dishesId)
				->update(['dishesName' =>  $data['dishesName'],
					'dishesDiscript'  =>  $data['dishesDiscript'],
					
					'recommend'  =>  $data['recommend'],
					'dishesPrice'  =>  $data['dishesPrice'],
					'dsId'  =>  $data['dsId']]);
			}elseif ($data['recommend'] == null){
				$result = Db::table('dishes')->where('dishesId', $dishesId)
				->update(['dishesName' =>  $data['dishesName'],
					'dishesDiscript'  =>  $data['dishesDiscript'],
					'dishesTxt'  =>  $data['dishesTxt'],
					
					'dishesPrice'  =>  $data['dishesPrice'],
					'dsId'  =>  $data['dsId']]);
			}elseif ($data['dishesPrice'] == null) {
				$result = Db::table('dishes')->where('dishesId', $dishesId)
				->update(['dishesName' =>  $data['dishesName'],
					'dishesDiscript'  =>  $data['dishesDiscript'],
					'dishesTxt'  =>  $data['dishesTxt'],
					'recommend'  =>  $data['recommend'],
					
					'dsId'  =>  $data['dsId']]);
			}elseif ($data['dsId'] == null) {
				$result = Db::table('dishes')->where('dishesId', $dishesId)
				->update(['dishesName' =>  $data['dishesName'],
					'dishesDiscript'  =>  $data['dishesDiscript'],
					'dishesTxt'  =>  $data['dishesTxt'],
					'recommend'  =>  $data['recommend'],
					'dishesPrice'  =>  $data['dishesPrice']]
					);
			}else{
				$result = Db::table('dishes')->where('dishesId', $dishesId)
				->update(['dishesName' =>  $data['dishesName'],
					'dishesDiscript'  =>  $data['dishesDiscript'],
					'dishesTxt'  =>  $data['dishesTxt'],
					'recommend'  =>  $data['recommend'],
					'dishesPrice'  =>  $data['dishesPrice'],
					'dsId'  =>  $data['dsId']]);
			}
		}else{
			if ($data['dishesName'] == null) {
				$result = Db::table('dishes')->where('dishesId', $dishesId)
				->update([
					'dishesDiscript'  =>  $data['dishesDiscript'],
					'dishesImg'  =>  $data['dishesImg'],
					'dishesTxt'  =>  $data['dishesTxt'],
					'recommend'  =>  $data['recommend'],
					'dishesPrice'  =>  $data['dishesPrice'],
					'dsId'  =>  $data['dsId']]);
			}elseif ($data['dishesDiscript'] == null){
				$result = Db::table('dishes')->where('dishesId', $dishesId)
				->update(['dishesName' =>  $data['dishesName'],
					'dishesImg'  =>  $data['dishesImg'],
					'dishesTxt'  =>  $data['dishesTxt'],
					'recommend'  =>  $data['recommend'],
					'dishesPrice'  =>  $data['dishesPrice'],
					'dsId'  =>  $data['dsId']]);
			}elseif ($data['dishesTxt'] == null){
				$result = Db::table('dishes')->where('dishesId', $dishesId)
				->update(['dishesName' =>  $data['dishesName'],
					'dishesDiscript'  =>  $data['dishesDiscript'],
					'dishesImg'  =>  $data['dishesImg'],
					'recommend'  =>  $data['recommend'],
					'dishesPrice'  =>  $data['dishesPrice'],
					'dsId'  =>  $data['dsId']]);
			}elseif ($data['recommend'] == null){
				$result = Db::table('dishes')->where('dishesId', $dishesId)
				->update(['dishesName' =>  $data['dishesName'],
					'dishesDiscript'  =>  $data['dishesDiscript'],
					'dishesTxt'  =>  $data['dishesTxt'],
					'dishesImg'  =>  $data['dishesImg'],
					'dishesPrice'  =>  $data['dishesPrice'],
					'dsId'  =>  $data['dsId']]);
			}elseif ($data['dishesPrice'] == null) {
				$result = Db::table('dishes')->where('dishesId', $dishesId)
				->update(['dishesName' =>  $data['dishesName'],
					'dishesDiscript'  =>  $data['dishesDiscript'],
					'dishesImg'  =>  $data['dishesImg'],
					'dishesTxt'  =>  $data['dishesTxt'],
					'recommend'  =>  $data['recommend'],
					'dsId'  =>  $data['dsId']]);
			}elseif ($data['dsId'] == null) {
				$result = Db::table('dishes')->where('dishesId', $dishesId)
				->update(['dishesName' =>  $data['dishesName'],
					'dishesDiscript'  =>  $data['dishesDiscript'],
					'dishesTxt'  =>  $data['dishesTxt'],
					'dishesImg'  =>  $data['dishesImg'],
					'recommend'  =>  $data['recommend'],
					'dishesPrice'  =>  $data['dishesPrice']]
					);
			}else{
				$result = Db::table('dishes')->where('dishesId', $dishesId)
				->update(['dishesName' =>  $data['dishesName'],
					'dishesDiscript'  =>  $data['dishesDiscript'],
					'dishesTxt'  =>  $data['dishesTxt'],
					'dishesImg'  =>  $data['dishesImg'],
					'recommend'  =>  $data['recommend'],
					'dishesPrice'  =>  $data['dishesPrice'],
					'dsId'  =>  $data['dsId']]);
			}
		
		}
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
		$dishesData = json_decode($dishesData,true);
		$result = Db::table('dishes')->insert($dishesData);
		if ($result) {
			return show($result);

		} else {
			return show('null');
		}
	}
	public function dishesSortI(){
		
		$data = Db::table('dishessort')->select();
		if ($data != null) {
			return show($data);

		} else {
			return show('null');
		}
	}
	
}