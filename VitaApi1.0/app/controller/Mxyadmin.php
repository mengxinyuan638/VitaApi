<?php
namespace app\controller;
use think\facade\View;
use think\facade\Db;//引入数据库方法
use think\facade\Cookie;//引入Cookie用于后续登录状态判断

class Mxyadmin
{
    public function index()
    {
        return view::fetch();
    }

    public function login(){
        //该函数定义了登录所需要的接口

        $UserName = input('post.UserName');//获取用户名
        $ConfirmPassword = md5(input('post.confirmPassword'));//获取并用md5加密用户密码
        $Code = input('post.Code');//获取验证码

        $UserCheck =  Db::table('admin_user')->where('username',$UserName)->find();//连接数据库查询相关用户账户是否存在，此处先验证用户名是否存在

        if(!captcha_check($Code)){
            //验证码错误
            $ReturnData = json_encode(['code'=>'2','msg'=>'验证码错误']);//接口返回数据
            exit($ReturnData);//返回数据并退出脚本
        }

        if(empty($UserCheck)){
            //查无用户
            $ReturnData = json_encode(['code'=>'1','msg'=>'用户名或密码错误']);//接口返回数据
            //返回数据并退出脚本
            exit($ReturnData);
        }

        if($ConfirmPassword != $UserCheck['password']){
            //密码错误
            $ReturnData = json_encode(['code'=>'1','msg'=>'用户名或密码错误']);//接口返回数据
            //返回数据并退出脚本
            exit($ReturnData);
        }

        //最后登录的ip地址
        $LoginIp = $_SERVER["REMOTE_ADDR"];

        //Cookie设置
        Cookie::set('admin_id',$UserCheck['uid']);//保存用户uid
        Cookie::set('admin_name',$UserCheck['username']);//保存用户名称

        //成功登录进行登录数据记录
        Db::table('admin_user')->where('uid',$UserCheck['uid'])->update([
            'login_num' => $UserCheck['login_num'] +1, //登录次数加一
            'login_time_last' => time(), //记录最后登录时间
            'login_ip_last' => $LoginIp //记录最后登录ip地址
        ]);

        $ReturnData = json_encode(['code'=>'0','msg'=>'验证成功']);//接口返回数据
        //返回数据
        //使用exit()输出数据的话会导致Cookie设置失败，虽然我不知道为什么
        echo $ReturnData;
    }
}