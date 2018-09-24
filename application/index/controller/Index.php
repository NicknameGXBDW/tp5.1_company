<?php
namespace app\index\controller;

use app\admin\model\Link as LinkModel;
use app\index\model\Article as ArticleModel;
use think\Facade\Cache;
class Index extends Common
{
    public function index()
    {

// 使用文件缓存
//        Cache::set('name','2222',3600);
//        echo Cache::get('name');

// 使用Redis缓存
       Cache::store('redis')->set('name','111122222',3600);
       echo Cache::get('a');

        die;

        //链接列表
        $link_list = LinkModel::limit(5)->select();
        //
        $site_articles = ArticleModel::getSiteArticles();
        $recommend = ArticleModel::getRec();
        $article_model = new ArticleModel();
        $new_articles = $article_model->getNewArticles();

        $this->assign(
            array(
                'linkLists' => $link_list,
                'siteArticles' => $site_articles,
                'newArticles' => $new_articles,
                'recommend'=> $recommend
            )
        );

        return  $this->fetch();
    }

}
