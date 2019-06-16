<?php

namespace app\admin\controller;


class Index extends Base
{
    //后台首页页面
    public function index(){
        $users = model('Admin')->order(['id'])->paginate('5');
        $viewData = [
          'users' => $users
        ];
        $this->assign($viewData);
        return $this->fetch();
    }


}

