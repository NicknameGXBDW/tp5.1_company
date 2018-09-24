<?php
namespace app\admin\controller;

use think\captcha\Captcha;
use think\Controller;
use app\admin\model\Admin as AdminModel;

class Login extends Controller
{

    public function index()
    {
        if(request()->isPost())
        {
            $res = AdminModel::Login(input('post.'));
            if($res == '1'){
                $this->success('管理员登录成功',url('admin/admin/listitem'));
            } elseif ($res == '2') {
                $this->error('密码错误');
            } elseif ($res == '4'){
                $this->error('验证码错误');
            } else {
                $this->error('管理员不存在');
            }
        }
        return $this->fetch();
    }

    public function captcha()
    {
        $captcha = new Captcha();
        return $captcha->entry();
    }
}