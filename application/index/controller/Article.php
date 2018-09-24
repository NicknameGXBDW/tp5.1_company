<?php

namespace app\index\controller;


use app\index\model\Article as ArticleModel;

class Article extends Common
{
    public function index()
    {
        $id = input('param.aid');
        $article = ArticleModel::get($id);
        $article->where('id', $id)->setInc('click');

        $cid = $article->category_id;
        $hot_articles = ArticleModel::getHotArticles($cid);
        $this->assign('article',$article);
        $this->assign('hotArticles',$hot_articles);
        return $this->fetch();
    }




}
