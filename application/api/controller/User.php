<?php
/**
 * Created by PhpStorm.
 * User: chok
 * Date: 2018/1/5
 * Time: 21:41
 */

namespace app\api\controller;
use think\Db;
use think\Controller;
use app\common\validate\UserValidate;
class User extends Controller
{
	/**
	 * 用户登录功能
	 * @param $userAccount  用户名
	 * @param $userPass		密码
	 */
	public function loginI($userAccount,$userPass)
	{

//		$data = file_get_contents('php://input');
//		if (is_array($data)) {
//
//			$userAccount = $data['userAccount'];
//			$userPass = $data['userPass'];


			$result = Db::table("user")->where(['userAccount' => $userAccount, 'userPass' => $userPass])->find();

			if ($result != null) {
				return show($result);

			} else {
				return show('null');
			}
//		}else{
//			return show(0,'什么都没有');
//		}
	}

	/**
	 * 用户修改自身信息功能
	 * @param $userData		修改内容
	 */
	public function updateUserInfoI($file){

		$userData= json_decode($file);
		//$userId = $userData['userId'];
		$file2 = request()->file($file['faceImg']);
		/*if (isset($file)) {
			// 获取表单上传文件 例如上传了001.jpg
			// 移动到框架应用根目录/public/uploads/ 目录下
			$info = $file->validate(['size' => 1567118, 'ext' => 'jpg,png,gif,jpeg'])->rule('date')->move(ROOT_PATH . 'public/uploads/face');
//       var_dump($info) ;die;
			if ($info) {
				// 成功上传后 获取上传信息
				$a = $info->getSaveName();
				$imgp = str_replace("\\", "/", $a);
				$imgpath = 'uploads/face/' . $imgp;
				$userData['faceImg'] = $imgpath;
				//上传成功提示成功信息
//				$this->success('上传成功');

			} else {
				// 上传失败获取错误信息
				echo $file->getError();
			}

			if ($userData['userPass'] != null) {
				$result = Db::table('user')->where('userId',$userId)
					->update(['userPass' => $userData['userPass'], 'faceImg' => $userData['faceImg']]);

				if ($result != 0){
					return show($userData['faceImg']);
				}else{
					return show('null');
				}
			} elseif ($userData['userPass'] == null) {
				$result = Db::table('user')->where('userId', $userId)
					->update(['faceImg' => $userData['faceImg']]);

				if ($result != 0){
					return show($userData['faceImg']);
				}else{
					return show('null');
				}
			}
		} else {
			if ($userData['userPass'] != null) {
				$result = Db::table('user')->where('userId',$userId)
					->update(['userPass' => $userData['userPass']]);
				if ($result != 0){
					return show($result);
				}else{
					return show('null');
				}

			} else {
				return show('null');
			}
		}

		$result = Db::table('user')->where('userId',$userId)
			->update(['faceImg'       =>  $userData['faceImg']]);
		if ($result != 0){
			return show($userData['faceImg']);
		}else{
			return show('null');
		}
		*/
	return show($file2);
	}

	/**
	 * 显示公告功能
	 * @param $message 		公告
	 */
	public function showMessageI(){
		$mes = Db::table('message')->order('time','DSEC')->select();
		for ($i = 0;$i<count($mes);$i++) {
			$mes[$i]['time'] = date("Y-m-d H:i:s",$mes[$i]['time']);
		}
		return show($mes);
	}

	/**
	 * 发送公告功能
	 * @param $message 		实时公告
	 */
	public function sendMessageI($message){
		$data = json_decode($message,true);
		$time = strtotime(date("Y-m-d H:i:s"));
		
		$data = ['content'=>$data['content'],'time'=>$time];
		$result = Db::table('message')->insert($data);
		if ($result) {
			# code...
			return show($result);
		}else{
			return show('null');
		}
	}


	/**
	 * 删除公告功能
	 * @param $message 		实时公告
	 */
	public function delMessageI($mesId){

		$result = Db::table('message')->where(['mesId'=>$mesId])->delete();
		if ($result) {
			# code...
			return show($result);
		}else{
			return show('null');
		}
	}

	/**
	 * 用户列表功能
	 */
	public function userListI(){

		$data = Db::table('user')->alias('u')->join('roleinfo r', 'u.role = r.roleId','RIGHT')->field('u.*,r.roleName')->where('u.role = r.roleId')->select();

		if ($data != null) {
			return show($data);

		} else {
			return show('null');
		}
	}

	/**
	 * 查看用户个人信息功能
	 * @param $userId 		用户id
	 */
	public function userDetailI($userId){

		$data = Db::table('user')->where(['userId' => $userId])->find();
		if ($data != null) {
			return show($data);

		} else {
			return show('null');
		}
	}

	/**
	 * 删除用户功能
	 * @param $userId		用户id
	 */
	public function userDelI($userId){
		$where['role'] =array('neq','1');
		$where['userId'] =$userId;
		$result = Db::table('user')->where($where)->delete();
		if ($result) {
//			$result = "可以删除删除成功";
			return show($result);
		}else{
//			$result = "删除失败";
			return show(2);
		}
	}

	/**
	 * 添加用户功能a
	 * @param $userData		用户信息
	 */
	public function userAddI($userData){

		$data = json_decode($userData,true);
		$data = ['userAccount'=>$data['userAccount'],'userPass'=>$data['userPass'],'role'=>$data['role']];
	
		$result = Db::table('user')->insert($data);
		if ($result) {
			# code...
			return show($result);
		}else{
			return show('null');
		}
	}

	/**
	 * 管理员修改用户信息功能
	 * @param $userData		用户信息
	 */
	public function changeUserInfoI($userData){

		$userData = json_decode($userData,true);
		$userID = $userData['userId'];
		
		if ($userData['faceImg'] == null) {
			if ($userData['userPass'] == null) {
				$result = Db::table('user')->where(['userId'=>$userID])->update(['role'=>$userData['role']]);
			}elseif ($userData['role'] == null){
				$result = Db::table('user')->where(['userId'=>$userID])->update(['userPass'=>$userData['userPass']]);
			}else{
				$result = Db::table('user')->where(['userId'=>$userID])->update(['userPass'=>$userData['userPass'],'role'=>$userData['role']]);
			}
		}else{
			if ($userData['userPass'] == null) {
				$result = Db::table('user')->where(['userId'=>$userID])->update(['role'=>$userData['role'],'faceImg'=>$userData['faceImg']]);
			}elseif ($userData['role'] == null){
				$result = Db::table('user')->where(['userId'=>$userID])->update(['userPass'=>$userData['userPass'],'faceImg'=>$userData['faceImg']]);
			}else{
				$result = Db::table('user')->where(['userId'=>$userID])->update(['userPass'=>$userData['userPass'],'role'=>$userData['role'],'faceImg'=>$userData['faceImg']]);
			}
		}
		
		if ($result != 0) {
			return show($result);
		} else {
			return show(2);
		}
	}


}
