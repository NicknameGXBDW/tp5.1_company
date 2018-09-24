<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\facade\Session;
use Auth\Auth;

class Common extends Controller
{
    public function initialize()
    {

        //管理员登录验证
        if(!Session::has('id')){
            $this->error('登录后台前请先进行管理员登录',url('login/index'));
        }

        //管理员权限认证
        $auth = new Auth();
        $controller = request()->controller();
        $action = request()->action();
        $auth_name = strtolower($controller.'/'.$action);
        $unchecked = array(
            'admin/listitem',
            'admin/logout',
            'group/listitem',
            'rule/listitem',
            'category/listitem',
            'login/index',
            'article/listitem',
            'link/listitem',
            'system/listitem'
        );

//        if(!in_array($auth_name,$unchecked)){
//
//            if(! $auth->check($auth_name,Session::get('id'))){
//                $this->error('对不起，您没有操作权限，请联系管理员','admin/listitem');
//            };
//        }

        $this->sideChecked();

    }

    public function  sideChecked()
    {
        $controller = request()->controller();

        $checked = strtolower($controller);
        $this->assign('checked',$checked);
    }



}
