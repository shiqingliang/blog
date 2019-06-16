<?php
/**
 * Created by PhpStorm.
 * User: rwh
 * Date: 2019/3/19/019
 * Time: 10:29
 */

namespace app\common\model;


use think\Model;
use traits\model\SoftDelete;

class Comment extends Model
{

    //软删除
    use SoftDelete;
// 关联文章
    public function article(){
        return $this->belongsTo('Article','article_id','id');
    }

    public function member(){
        return $this->belongsTo('Member','member_id','id');
    }
//评论添加
    public function comment_add($data){
        $validate = new \app\common\validate\Comment();
        if (!$validate->scene('comment_add')->check($data)){
            return $validate->getError();
        }
        $result = $this->allowField(true)->save($data);
        if($result){
            return 1;
        }else{
            return '评论失败！';
        }
    }
}