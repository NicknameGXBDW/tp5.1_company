<?php

namespace app\index\controller;


use app\index\model\Category as CategoryModel;

class Page extends Common
{
    public function index()
    {
        $id = input('param.id');
        $res = CategoryModel::get($id);
        $this->assign('category',$res);
        return $this->fetch();
    }
}
