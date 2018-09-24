<?php
/**
 * Created by PhpStorm.
 * User: yeyeq
 * Date: 2018/8/14
 * Time: 13:05
 */

namespace app\admin\model;

use think\Model;

class Category extends Model
{
        public  function addCategory($data)
        {
           return $this->save($data);
        }

        public static function del($id)
        {
            return self::destroy($id);
        }

        public  function categoryTree()
        {
            $categorys = $this->select();
            //$categorys = $this->order('sort desc')->select();
            return $this->sort($categorys);
        }

        public function sort($data,$pid=0,$level=0){
            static $arr = array();
            foreach($data as $v){
                if($v['pid'] == $pid){
                    $v['level'] = $level;
                    $arr[] = $v;
                    $this->sort($data,$v['id'],$level+1);
                }
            }
            return $arr;
        }

        public function getSubIds($id)
        {
            $categorys = $this->select();
            return $this->_getSubIds($categorys,$id);
        }
        public function _getSubIds($data,$id)
        {
          static $arr=array();
          foreach($data as $v){
              if($v['pid'] == $id){
                  $arr[]=$v['id'];
                  $this->_getSubIds($data,$v['id']);
              }
          }
          return $arr;
        }
}