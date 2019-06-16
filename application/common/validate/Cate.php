<?php
/**
 * Created by PhpStorm.
 * User: rwh
 * Date: 2018/12/17/017
 * Time: 11:48
 */

namespace app\common\validate;


use think\Validate;

class Cate extends Validate
{
    //
    protected $rule = [
        'catename|栏目名称' => 'require|unique:cate',
        'sort|排序' => 'require|number|length:1,3',

    ];


//定义场景
    protected $scene = [
        //添加验证
        'add' => ['catename','sort'],
        //排序场景验证
        'sort' => ['sort'],
        //修改验证
        'edit' => ['catename'],
    ];

}