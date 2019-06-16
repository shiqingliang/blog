<?php
/**
 * Created by PhpStorm.
 * User: rwh
 * Date: 2019/3/5/005
 * Time: 14:57
 */

namespace app\index\controller;


use think\Controller;

class Base extends Controller
{

    public function base(){


        return $this->fetch();
    }
    public function initialize()
    {
        $cates = model('cate')->order('sort','asc')->select();
        $articles = model('article')->order(['title'])->paginate('5');
        //定义一个模板数据变量
        $viewDate = [
            'cates' => $cates,
            'article' => $articles
        ];
        $this->view->share($viewDate);
    }
}