<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\validate\System as SystemValidate;
use app\admin\model\System as SystemModel;

class System extends Common
{
    public function listItem()
    {
        $list =  (new SystemModel())->paginate(7);
        $this->assign('list',$list);
        return $this->fetch();
    }
    public function add()
    {
        if(request()->isPost()) {
            $data = input('post.');
            $validate = new SystemValidate();
            if (! $validate->check($data)){
                $this->error($validate->getError());
            }
            if($data['values']){
               $data['values'] = str_replace('，', ',', $data['values']);
            }
            $res = SystemModel::create($data);
            if($res){
                $this->success('添加成功','admin/system/listItem');
            } else {
                $this->error('添加失败');
            }
        }
        return $this->fetch();
    }

    public function edit()
    {
        $id = input('param.id');
        if(request()->isPost()) {
            $data = input('post.');
            $validate = new SystemValidate();
            if (! $validate->check($data)){
                $this->error($validate->getError());
            }
            if($data['values']){
                $data['values'] = str_replace('，', ',', $data['values']);
            }
            $res = SystemModel::update($data);
            if($res){
                $this->success('修改成功','admin/system/listItem');
            } else {
                $this->error('添加失败');
            }
        }
        $system = SystemModel::get($id);
        $this->assign('system',$system);
        return $this->fetch();
    }


    public function conf()
    {

        if(request()->isPost()){
            //复选框如果没有勾选 那么是不会存在post里面的 我们验证码是复选的 只有开 不点开默认是关
            //但是因为是没勾选 所以post不会有 就不会去更新
            $data = input('post.');
            $all = SystemModel::column('en_name');

            foreach($all as $v){
                if(!array_key_exists($v,$data)){
                    $checkbox[$v] = '';
                }
            }

            if(isset($checkbox)){
                $data = array_merge($data,$checkbox);
            }

            foreach($data as $k => $v){
                SystemModel::where('en_name',$k)->update(['value'=>$v]);
            }

            $this->success('配置项修改成功');

        }
        $system = SystemModel::all();
        $this->assign('system',$system);
        return $this->fetch();
    }
}
