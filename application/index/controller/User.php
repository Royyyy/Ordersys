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
use app\common\helper\VerifyHelper;

use think\Session;

class User extends Controller
{
	function __construct()
	{
		parent::__construct();
	}
	public function index(){
		return view('main');
	}
	public function index_manager(){
		return view('manager_main');
	}
	public function index_chef(){
		return view('chef_main');
	}
	public function index_server(){
		return view('server_main');
	}
	/**
	 * 显示验证码图片
	 */
	public function verify()
	{
		VerifyHelper::verify();
	}

	public function login(){
		$data = input('post.');
		$userAccount = $data['userAccount'];
		$userPass = $data['userPass'];
//		$result = $this->validate($data, 'UserValidate','','','');
//		if(is_array($result)) {
//			return $this->error('登录失败', ['valid' => $result]);
//		}
		$user = Model('User');

		if ($user->where(['userAccount' => $userAccount])->find() != NULL) {
			if ($user->where(['userAccount' => $userAccount, 'userPass' => $userPass])->find() != NULL){
				$result2 = $user->where(['userAccount' => $userAccount, 'userPass' => $userPass])->select();
				Session::set('userAccount',$result2[0]['userAccount']);
				Session::set('userId',$result2[0]['userId']);
				$userId = Session::get('userId');
				$userAccount = Session::get('userAccount');

				if ($result2[0]['role'] == 1){
					return $this->success('管理员部门登陆成功','index_manager');
				}elseif ($result2[0]['role'] == 2){
					return $this->success('服务员部门登陆成功','index_server');
				}elseif ($result2[0]['role'] == 3){
					return $this->success('后厨部门登陆成功','index_chef');
				}else{
					return $this->error('您没有权限登录本系统');
				}
			}else{
				$this->error('登录失败，密码错误');
			}
		}else{
			$this->error('登录失败，帐号错误');
		}

	}

	/**
	 * 用户注册
	 * @return [type] [description]
	 */
	public function register(){

		$data = input('post.');

		$user = model('User');
		// //数据保存
		// //数据验证
		// $validate = validate('userV');
		// if(!$validate->check($data)){
		//    dump($validate->getError());
		// }
		$result = $user->insert($data);
		if ($result) {
			# code...
			$this->success('注册成功！！');
		}else{
			$this->error('注册失败！！');
		}
	}

	/**
	 * 用户修改自身信息功能
	 * @param $userData		修改内容
	 */
	public function updateUserInfo($data){
		$userID = $data['userId'];

		$user = model('User');
		$result = $user->where('userId',$userID)
			->update(['faceImg'       =>  $data['faceImg']]);
		if ($result != 0){
			$this->success('修改个人信息成功');
		}else{
			$this->error('修改个人信息失败');
		}
	}

	public function changeUserPwd($userId){
		$data = input('post.');
		$userPass = $data['userPass'];
		$user = model('User');
		$result = $user->where('userId',$userId)->update(['userPass' => $userPass]);
		if ($result != 0) {
			$this->success('修改密码成功');
		}else{
			$this->error('修改密码失败');
		}
	}

	/**
	 * 显示实时公告功能
	 * @param $message 		实时公告
	 */
	public function showMessage($message){

		return view();
	}

	/**
	 * 用户列表功能
	 */
	public function userList(){
		$user = model('User');
		$data = $user->table('user')->alias('u')->join('roleinfo r', 'u.role = r.roleId','RIGHT')->field('u.*,r.roleName')->where('u.role = r.roleId')->select();

		return $this->fetch('showlist',['data'=>$data]);
	}

	/**
	 * 查看用户个人信息功能
	 * @param $userId 		用户id
	 */
	public function userDetail($userId){

		$user = model('User');
		$data = $user->where(['userId' => $userId])->select();
		$this->assign('data',$data);

		return view();
	}

//	/**
//	 * 删除用户功能
//	 * @param $userId		用户id
//	 */
//	public function userDel($userId){
//		$user = model('User');
//		$result = where(['userId'=>$userId,'role'=>0])->delete();
//		if ($result) {
////			$result = "可以删除删除成功";
//			echo 1;
//		}else{
////			$result = "删除失败";
//			echo 2;
//		}
//	}

//	/**
//	 * 添加用户功能
//	 * @param $userData		用户信息
//	 */
//	public function userAdd($userData){
//
//	}

	/**
	 * 管理员修改用户信息功能
	 * @param $userData		用户信息
	 */
	public function changeUserInfo($userData)
	{
		$userID = $userData['userId'];

		$user = model('User');
		$result = $user->where('userId', $userID)
			->update(['faceImg' => $userData['faceImg'], 'role' => $userData['role']]);
		if ($result != 0) {
			$this->success('修改信息成功');
		} else {
			$this->error('修改信息失败');
		}
	}

	/**
	 * 用户注销功能
	 * @return \think\response\View
	 */
	public function logout(){
		Session::delete('userAccount');
		Session::delete('userId');
		return view('index/index');
	}



}