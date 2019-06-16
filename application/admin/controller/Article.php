<?php

namespace app\admin\controller;


class Article extends Base
{
    //文章列表
    public function list(){
        $articles = model('Article')->with('cate')->order(['is_top' => 'asc','create_time' =>'desc'])->paginate('10');
        //定义一个模板数据变量
        $viewDate = [
            'articles' => $articles
        ];
        $this->assign($viewDate);


        return $this->fetch();
    }
    //文章添加
    public function add(){
        if (request()->isAjax()){
            $data = [
              'title'   => input('post.title'),
              'author'  => input('post.author'),
              'tags'    => input('post.tags'),
              'is_top'  => input('post.is_top','0'),
              'cate_id' => input('post.cate_id'),
              'desc'    => input('post.desc'),
              'content' => input('post.content'),
            ];
          $result =  model('Article')->add($data);
            if ($result == 1){
                $this->success('文章添加成功！','admin/article/list');
            }else{
                $this->error($result);
            }
        }
        $cates = model('Cate')->select();
        $viewData = [
          'cates' => $cates
        ];
        $this->assign($viewData);

        return $this->fetch();
    }
    //推荐操作
    public function top(){
        $data = [
            'id'     => input('post.id'),
            'is_top' => input('post.is_top')? 0 : 1
        ];
        $result = model('Article')->top($data);
        if ($result == 1){
            $this->success('操作成功！','admin/article/list');
        }else{
            $this->error($result);
        }
    }
    //文章修改
    public function edit(){
        if (request()->isAjax()){
            $data = [
                'id'      => input('post.id'),
              'title'     => input('post.title'),
                'author'  => input('post.author'),
                'tags'    => input('post.tags'),
                'is_top'  => input('post.is_top','0'),
                'cate_id' => input('post.cate_id'),
                'desc'    => input('post.desc'),
                'content' => input('post.content')
            ];

            $result = model('article')->edit($data);
            if ($result == 1){
                $this->success('文章修改成功！','admin/article/list');
            }else{
                $this->error($result);
            }
        }

        $articleInfo = model('Article')->find(input('id'));
        $cates = model('Cate')->select();
        $viewData = [
            'articleInfo' => $articleInfo,
            'cates' => $cates
        ];
        $this->assign($viewData);
        return $this->fetch();

    }
    //文章的删除
    public function del(){
        $cateInfo = model('Article')->find(input('post.id'));
        $result = $cateInfo->delete();
        if ($result){
            $this->success('文章删除成功！','admin/article/list');
        }else{
            $this->error('文章删除失败！');
        }
    }
}
