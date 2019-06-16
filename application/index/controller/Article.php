<?php
/**
 * Created by PhpStorm.
 * User: rwh
 * Date: 2018/12/27/027
 * Time: 17:53
 */

namespace app\index\controller;


class Article extends Base
{
public function index(){
    $articleInfo = model('article')->find(input('id'));
    $comments = model('Comment')->order('create_time','desc')->paginate('5');
    $viewData = [
        'articleInfo' => $articleInfo,
        'comments' => $comments
    ];
    $this->assign($viewData);
    return $this->fetch();

}
//文章评论
public function comment_add(){
    $commentInfo = model('comment')->find(input('id'));
    $viewData = [
        'commentInfo' => $commentInfo
    ];
    $this->assign($viewData);
    if (request()->isAjax()) {
        $data = [
            'article_id' => input('post.article_id'),
            'member_id' => input('post.member_id'),
            'content' => input('post.content'),
        ];
        $result = model('Comment')->comment_add($data);
        if ($result == 1){
            $this->success('评论成功！');
        }else{
            $this->error($result);
        }
    }
    return $this->fetch();
}
}