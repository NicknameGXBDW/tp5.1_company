<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use app\index\model\Article as ArticleModel;

class Search extends Controller
{
    public function index()
    {
        $data = input('param.q');
        $map[] = ['title','like','%'.$data.'%'];
        $map[] = ['content','like','%'.$data.'%'];
        $res = ArticleModel::whereOr($map)->paginate(10,true,[
            'q'     => $data,
        ]);
        foreach($res as $v)
        {
            var_dump($v);
        }

        die;
    }
}
