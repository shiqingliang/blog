<?php
/**
 * Created by PhpStorm.
 * User: rwh
 * Date: 2019/2/15/015
 * Time: 9:40
 */

namespace app\admin\controller;


class Member extends Base
{

    //会员列表
    public function lis(){
        $members = model('Member')->order('create_time','desc')->paginate('10');
        $viewData = [
            'members' => $members
        ];
        $this->assign($viewData);
        return $this->fetch();
    }

    //会员添加

    public function add(){
        if (request()->isAjax()){
            $data = [
                'username'=> input('post.username'),
                'password'=> input('post.password'),
                'nickname'=> input('post.nickname'),
                'email'   => input('post.email')
            ];
            $result = model('member')->add($data);
            if ($result == 1){
                $this->success('会员添加成功！','admin/member/lis');
            }else{
                $this->error($result);
            }
        }
        return $this->fetch();
    }
    public function edit(){
        if (request()->isAjax()){
            $data = [
                'id'       => input('post.id'),
                'username' => input('post.username'),
                'password' => input('post.password'),
                'nickname' => input("post.nickname"),
                'email'    => input('post.email')
            ];
            $result = model('member')->edit($data);
            if ($result == 1){
                $this->success('修改成功！','admin/member/lis');
            }else{
                $this->error($result);
            }
        }
        $MemberInfo = model('Member')->find(input('id'));
        $viewData = [
            'MemberInfo' => $MemberInfo
        ];
        $this->assign($viewData);
        return $this->fetch();
    }

    //删除会员
    public function del(){
        $memberInfo = model('Member')->find(input('post.id'));
   /*     var_dump($memberInfo);exit;*/
        $result = $memberInfo->delete();
        if ($result){
            $this->success('会员删除成功！','admin/member/lis');
        }else{
            $this->error('会员删除失败！');
        }

    }
}