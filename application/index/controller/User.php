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
use think\Model;

class User extends Controller
{
	function __construct()
	{
		parent::__construct();
	}
	public function index(){
		return view('user');
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

		$result = $this->validate($data, 'UserValidate.register');
		if(is_array($result)) {
			return $this->err('注册失败', ['valid' => $result]);
		}
		$user = Model('User');

	}
}