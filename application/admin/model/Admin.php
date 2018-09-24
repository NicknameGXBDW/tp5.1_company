<?php
/**
 * Created by PhpStorm.
 * User: yeyeq
 * Date: 2018/8/14
 * Time: 13:05
 */

namespace app\admin\model;

use think\captcha\Captcha;
use think\Model;
class Admin extends Model
{
        public static function addAdmin($data)
        {
            if(isset($data['password'])){
                $data['password'] =  md5($data['password']);
            }
            return self::create($data);
        }


        public static function login($data)
        {
            $captcha = $data['captcha'];

            $admin = self::getByName($data['name']);
            if($admin){
                if($admin['password'] == md5($data['password'])){

                    if(!(new Captcha())->check($captcha)){
                        return 4;//验证码错误
                    }

                    session('id',$admin['id']);
                    session('name',$admin['name']);
                    return 1;  //登录成功啊
                }else {
                    return 2;   //密码错误
                }
            }else {
                return 3;   //管理员名错误
            }
        }
}