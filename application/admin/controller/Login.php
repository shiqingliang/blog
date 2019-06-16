<?php
/**
 * Created by PhpStorm.
 * User: rwh
 * Date: 2018/12/13/013
 * Time: 18:39
 */
namespace app\admin\controller;


use think\Controller;
use think\Session;

class Login extends Controller
{
  /*  public function initialize()
    {
        if (session('?admin.id')){
            $this->redirect('admin/index/index');
        }
    }*/

    public function index(){
        if(request()->isAjax()){
            $data = [
                'username' => input('post.username'),
                'password' => input('post.password')
            ];
            $result = model('Admin')->login($data);

            if ($result == 1){
                $this->success('登录成功！','admin/index/index');
            }else{
                $this->error($result);
            }
        }

        return view();
    }
//注册用户
    public function register()
    {
        if (request()->isAjax()) {
            $data = [
                'username' => input('post.username'),
                'password' => input('post.password'),
                'nickname' => input('post.nickname'),
                'conpass' => input('post.conpass'),
                'email' => input('post.email')
            ];
            $result = model('Admin')->register($data);
            if ($result == 1){
                $this->success('注册成功','admin/login/index');
            }else{
                $this->error($result);
            }

        }
        return $this->fetch();

    }

    public function forget(){

        return $this->fetch();
    }
//注销登录
    public function logout(){
        session::delete('nickname');
        $this -> success('注销成功','admin/login/index');
        return $this->fetch();
    }
}