<?php

namespace app\admin\model;

use think\Exception;
use think\Model;
use think\facade\Env;
use think\Image;

class Article extends Common
{
    //
    public static function init()
    {
        self::event('before_insert', function ($article) {
             self::picThumb($article);
        });

        self::event('before_update', function ($article) {
              self::picThumb($article,'update');
            }
        );

        self::event('before_delete',function($article){
            self::picThumb($article,'delete');
        });
    }

    public static function picThumb($article, $action = 'add')
    {
        $root_path = Env::get("ROOT_PATH");

        if($action == 'delete'){
            //删除旧图片

            if($article->checkData('picture')){
                @unlink($root_path . 'public/upload/' . $article->picture);
            };
            if($article->checkData('thumb')){
                @unlink($root_path . 'public/upload/' . $article->thumb);
            };
        }

        if (! empty($_FILES['picture']['tmp_name'])) {

            if($action=='update'){

                if($article->checkData('picture')){
                    @unlink($root_path . 'public/upload/' . $article->picture);
                };
                if($article->checkData('thumb')){
                    @unlink($root_path . 'public/upload/' . $article->thumb);
                };

            }
            //上传新图片,移动到框架应用根目录/uploads/ 目录下
            $file = request()->file('picture');
            $path = $root_path . 'public/upload';

            if($file){
                $info = $file->move($path);
                if ($info) {
                    $picture = $info->getSaveName();
                    //再把上传上的图做成缩略图存入数据库
                    $image = Image::open($path . '/' . $picture);
                    //文件后缀
                    $extension = '.' . $info->getExtension();
                    $thumb = strstr($picture, $extension, true) . '_thumb' . $extension;
                    $image->thumb(50, 50)->save($path . '/' . $thumb);
                    //修改模型的picture和thumb值
                    $article->picture = $picture;
                    $article->thumb = $thumb;
                }
            }
        }
    }

    function categoryName()
    {
        return $this->belongsTo('Category','category_id','id');
    }
}
