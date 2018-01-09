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
				return show(1, '登录成功', $result);

			} else {
				return show(0, '登录失败');
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

	}

	/**
	 * 显示实时公告功能
	 * @param $message 		实时公告
	 */
	public function showMessageI($message){

	}

	/**
	 * 用户列表功能
	 */
	public function userListI(){

	}

	/**
	 * 查看用户个人信息功能
	 * @param $userId 		用户id
	 */
	public function userDetailI($userId){

	}

	/**
	 * 删除用户功能
	 * @param $userId		用户id
	 */
	public function userDelI($userId){

	}

	/**
	 * 添加用户功能
	 * @param $userData		用户信息
	 */
	public function userAddI($userData){

	}

	/**
	 * 管理员修改用户信息功能
	 * @param $userData		用户信息
	 */
	public function changeUserInfoI($userData){

	}


}
