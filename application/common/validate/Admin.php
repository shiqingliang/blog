<?php
/**
 * Created by PhpStorm.
 * User: rwh
 * Date: 2018/12/12/012
 * Time: 19:03
 */

namespace app\common\validate;


use think\Validate;

class Admin extends Validate
{
    //验证
        protected $rule = [
            'username|用户账户' => 'require',
            'password|用户密码'   => 'require',
            'conpass|确认密码'    => 'require|confirm:password',
            'nickname|昵称'       => 'require|unique:admin',
            'email|邮箱'          => 'require|email|unique:admin'
        ];

//自定义验证规则
        protected $message = [
            'username.require' => '用户名不能为空！',
            'password.require' => '用户密码不能为空！',
            'conpass.confirm' => '确认密码和密码不一致！',
            'nickname.unique' => '亲：昵称已经存在了呢！换一个吧！',
            'email.unique'    => '亲：邮箱已存在,不能重复注册哟!'
        ];

//验证场景
    protected $scene = [
        //登录验证
        'login'  =>  ['username','password'],
        //注册场景验证
        'register' => ['username','password','conpass','nickname','email'],
    ];



}