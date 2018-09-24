<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\model\Rules as RulesModel;

class Rule extends Common
{
    public function listItem()
    {
        $rules = RulesModel::all();
        $rule_tree = RulesModel::sort($rules);
        $this->assign('rules',$rule_tree);
        return $this->fetch();
    }

    public function add()
    {
        if(request()->isPost()){
            $data = input('post.');
            $parent = RulesModel::get($data['pid']);
            if($parent){
                $data['level'] = ($parent->level) +1;
            }else {
                $data['level'] = 1;
            }
            $res = RulesModel::create($data);
            if($res !== false){
                $this->success('新增权限成功','listItem');
            }else{
                $this->error('新增权限失败');
            }
        }
        $rules = RulesModel::all();
        $rule_tree = RulesModel::sort($rules);
        $this->assign('ruleTree',$rule_tree);
        return $this->fetch();
    }

    public function edit()
    {
        $id = input('param.id');
        if(request()->isPost()){
            $data = input('post.');
            $parent = RulesModel::get($data['pid']);
            if($parent){
                $data['level'] = ($parent->level) +1;
            }else {
                $data['level'] = 1;
            }

            $res = RulesModel::where('id', $id)->update($data);
            if($res !== false){
                $this->success('修改权限成功');
            }else{
                $this->error('添加权限失败');
            }
        }

        $rules = RulesModel::all();
        $rule_tree = RulesModel::sort($rules);
        $rule = RulesModel::get($id);
        $this->assign(
            array(
                'ruleTree' => $rule_tree,
                'rule'=>$rule
            )
        );
        return $this->fetch();
    }

    public function del()
    {
        $id = input('param.id');
        $res = RulesModel::destroy($id);
        if($res){
            $this->success('删除成功',url('listItem'));
        }else {
            $this->error('删除失败');
        }
    }
}
