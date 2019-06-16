<?php

namespace app\common\model;

use think\Model;
use traits\model\SoftDelete;

class Index extends Model
{
    //软删除
    use SoftDelete;

//登录校验
    // public function login($data){
    //     $validata = new \app\common\validate\Admin();
    //     if (!$validata->scene('login')->check($data)){
    //         return $validata->getError();
    //     }
    //     $result = $this->where($data)->find();
    //     if ($result){
    //         //判断用户是否可用
    //         if ($result['status'] !=1){
    //             return '此账户已被禁用，清联系管理员！';
    //         }
    //         //1表示用户，密码正确
    //         //存入session中
    //         $sessionData = [
    //             'id' => $result['id'],
    //             'username' => $result['username'],
    //             'nickname' => $result['nickname'],
    //             'is_super' => $result['is_super']
    //         ];
    //         session('admin',$sessionData);
    //         return 1;
    //     }else{
    //         return '用户名密码错误！';
    //     }

    // }
//注册校验
    public function register($data){
        $validata = new \app\common\validate\Admin();
        if (!$validata->scene('register')->check($data)){
            return $validata->getError();
        }
       $result = $this->allowField(true)->save($data);
        if ($result){
            mailto($data['email'],'注册账户成功！','注册账户成功！');
            return 1;
        }else{
            return '注册失败！';
        }
    }


}
