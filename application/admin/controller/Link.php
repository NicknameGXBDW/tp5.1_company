<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\model\Link as LinkModel;
use app\admin\validate\Link as LinkValidate;

class Link extends Common
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function listItem()
    {
        $links = LinkModel::all();
        $this->assign('links',$links);
        return $this->fetch();
    }

    public function add()
    {

        if(request()->isPost()){

            $data = input('post.');
            $validate = new LinkValidate();
//            if(!$validate->scene('add')->check($data)){
//                $this->error($validate->getError());
//            };
            if(!$validate->check($data)){
                $this->error($validate->getError());
            };
//            if (!$validate->check($data)) {
//                dump($validate->getError());
//            }

            $res = LinkModel::create($data);
            if($res) {
                $this->success('添加友情链接成功',url('listItem'));
            } else {
                $this->error('添加友情链接失败');
            }
        }
        return $this->fetch();
    }

    public function edit()
    {
        $id = input('param.id');
        if(request()->isPost()){
            $data = input('post.');
            $validate = new LinkValidate();
            if (! ($validate->check($data))) {
                $this->error($validate->getError());
            }

            $res = LinkModel::update($data);
            if($res) {
                $this->success('编辑友情链接成功',url('listItem'));
            } else {
                $this->error('编辑友情链接失败');
            }
        }
        $link = LinkModel::get($id);
        $this->assign('link',$link);
        return $this->fetch();

    }


    public function del($id)
    {
        $res = LinkModel::destroy($id);
        if ($res) {
            $this->success('删除成功',url('listItem'));
        } else {
            $this->error('删除失败');
        }
    }


}
