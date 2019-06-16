<?php
/**
 * Created by PhpStorm.
 * User: rwh
 * Date: 2019/3/19/019
 * Time: 10:32
 */

namespace app\common\validate;


use think\Validate;

class Comment extends Validate
{
    protected $rule = [
        'content|评论内容' => 'require',
    ];

    protected $scene = [
        //评论添加
        'comment_add' => ['content'],
    ];

}