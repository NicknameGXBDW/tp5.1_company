<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\model\Rules as RulesModel;
use app\admin\model\Group as GroupModel;


class Group extends Common
{
    public function listItem()
    {
        $group = GroupModel::all();
        //$rule_tree = RulesModel::sort($rules);
        $this->assign('groups',$group);
        return $this->fetch();
    }

    public function add()
    {
        if(request()->isPost()){
            $data = input('post.');
            //这里要把用户组的勾选权限也加进去
            if(isset($data['rules']) && is_array($data['rules'])){
                $data['rules'] = implode(',',$data['rules']);
            }

            $res = GroupModel::create($data);

            if($res !== false){
                $this->success('新增用户组成功');
            }else{
                $this->error('新增用户组失败');
            }
        }


        $rules = (new RulesModel())->select();
        $rule_tree = RulesModel::sort($rules);
        $this->assign('rules',$rule_tree);
        return $this->fetch();
    }

    public function edit()
    {

        $id = input('param.id');
        if(request()->isPost()){
            $data = input('post.');
            if(isset($data['rules']) && is_array($data['rules'])){
                $data['rules'] = implode(',',$data['rules']);
            }

            $res = GroupModel::where('id',$id)->update($data);

            if($res !== false){
                $this->success('编辑用户组成功',url('listItem'));
            }else{
                $this->error('编辑用户组失败');
            }
        }

        $rules = (new RulesModel())->select();
        $rule_tree = RulesModel::sort($rules);

        $group = GroupModel::get($id);
        $group_rules = $group->rules;
        $arr = explode(',',$group_rules);

        foreach($rule_tree as &$v){
            if(in_array($v->id,$arr)){
                $v->ruleChecked = true;
            }else{
                $v->ruleChecked = false;
            }
        }

        $this->assign('group',$group);
        $this->assign('rules',$rule_tree);
        return $this->fetch();
    }

    public function del()
    {
        $id = input('param.id');
        $res = GroupModel::destroy($id);
        if($res){
            $this->success('删除成功',url('listItem'));
        }else {
            $this->error('删除失败');
        }
    }
}
