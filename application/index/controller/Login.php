<?php
namespace app\index\controller;


use think\Controller;
use think\Session;

class Login extends Controller{
    //登录
    public function login(){
        if(request()->isAjax()){
            $data = [
                'username' => input('post.username'),
                'password' => input('post.password')
            ];
            $result = model('member')->login($data);

            if ($result == 1){
                $this->success('登录成功！','');
            }else{
                $this->error($result);
            }
        }

        return view();
    }
    
    //用户注册
    public function register(){
        if (request()->isAjax()) {
            $data = [
                'username' => input('post.username'),
                'password' => input('post.password'),
                'nickname' => input('post.nickname'),
                'conpass' => input('post.conpass'),
                'email' => input('post.email')
            ];
            $result = model('Member')->register($data);
            if ($result == 1){
                $this->success('注册成功','index/index/index');
            }else{
                $this->error($result);
            }

        }
        return $this->fetch();
    }

    public function loginOut(){

        session(null);
        if(session('?index.username')){
            $this->error('退出失败！');
        }else{
            $this->success('注销成功!', 'index/index/index');
        }
    }


    
}

?>