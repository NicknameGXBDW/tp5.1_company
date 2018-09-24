<?php

namespace app\index\controller;

use app\index\model\Category as CategoryModel;
use app\admin\model\Article as ArticleModel;

class Imglist extends Common
{
    public function index()
    {
        $id = input('param.id');
        $ids = CategoryModel::getSubIds($id);
        $imgArticles = ArticleModel::where('category_id','in',$ids)->paginate(6);
        if(!$imgArticles){
            $imgArticles = [];
        }
        $this->assign('imgArticles',$imgArticles);
        return $this->fetch();
    }
}
