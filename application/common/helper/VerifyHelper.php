<?php
/**
 * Created by PhpStorm.
 * User: chok
 * Date: 2018/1/10
 * Time: 23:41
 */

namespace app\common\helper;
use Gregwar\Captcha\CaptchaBuilder;

class VerifyHelper
{
	/**
	 * 生成验证码
	 */
	public static function verify()
	{

		$builder = new CaptchaBuilder();
		$builder->build()->output();
		session('verify_code', $builder->getPhrase());
	}
	/**
	 * 检测验证码是否正确
	 * @param $code
	 * @return bool
	 */
	public static function check($code)
	{
		return ($code == session('verify_code') && $code != '') ? true : false;
	}
}