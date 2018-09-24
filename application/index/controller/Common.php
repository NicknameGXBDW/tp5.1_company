<?php

namespace app\index\controller;

use app\index\model\Category;
use think\Controller;
use think\Request;
use app\admin\model\System as SystemModel;
use app\index\model\Category as CategoryModel;

class Common extends Controller
{
    protected function initialize()
    {
        //所有自定义控制器类继承的类的初始用方法
        //配置的获取
        $this->getSystem();        
        //栏目的获取
        $this->getNavCate();
        //当前位置
        $this->getCurrentPos();
    }

    protected function getSystem()
    {
        $system = SystemModel::field('en_name,value')->select();
        foreach($system as $v){
            $k = $v['en_name'];
            $System[$k] = $v['value'];
        }
        $this->assign('system',$System);

    }
    protected function getNavCate()
    {
        $categorys = CategoryModel::where('pid','=',0)->select()->toArray();
        foreach ($categorys as $k => $v){
            $children = CategoryModel::where('pid','=',$v['id'])->select()->toArray();
            if ($children){
                $categorys[$k]['children'] = $children;
            } else {
                $categorys[$k]['children'] = 0;
            }
        }
        $this->assign('categorys',$categorys);
    }

    protected function getCurrentPos()
    {
        //注意  我们要的是栏目的id 如果从栏目页访问当然是有的 但是如果从文章页拿就得通过文章id先那到栏目id
        if (input('param.id')) {
            $id = input('param.id');
            $posArr = CategoryModel::getParents($id);
        } elseif (input('param.aid')) {
            $artid = input('param.aid');
            $id = (\app\admin\model\Article::get($artid))->category_id;
            $posArr = CategoryModel::getParents($id);
        } else {
            $posArr = array();
        }

        $this->assign('posArr',$posArr);
    }
}
