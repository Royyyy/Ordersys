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
		$count = $dishes->count();
		$data = $dishes->table('dishes')->alias('d')->join('dishessort ds', 'd.dsId = ds.dsId','RIGHT')->field('d.*,ds.dsName')->where('d.dsId = ds.dsId')->paginate(5,$count, ['type' => 'BootstrapAjax', 'var_page' => 'page', 'path'=>url('dishes/dishesList')]);
		$list = $data->render();
		$this->assign('data',$data);
		$this->assign('page',$list);
		return view();
	}


	/**
	 * 查看菜品信息
	 * @param $dishesId			菜品id
	 */
	public function manDishesDetail($dishesId){
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
	 */
	public function dishesUpdate(){
		$data = input('post.');
		$dishes = model('Dishes');

		$file = request()->file('dishesImg');
		if (isset($file)) {
			// 获取表单上传文件 例如上传了001.jpg
			// 移动到框架应用根目录/public/uploads/ 目录下
			$info = $file->validate(['size' => 1567118, 'ext' => 'jpg,png,gif,jpeg'])->rule('date')->move(ROOT_PATH . 'public/uploads/face');
//       var_dump($info) ;die;
			if ($info) {
				// 成功上传后 获取上传信息
				$a = $info->getSaveName();
				$imgp = str_replace("\\", "/", $a);
				$imgpath = 'uploads/face/' . $imgp;
				$data['dishesImg'] = $imgpath;
				//上传成功提示成功信息
//				$this->success('上传成功');

			} else {
				// 上传失败获取错误信息
				echo $file->getError();
			}
				$result = $dishes->where('dishesId', $data['dishesId'])
					->update([
						'dishesName' =>  $data['dishesName'],
						'dishesDiscript'  =>  $data['dishesDiscript'],
						'dishesImg'  =>  $data['dishesImg'],
						'recommend'  =>  $data['recommend'],
						'dishesPrice'  =>  $data['dishesPrice'],
						'dsId'  =>  $data['dsId']]);
				if ($result != 0) {
					$this->success('修改信息成功');
				} else {
					$this->error('修改信息失败，原因没有对修改任何内容');
				}
		}else {

			$result = $dishes->where('dishesId', $data['dishesId'])
				->update([
					'dishesName' =>  $data['dishesName'],
					'dishesDiscript'  =>  $data['dishesDiscript'],
					'recommend'  =>  $data['recommend'],
					'dishesPrice'  =>  $data['dishesPrice'],
					'dsId'  =>  $data['dsId']]);
				if ($result != 0) {
					$this->success('修改信息成功');
				} else {
					$this->error('修改信息失败，原因没有对修改任何内容');
				}
			}



	}

	/**
	 * 添加菜品功能
	 * @param $dishesData		菜品信息
	 */
	public function dishesAdd(){
		$data = input('post.');
		$dishes = model('Dishes');

		$file = request()->file('dishesImg');
		if (isset($file)) {
			// 获取表单上传文件 例如上传了001.jpg
			// 移动到框架应用根目录/public/uploads/ 目录下
			$info = $file->validate(['size' => 1567118, 'ext' => 'jpg,png,gif,jpeg'])->rule('date')->move(ROOT_PATH . 'public/uploads/face');
//       var_dump($info) ;die;
			if ($info) {
				// 成功上传后 获取上传信息
				$a = $info->getSaveName();
				$imgp = str_replace("\\", "/", $a);
				$imgpath = 'uploads/face/' . $imgp;
				$data['dishesImg'] = $imgpath;
				//上传成功提示成功信息
//				$this->success('上传成功');

			} else {
				// 上传失败获取错误信息
				echo $file->getError();
			}

		}
		$result = $dishes->insert($data);
		if ($result) {
			# code...
			$this->success('菜品添加成功！！');
		}else{
			$this->error('菜品添加失败！！');
		}
	}

	/**
	 * 菜品添加页面跳转
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
	 * ajax判断菜品类别名的方法
	 */
	public function checkDishesSortName($dsName){

		$result = Db::table('dishessort')->where('dsName',$dsName)->find();
		if (!$result) {
//			$result = "可以使用该菜品分类名";
			echo true;
		}else{
//			$result = "菜品分类名已存在";
			echo false;
		}
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
	 * 菜品分类的更新
	 */
	public function dishesSortUpdate(){
		$data = input('post.');
		$result = Db::table('dishessort')->where('dsId',$data['dsId'])->update(['dsName'=>$data['dsName']]);
		if ($result != 0) {
			# code...
			$this->success('菜品类别信息修改成功！');
		}else{
			$this->error('菜品类别信息修改失败！原因没有找到修改过的信息');
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
		$count = Db::table('dishessort')->count();
		$data = Db::table('dishessort')->paginate(5,$count, ['type' => 'BootstrapAjax', 'var_page' => 'page', 'path'=>url('dishes/dishesSortList')]);
		$list = $data->render();;
		$this->assign('data',$data);
		$this->assign('page',$list);
		return view();

	}

	/**
	 * 菜品分类列表的详情页
	 */
	public function manDishesSortDetail($dsId){

		$data = Db::table('dishessort')->where('dsId',$dsId)->select();
		$this->assign('data',$data);
		return view();
	}

	public function menu(){
		$dishes = model('Dishes');
		$data = $dishes->select();
		$sort = Db::table('dishessort')->select();

		$this->assign('sort',$sort);
		$this->assign('data',$data);
		return view();
	}
}