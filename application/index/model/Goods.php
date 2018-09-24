<?php
/**
 * Created by PhpStorm.
 * User: yeyeq
 * Date: 2018/5/15
 * Time: 9:09
 */

namespace app\index\model;

use think\Model;

//模型会自动对应数据表，模型类的命名规则是除去表前缀的数据表名称，采用驼峰法命名，并且首字母大写
//模型名	约定对应数据表（假设数据库的前缀定义是 think_）
//User	think_user
//UserType	think_user_type
class Goods extends Model
{
    //默认主键为id，如果你没有使用id作为主键名，需要在模型中设置属性：你看这里设置主键是uid
    //5.1中模型不会自动获取主键名称，必须设置pk属性。
    protected $pk = 'goods_id';

    // 设置当前模型对应的完整数据表名称，这里也就是说 不采取模型对应数据表的方式！！
    //protected $table = 'think_user';

    // 设置当前模型的数据库连接,（默认读取数据库配置）
    //protected $connection = 'db_config';

    //数据库的所有查询方法模型中都可以支持，可以定义自己的方法，所以也可以把模型看成是数据库的增强版。
    public  function getAllGoods()
    {
        $allGoods = $this->where('goods_id' , '>', '1')->select();
        return $allGoods;
    }

//    模型的查询方法无需和数据库查询一样调用table或者name方法，因为模型会按照规则自动匹配对应的数据表，例如：
//    Db::name('user')->where('id','>',10)->select();
//    改成模型操作的话就变成
//    User::where('id','>',10)->select();
//虽然看起来是相同的查询条件，但一个最明显的区别是查询结果的类型不同。第一种方式的查询结果是一个（二维）数组，而第二种方式的查询结果是包含了模型（集合）的数据集。



}