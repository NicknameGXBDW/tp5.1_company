<?php
/**
 * Created by PhpStorm.
 * User: yeyeq
 * Date: 2018/8/10
 * Time: 14:32
 */

namespace app\admin\controller;


use think\Controller;
use think\Db;
use app\admin\model\Admin as AdminModel;
use app\admin\model\Group as GroupModel;
use app\admin\model\GroupAdmin as GroupAdminModel;
class Admin extends Common
{
//    public function initialize()
//    {
//        //后台管理员登录验证
//        if(!session('id') || !session('name')) {
//            $this->error('请先进行登录',url('admin/login/index'));
//        }
//        //管理员权限认证
//
//    }

    public function listItem()
    {
        //模型获取分页
        $adminList = AdminModel::paginate(7);
        $this->assign('adminList', $adminList);
        return $this->fetch();
    }

    public function edit()
    {
        $id = input('param.id');
        if (request()->isPost()) {
            $data = input('post.');
            $admin = AdminModel::get($id);

            //没修改密码的情况
            if(empty($data['password'])){
              $data['password'] = $admin['password'];
            }else {
                $data['password'] = md5($data['password']);
            }
            if(! empty($data['group_id'])){
                $_data['group_id'] = $data['group_id'];
                unset($data['group_id']);
            }

            Db::startTrans();

            $res1 = Db::name('admin')->update($data);
            $res2 = Db::name('group_admin')->where('uid',$id)->update($_data);
            if($res1 === false || $res2 === false){
                Db::rollback();
                $this->error('编辑管理员失败');
            }else {
                // 提交事务
                Db::commit();
                $this->success('编辑管理员成功',url('listitem'));
            }
        }
        //如果不在模型层做数据判断就得在控制器层做
        $admin = AdminModel::get($id);
        $group_id = Db::name('group_admin')->field('group_id')->where('uid',$id)->find();
        $groups = GroupModel::all();

        if($admin) {
            $this->assign('admin',$admin);
            $this->assign('groups',$groups);
            $this->assign('group_id',$group_id);

            return $this->fetch();
        }  else {
            $this->error('用户id不存在，请管理员检测数据库');
        }

    }

    public  function add()
    {
        if (request()->isPost()) {
            $data = input("post.");

            if(! empty($data['password'])){
                $data['password'] = md5($data['password']);
            }
            if(! empty($data['group_id'])){
                $_data['group_id'] = $data['group_id'];
                unset($data['group_id']);
            }

            Db::startTrans();
            $uid = Db::name('admin')->insertGetId($data);
            $_data['uid'] = $uid;
            $res2 = Db::name('group_admin')->insert($_data);

            if($uid && $res2){
                Db::commit();
                $this->success('新增管理员成功',url('listitem'));
            }else{
                Db::rollback();
                $this->error('新增管理员失败');
            }
        }

        $groups = GroupModel::all();
        $this->assign('groups',$groups);

        return $this->fetch();
    }


    public function logout()
    {
        session(null);
        $this->success('退出登录',url('admin/login/index'));
    }


    public function del($id)
    {
        $res = AdminModel::destroy($id);
        if($res){
            $this->success('删除管理员成功');
        }else {
            $this->error('删除管理员失败');
        }
    }
}