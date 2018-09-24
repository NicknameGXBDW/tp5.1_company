<?php
namespace app\admin\controller;

use think\Controller;
use app\admin\model\Category as CategoryModel;

class Category extends Common
{

    protected $beforeActionList = [
        'delSubs'  =>  ['only'=>'del'],
    ];

    public function index()
    {

    }

    public function listItem()
    {
        //无限极分类的栏目列表 数组
        $categorys = (new CategoryModel())->categoryTree();
        $this->assign('categorys',$categorys);
        return $this->fetch();
    }

    public function add()
    {
        if(request()->isPost()){
            $res = (new CategoryModel())->save(input('post.'));
            if($res){
                $this->success('添加成功',url('admin/category/listItem'));
            }else {
                $this->error("添加失败",url('admin/category/listItem'));
            }
        }
        $categorys = (new CategoryModel())->categoryTree();
        $this->assign('categorys',$categorys);
        return $this->fetch();
    }

    public function edit($id)
    {

        if(request()->isPost()){
            $data = input('post.');
            $category = CategoryModel::get($data['id']);
            $res= CategoryModel ::update($data);
            if($res){
                $this->success('修改栏目成功','listItem');
            }else{
                $this->error('修改栏目失败','listItem');
            }
        }
        $category_model = new CategoryModel();
        $categorys = $category_model->categoryTree();
        $this->assign('categorys',$categorys);
        $category = $category_model->find($id);
        $this->assign('category',$category);
        return $this->fetch();
    }


    public function del($id)
    {
        $res =  CategoryModel::destroy($id);
        if($res){
            $this->success('修改栏目成功','listItem');
        }else{
            $this->error('修改栏目失败','listItem');
        }
    }

    public function delSubs()
    {
        $category_model = new CategoryModel();
        $subs = $category_model->getSubIds(input('param.id'));
        if($subs){
            CategoryModel::destroy($subs);
        }
    }

}