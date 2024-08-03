<?php
namespace app\controller;
use think\facade\Cookie;//引入Cookie用于后续登录状态判断

class Base{
    public function __construct(){
        //该方法为魔术方法，无需调用即可执行

        $AdminName = Cookie::get('admin_name');//获取管理员账户
        if(empty($AdminName)){
            header('location:/Mxyadmin/index');
            exit;
        }
    }
}