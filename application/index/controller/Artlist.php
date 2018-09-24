<?php

namespace app\index\controller;

use app\index\model\Category as CategoryModel;
use app\admin\model\Article as ArticleModel;

class Artlist extends Common
{
    public function index()
    {
        $cid = input('param.id');
        $subIds = CategoryModel::getSubIds($cid);

        $article_list = ArticleModel::where('category_id','IN',$subIds)->paginate(7);
        $category_info = CategoryModel::field('keywords,desc,name')->find($cid);


        $this->assign(
            array(
                'artlist'=>$article_list,
                'catInfo' =>$category_info,
            )
        );
        $hotArt = ArticleModel::where('category_id','IN',$subIds)->order('id desc')->limit(5)->select();
        $this->assign('hotArt',$hotArt);

        return $this->fetch();
    }
}
