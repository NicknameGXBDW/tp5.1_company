<?php

namespace app\index\model;

use think\Model;
use app\index\model\Category as CategoryModel;

class Article extends Model
{
    //
    public static function getHotArticles($cid)
    {
        $child_ids = CategoryModel::getSubIds($cid);
        $hot_articles = self::where('category_id','in',$child_ids)->order('click desc')->limit(5)->select();
        return $hot_articles;
    }

    public static function getSiteArticles()
    {
        $site_articles = self::field('id,title,thumb')->order('click desc')->limit(5)->select();
        return $site_articles;
    }

    public static function getRec()
    {
        $rec_article = self::field('id,title,desc,picture')->where('recommend','=',1)->select();
        return $rec_article;
    }

    public function getNewArticles()
    {
        $new_articles = $this->with('relationCategory')->order('id desc')->limit(10)->select();
        foreach($new_articles as &$val) {
            $val -> hidden(['relationCategory.id','id','keywords']);
        }
        return $new_articles;
    }

    public function relationCategory()
    {
        return $this->belongsTo('Category','category_id','id');
    }

}
