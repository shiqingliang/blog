<?php
/**
 * Created by PhpStorm.
 * User: rwh
 * Date: 2019/3/15/015
 * Time: 10:20
 */

namespace app\common\model;


use think\Model;
use traits\model\SoftDelete;

class Member extends Model
{
    //软删除
    use SoftDelete;



//登录校验
public function login($data){
    $validata = new \app\common\validate\Admin();
  
    if (!$validata->scene('login')->check($data)){
        return $validata->getError();
    }
    // unset($data['username']);
    $result = $this->where($data)->find();
    if ($result){
             //1表示用户，密码正确
        //存入session中
        $sessionData = [
            'id' => $result['id'],
            'username' => $result['username'],
            'nickname' => $result['nickname'],
            'state'    => $result['state'],
        ];
        session('index',$sessionData);

        return 1;
        }else{
        return '用户名密码错误！';
    }

}

    //添加会员
    public function add($data){
        $validate = new \app\common\validate\Member();
        if (!$validate->scene('add')->check($data)){
            return $validate->getError();
        }
        $result = $this->allowField(true)->save($data);
        if ($result){
            return 1;
        }else{
            return '会员添加失败！';
        }
    }

    //修改会员相关信息
    public function edit($data){
        $validate = new \app\common\validate\Member();
        if (!$validate->scene('member')->check($data)){
            return $validate->getError();
        }

        $MemberInfo = $this->find($data['id']);
        $MemberInfo->username = $data['username'];
        $MemberInfo->password = $data['password'];
        $MemberInfo->nickname = $data['nickname'];
        $MemberInfo->email    = $data['email'];
        $result = $MemberInfo->save();

        if ($result){
            return 1;
        }else{
            return '会员修改失败！';
        }
    }
//会员注册
    public function register($data){
        $validata = new \app\common\validate\Member();
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