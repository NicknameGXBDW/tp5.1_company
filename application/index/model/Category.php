<?php

namespace app\index\model;

use think\Model;

class Category extends Model
{
    public static  function getSubIds($cid)
    {
        $all = self::all();
        $arr = self::_getSubIds($all,$cid);
        $arr[] = intval($cid);
        $str = implode(',', $arr);
        return $str;

    }

    protected static function _getSubIds($all,$cid)
    {
        static $arr=[];
        foreach($all as $v){
            if($v['pid'] == $cid){
                $arr[]=$v['id'];
                self::_getSubIds($all,$v['id']);
            }
        }
        return $arr;
    }

    public static function getParents($cid)
    {
        $all = self::field('id,pid,name')->select();
        $cat = self::field('id,pid,name')->find($cid);
        $pid = $cat->getData('pid');
        $arr = self::_getParents($all,$pid);
        $arr[] = $cat;
        asort($arr);
        return $arr;

    }

    public static function _getParents($all,$pid)
    {
        static $arr=[];
        foreach($all as $v){
            if($v['id'] == $pid){
                $arr[]=$v;
                self::_getParents($all,$v['pid']);
            }
        }
        return $arr;
    }

}
