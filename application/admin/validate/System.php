<?php

namespace app\admin\validate;

use think\Validate;

class System extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
	protected $rule = [
	    'name'=>['require','unique:system'],
        'en_name'=>['require','unique:system']
    ];
    
    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */	
    protected $message = [
        'name.require'=>'名称必须填写',
        'name.unique'=>'名称与已有的发生重复'
    ];
}
