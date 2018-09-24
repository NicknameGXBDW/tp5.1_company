<?php
/**
 * Created by PhpStorm.
 * User: yeyeq
 * Date: 2018/8/27
 * Time: 15:33
 */

namespace app\admin\validate;


use think\Validate;

class Link extends Validate
{
    protected $rule = [
        'name'=>'unique:link|require|max:25|min:3',
        'href'=>'require|url',
        'desc'=>'require'
    ];

    protected $message = [
        'name.unique'=>'链接名不得重复',
        'name.max'=>'链接名字符不能大于25！',
        'name.min'=>'链接名字符不能小于5！',
        'href.require'=>'url必须填写',
        'href.url'=>'url格式不正确，以http://或https：//开头',
        'desc.require'=>'链接描述必须填写'
    ];
    //场景就是不同的操作方法调用的验证字段可以设置为不一样的
    //例如 我添加方法 需要全部雁阵  我的修改方法 只需要雁阵标题
    //使用只需要在控制器方法验证时候调用一下scene('场景名')就对应上了！
    protected  $scene = [
        'edit' => ['name'=>'require','href',],
    ];
}