<?php
/**
 * Created by PhpStorm.
 * User: rwh
 * Date: 2018/12/24/024
 * Time: 15:31
 */

namespace app\common\validate;

use think\Validate;

class Article extends Validate
{
//验证规则
protected $rule = [
    'title|文章标题'    => 'require',
    'author|作者'    => 'require',
    'tags|标签'         => 'require',
    'cate_id|所属栏目'  => 'require',
    'desc|文章概要'     => 'require',
    'content|文章内容'  => 'require',
];

//定义场景
    protected $scene = [
        //添加验证
        'add' => ['title','author','tags','cate_id','desc','content'],
        //排序场景验证
        'top' => ['id','is_top'],
        //修改验证
        'edit' => ['title','author','tags','is_top','cate_id','desc','content'],
        //
    ];

}