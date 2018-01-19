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
			$users = model('Users');

			$result = Db::table("userinfo")->where(['userAccount' => $userAccount, 'userPass' => $userPass])->select();
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
	public function updateUserInfoI($userData){
		$userID = $userData['userId'];

		$user = model('User');
		$result = $user->where('userId',$userID)
			->update(['faceImg'       =>  $userData['faceImg']]);
		if ($result != 0){
			return show($result);
		}else{
			return show('null');
		}
	}

	/**
	 * 显示公告功能
	 * @param $message 		公告
	 */
	public function showMessageI(){
		$mes = Db::table('message')->order('time DSEC')->select();
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
		$time = strtotime(date("Y-m-d H:i:s"));
		$data = ['content'=>$message,'time'=>$time];
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
		$user = model('User');
		$data = $user->table('user')->alias('u')->join('roleinfo r', 'u.role = r.roleId','RIGHT')->field('u.*,r.roleName')->where('u.role = r.roleId')->select();

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
		$user = model('User');
		$data = $user->where(['userId' => $userId])->select();
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
		$user = model('User');
		$result = $user->where(['userId'=>$userId,'role'=>0])->delete();
		if ($result) {
//			$result = "可以删除删除成功";
			return show($result);
		}else{
//			$result = "删除失败";
			return show('null');
		}
	}

	/**
	 * 添加用户功能
	 * @param $userData		用户信息
	 */
	public function userAddI($userData){


		$user = model('User');
		$result = $user->insert($userData);
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
		$userID = $userData['userId'];

		$user = model('User');
		$result = $user->where('userId', $userID)
			->update(['faceImg' => $userData['faceImg'], 'role' => $userData['role']]);
		if ($result != 0) {
			return show($result);
		} else {
			return show('null');
		}
	}


}
