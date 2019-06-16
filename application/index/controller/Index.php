<?php
namespace app\index\controller;


class Index extends Base
{
    public function index()
    {
        $where = [];
        if (input('?id')){
            $where = [
                'cate_id' => input('id')
            ];
        }
        $cates = model('cate')->order('sort','asc')->select();
        $articles = model('article')->where($where)->order('create_time','desc')->paginate('5');
        //定义一个模板数据变量
        $viewDate = [
            'cates' => $cates,
            'article' => $articles
        ];
        $this->view->share($viewDate);
    return $this->fetch();
    }

//搜索
    public function search(){
        $where[] = ['title','like','%'.input('keyword'.'%')];

        $catename = input('keyword');
        $articles = model('Article')->where($where)->order('create_time','desc')->paginate('5');
        $viewData = [
            'articles' => $articles,
            'catename' => $catename,
        ];
        $this->assign($viewData);
        return $this->fetch();

    }

    

}
