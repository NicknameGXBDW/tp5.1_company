<?php

namespace app\admin\model;

use think\Model;

class Rules extends Model
{
    //排序
    public static function sort($data,$pid=0){
        static $arr = [];
        foreach($data as $v){
            if($v['pid'] == $pid){
                $v['dataId'] = self::getParentIds($data,$v['id'],true);
                $arr[] = $v;
                self::sort($data,$v['id']);
            }
        }
        return $arr;
    }

    //获取父级别ids,并组装成 id-子id-子子id的形式 并由sort来调用存入一个dataId 里面
    public static function getParentIds($data,$id,$clear=false)
    {
        static $arr = array();
        if($clear){
            $arr = array();
        }
        foreach($data as $v){
            if($v['id'] == $id){
                $arr[] = $id;
               self::getParentIds($data,$v['pid']);
            }
        }
        asort($arr);
        $str = implode('-',$arr);
        return $str;
    }
}
