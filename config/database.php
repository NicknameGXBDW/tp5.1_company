<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    // 数据库类型
    //type参数支持命名空间完整定义，不带命名空间定义的话，默认采用\think\db\connector作为命名空间，如果使用应用自己扩展的数据库驱动
    //默认的\think\db\connector\Mysql类作为数据库连接驱动
    'type'            => 'mysql',
    // 服务器地址
    'hostname'        => '127.0.0.1',
    // 数据库名
    'database'        => 'company',
    // 用户名
    'username'        => 'root',
    // 密码
    'password'        => '123456',
    // 端口
    'hostport'        => '',
    // 连接dsn
    'dsn'             => '',
    // 数据库连接参数
    'params'          => [],
    // 数据库编码默认采用utf8
    'charset'         => 'utf8',
    // 数据库表前缀
    'prefix'          => 'general_',
    // 数据库调试模式开关（独立的）
    'debug'           => true,
    // 数据库部署方式:0 集中式(单一服务器),1 分布式(主从服务器)
    'deploy'          => 0,
    // 数据库读写是否分离 主从式有效
    'rw_separate'     => false,
    // 读写分离后 主服务器数量
    'master_num'      => 1,
    // 指定从服务器序号
    'slave_no'        => '',
    // 是否严格检查字段是否存在
    'fields_strict'   => true,
    // 数据集返回类型
    'resultset_type'  => 'array',
    // 自动写入时间戳字段
    'auto_timestamp'  => 'timestamp',
    // 时间字段取出后的默认时间格式
    'datetime_format' => 'Y-m-d H:i:s',
    // 是否需要进行SQL性能分析
    'sql_explain'     => false,
    // Query类
    'query'           => '\\think\\db\\Query',
    // 是否开启断线重连
    //如果你使用的是长连接或者命令行，在超出一定时间后，数据库连接会断开，这个时候你需要开启断线重连才能确保应用不中断。
    'break_reconnect' => false,


    //数据库配置1
    'db_config1' => [
        // 数据库类型
        'type'        => 'mysql',
        // 服务器地址
        'hostname'    => '192.168.1.8',
        // 数据库名
        'database'    => 'thinkphp',
        // 数据库用户名
        'username'    => 'root',
        // 数据库密码
        'password'    => '1234',

        // 数据库编码默认采用utf8
        'charset'     => 'utf8',
        // 数据库表前缀
        'prefix'      => 'think_',
    ],
    //数据库配置2
    'db_config2' => 'mysql://root:1234@192.168.1.10:3306/thinkphp#utf8',
];
//然后在需要动态链接的时候使用下面的方式，动态连接数据库的connect方法仅对当次查询有效。
//Db::connect('db_config1');
//Db::connect('db_config2');