<?php
/**
 * Created by PhpStorm.
 * User: rwh
 * Date: 2019/3/15/015
 * Time: 11:17
 */

namespace app\common\validate;

;
use think\Validate;

class Member extends Validate
{
     //验证
     protected $rule = [
        'username|用户账户' => 'require|unique:member',
        'password|用户密码'   => 'require',
        'conpass|确认密码'    => 'require|confirm:password',
        'nickname|昵称'       => 'require|unique:member',
        'email|邮箱'          => 'require|email|unique:member'
    ];

//自定义验证规则
    protected $message = [
        'username.require' => '用户名不能为空！',
        'username.unique:admin' => '用户名已经存在！',
        'password.require' => '用户密码不能为空！',
        'conpass.confirm' => '确认密码和密码不一致！',
        'nickname.unique' => '亲：昵称已经存在了呢！换一个吧！',
        'email.unique'    => '亲：邮箱已存在,不能重复注册哟!'
    ];
    protected $scene = [
           //登录验证
        'login'  =>  ['username'=>'unique','password'],
      //添加
        'add' => ['username','password','nickname','email'],
        //修改
        'edit' =>['username','password','nickname','email'],
          
         //注册场景验证
         'register' => ['username','password','conpass','nickname','email'],
     
     
    ];

}