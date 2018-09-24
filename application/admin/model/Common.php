<?php
/**
 * Created by PhpStorm.
 * User: yeyeq
 * Date: 2018/9/20
 * Time: 12:00
 */

namespace app\admin\model;


use think\Model;

class Common extends Model
{
    //加个模型检测方法
    public function checkData($field)
    {
        $data = $this->getData();
        if(in_array($field,$data)){
            return true;
        }else {
            return false;
        }
    }
}