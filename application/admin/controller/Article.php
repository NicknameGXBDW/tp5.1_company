<?php

namespace app\admin\controller;

use think\Controller;

use app\admin\model\Article as ArticleModel;
use app\admin\model\Category as CategoryModel;



class Article extends Common
{

    public function listItem()
    {
        $articles = ArticleModel::with('categoryName')->order('id desc')->paginate(10);
        $this->assign('articles',$articles);
        return $this->fetch();
    }


    public function add()
    {
        $categorys = (new CategoryModel())->categoryTree();

        $this->assign('categorys',$categorys);

        if (request()->isPost()) {
            $data = input('post.');
            $article = new ArticleModel;
           // 过滤post数组中的非数据表字段数据
            $res = $article->allowField(true)->save($data);
            if ($res) {
                $this->success('文章添加成功',url('admin/article/listItem'));
            } else {
                $this->error('文章添加失败');
            }
        }
        return $this->fetch();

    }


    public function edit()
    {
        $categorys = (new CategoryModel())->categoryTree();
        $id = input('param.id');
        $article = ArticleModel::find($id);

        if(request()->isPost()){
            $data = input('post.');


            $res = ArticleModel::update($data);
            if ($res !== false){
                $this->success('文章修改成功',url('admin/article/listItem'));
            } else {
                $this->error('文章修改失败');
            }
        }
        $this->assign('categorys',$categorys);
        $this->assign('article',$article);

        return $this->fetch();
    }


    public function del($id)
    {
        $res = ArticleModel::destroy($id);
        if ($res) {
            $this->success('删除成功',url('listItem'));
        } else {
            $this->error('删除失败');
        }
    }
}
