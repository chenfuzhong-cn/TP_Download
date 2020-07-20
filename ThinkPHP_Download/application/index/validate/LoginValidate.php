<?php

namespace app\index\validate;

use think\Validate;

class LoginValidate extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
	protected $rule = [
        'username' => 'require|token',
        'password' => 'require',
        'vcode' => 'require|captcha',
    ];
    
    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */	
    protected $message = [
        'username.require' => '账号不能为空',
        'password.reqire' => '密码不能为空',
        'vcode.require' => '验证码不能为空',
        'vcode.captcha' => '验证码错误',
    ];
}
