<?php

namespace app\admin\controller;


class Comment extends Base
{
    //留言列表
    public function lis(){

        $comments = model('Comment')->with('article,member')->order('create_time','desc')->paginate(10);

        $viewDate = [
        'comments' => $comments
        ];

        $this->assign($viewDate);
        
        return $this->fetch();
    }


    //删除留言，评论
    public function del()
    {
        $commentInfo = model('Comment')->find(input('post.id'));
        $result = $commentInfo->delete();
        if($result){
            $this->success('评论删除成功！','admin/comment/lis');
        }else{
            $this->error('评论删除失败！');
        }
    
    }
}
