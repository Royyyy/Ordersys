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
use app\common\validate\UserValidate;
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

	public function checkCap($verifyres){
		$result_cap = VerifyHelper::check($verifyres);
		if ($result_cap) {
//			$result = "可以使用该用户名";
			echo true;
		}else{
//			$result = "用户名已存在";
			echo false;
		}
	}
	public function login(){
		$data = input('post.');
		$userAccount = $data['userAccount'];
		$userPass = $data['userPass'];
		$verifyres = $data['verify'];

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
	public function register($userAccount){
		$user = model('user');
		$result = $user->where('userAccount',$userAccount)->find();
		if (!$result) {
//			$result = "可以使用该用户名";
			echo true;
		}else{
//			$result = "用户名已存在";
			echo false;
		}
	}

	public function userAdd(){
		$role = Db::table('roleinfo')->select();
		$this->assign('role',$role);
		return view();
	}
	/**
	 * 用户修改自身信息功能
	 * @param 		修改内容
	 */
	public function updateUserInfo()
	{
		$data = input('post.');
		$user = model('User');
		$file = request()->file('faceImg');
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
				$data['faceImg'] = $imgpath;
				//上传成功提示成功信息
//				$this->success('上传成功');

			} else {
				// 上传失败获取错误信息
				echo $file->getError();
			}

			if ($data['userPass'] != null) {
				$result = $user->where('userId', $data['userId'])
					->update(['userPass' => $data['userPass'], 'faceImg' => $data['faceImg']]);

				if ($result != 0) {
					$this->success('修改个人信息成功');
				} else {
					$this->error('修改个人信息失败');
				}
			} elseif ($data['userPass'] == null) {
				$result = $user->where('userId', $data['userId'])
					->update(['faceImg' => $data['faceImg']]);

				if ($result != 0) {
					$this->success('修改个人信息成功');
				} else {
					$this->error('修改个人信息失败');
				}
			}
		} else {
			if ($data['userPass'] != null) {
				$result = $user->where('userId', $data['userId'])
					->update(['userPass' => $data['userPass']]);
				if ($result != 0) {
					$this->success('修改个人信息成功');
				} else {
					$this->error('修改个人信息失败');
				}

			} else {
				$this->error('修改个人信息失败,原因没有检测到修改过的信息');
			}
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
//	public function userList(){
//
//		$user = model('User');
//		$count = $user->count();
//		$limit = 5;
//		$total = intval(ceil($count/$limit))+1;//进1取整，计算多少页
//		$paging = array();
//		for ($i = 0;$i < $total;$i++){
//			$paging[$i]=$i;
//		}//页码
//		$page = isset($_GET['page'])?$_GET['page']:"";
//		if (empty($page)){
//			$page = 1;
//		}//前台传过来的页码
//		$offset = ($page-1)*$limit;//偏移量
//
////		$data = $user->table('user')->alias('u')->join('roleinfo r', 'u.role = r.roleId','RIGHT')->field('u.*,r.roleName')->where('u.role = r.roleId')->select();
//		$data = $user->table('user')->alias('u')->join('roleinfo r', 'u.role = r.roleId','RIGHT')->field('u.*,r.roleName')->limit($offset,$limit)->select();
////		if (request()->isAjax()){ //如果是AJAX请求的分页
////			$this->assign('data',$data);
////			return view('user/userListAjax');
////			exit;
////		}
//		//非Ajax请求
//		$this->assign('paging',$paging);
//		$this->assign('data',$data);
//
//		return view();
////		$this->assign('data',$data);
////		return view();
/// 	<!--<div class="pagination" >-->
//<!--{volist name="paging" id="value"}-->
//							<!--<li>-->
//								<!--<a href="javascript:void(0)" onclick="page('{$value}')" class="padropdown-toggleger">-->
//									<!--{if condition="$value eq '0'"}首页-->
//									<!--{else/}{$value}-->
//									<!--{/if}-->
//								<!--</a>-->
//							<!--</li>-->
//						<!--{/volist}-->
//					<!--</div>-->
//	}

	public function userList(){
		$user = model('User');
		$count = $user->count();
		$data = $user->table('user')->alias('u')->join('roleinfo r', 'u.role = r.roleId','RIGHT')->field('u.*,r.roleName')->paginate(5,$count, ['type' => 'BootstrapAjax', 'var_page' => 'page', 'path'=>url('user/userList')]);;
		$list = $data->render();
		$this->assign('data',$data);
		$this->assign('page',$list);

		return view();
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


	/**
	 * 管理员修改用户信息功能
	 * @param $userData		用户信息
	 */
	public function changeUserInfo()
	{
		$data = input('post.');
		
		$user = model('User');
		$file = request()->file('faceImg');
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
				$data['faceImg'] = $imgpath;
				//上传成功提示成功信息
//				$this->success('上传成功');

			} else {
				// 上传失败获取错误信息
				echo $file->getError();
			}

			if ($data['userPass'] == null ){
				$result = $user->where('userId', $data['userId'])
					->update(['role' => $data['role'],'faceImg' => $data['faceImg']]);

				if ($result != 0) {
					$this->success('修改个人信息成功');
				} else {
					$this->error('修改个人信息失败');
				}
			}else{
					$result = $user->where('userId', $data['userId'])
						->update(['userPass' => $data['userPass'],'faceImg' => $data['faceImg']]);

					if ($result != 0) {
						$this->success('修改个人信息成功');
					} else {
						$this->error('修改个人信息失败');
					}

			}

		}else {
			if ($data['userPass'] == null) {
				$result = $user->where('userId', $data['userId'])
					->update(['role' => $data['role']]);
				if ($result != 0) {
					$this->success('修改个人信息成功');
				} else {
					$this->error('修改个人信息失败');
				}
			}else{
				$result = $user->where('userId', $data['userId'])
					->update(['userPass' => $data['userPass'],'role' => $data['role']]);
				if ($result != 0) {
					$this->success('修改个人信息成功');
				} else {
					$this->error('修改个人信息失败');
				}
			}
		}

	}

	/**
	 * 管理员查看用户信息
	 * @param $userId
	 * @return \think\response\View
	 */
	public function manUserDetail($userId){

		$user = model('User');
		$data = $user->where(['userId' => $userId])->select();
		$role = Db::table('roleinfo')->select();
		$this->assign('data',$data);
		$this->assign('role',$role);
		return view();
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

	public function upload()
	{
		//I('post.ImgURL','','htmlspecialchars')为获取页面文本框内的值
		$data = input('post.');
		$file = request()->file('faceImg');

		if(isset($file)){
			// 获取表单上传文件 例如上传了001.jpg
			// 移动到框架应用根目录/public/uploads/ 目录下
			$info = $file->validate(['size'=>1567118,'ext'=>'jpg,png,gif,jpeg'])->rule('date')->move(ROOT_PATH . 'public/uploads/face');
//       var_dump($info) ;die;
			if($info){
				// 成功上传后 获取上传信息
				$a=$info->getSaveName();
				$imgp= str_replace("\\","/",$a);
				$imgpath='uploads/face/'.$imgp;
				$data['faceImg'] = $imgpath;
				//上传成功提示成功信息
//				$this->success('上传成功');

			}else{
				// 上传失败获取错误信息
				echo $file->getError();
			}
		}
		else
		{
//			$this->error('请选择上传文件');
			$data['faceImg']='';
		}
		$user = model('User');
		$data['userPass'] = 123456;
		$result = $user->insert($data);
		if ($result){
			$this->success('添加用户成功');
		}else{
			$this->error('添加用户失败');
		}


	}


}