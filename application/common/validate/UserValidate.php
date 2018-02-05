<?php
/**
 * Created by PhpStorm.
 * User: chok
 * Date: 2018/1/11
 * Time: 0:47
 */

namespace app\common\validate;
use app\common\helper\VerifyHelper;
class UserValidate
{
	// 验证规则
	protected $rule = [
		['verify', 'check_verify:thinkphp', '验证码错误']
	];

	// 自定义规则
	public function check_verify($value)
	{
		$captcha	=	new	VerifyHelper();
		return	$captcha->check($value);
	}
}