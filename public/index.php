<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// [ 应用入口文件 ]
// 因为要使用此命名空间下的Container类
namespace think;

header("If-Modified-Since:Thu, 09 Feb 2012 09:07:57 GMT;");

// 加载基础文件
require __DIR__ . '/../thinkphp/base.php';

// 支持事先使用静态方法设置Request对象和Config对象
// 执行应用并响应

// 用container这个容器类来实例化类~~
// container的步骤 
//  bind('标识'，'内容')； //内容可以是函数 可以是完整的类名
//  写入到数组的binds['标识'] => 内容
// get('标识') 是封装了 make方法 make 根据标识 找到内容 如果是完整类 就去实例 如果是闭包 就执行闭包（闭包函数去实例） 实例是靠pecl扩展 反射类来实现的！！
 Container::get('app')->run()->send();
//Container::getInstance()->make('app')->run()->send();一样的