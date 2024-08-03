<?php

namespace app\controller;

use think\facade\View;
use think\facade\Db;

class Index extends Visitor
{
    public function index()
    {
        //获取平台信息数据
        $SiteData = Db::table("site_data")->where('id', 'site')->find(); //连接数据库查询对应id数据

        $SiteName = $SiteData['site_name']; //获取平台名称
        $SiteQQ = $SiteData['site_qq']; //获取站长qq
        $SiteLink = $SiteData['site_link']; //获取站点域名
        $SiteTitle2 = $SiteData['site_title_2']; //获取站点标题2
        $NoticeData = $SiteData['notice_data']; //获取公告内容
        $Background = $SiteData['background']; //获取背景链接

        //设置模板变量
        View::assign('site_name', $SiteName); //设置视图变量方便获取站点名称
        View::assign('site_qq', $SiteQQ); //设置视图变量方便获取站长qq
        View::assign('site_link', $SiteLink); //设置视图变量方便获取站点域名
        View::assign('site_title_2', $SiteTitle2); //设置视图变量方便获取站点副标题
        View::assign('notice_data', $NoticeData); //设置视图变量方便获取公告内容
        View::assign('background', $Background); //设置视图变量方便获取背景链接

        return view::fetch();
    }

    public function friend()
    {
        //友链视图
        return view::fetch();
    }

    public function frienddata()
    {
        //返回友链信息
        //获取链接数据库所需参数
        $ApiNum = Db::table('friend_data')->count(); //获取api数据条数


        $ApiData = Db::table("friend_data")->where('id', '1')->find(); //连接数据库查询对应id数据
        $ApiArray = array(); //初始化操作日志数组
        if (empty($ApiData)) {
            //api数据为空

            $Response = array("code" => 404, "msg" => "api数据为空");
            exit(json_encode($Response, JSON_UNESCAPED_UNICODE));
        } else {
            for ($i = 1; $i < $ApiNum + 1; $i++) {
                //遍历api数据

                $ApiData = Db::table("friend_data")->where('id', $i)->find(); //连接数据库查询对应id数据
                $ApiArray[$i - 1] = ['id' => $i, 'friend_name' => $ApiData['friend_name'], 'friend_url' => $ApiData['friend_url'], 'friend_doc' => $ApiData['friend_doc'], 'friend_icon_url' => $ApiData['friend_icon_url']];
            }
            //执行成功后返回数据
            $Response = array("code" => 200, "msg" => "成功", 'data' => $ApiArray);
            exit(json_encode($Response, JSON_UNESCAPED_UNICODE));
        }
    }

    public function noticedata()
    {
        //返回公告相关信息

        //获取平台信息数据
        $SiteData = Db::table("site_data")->where('id', 'site')->find(); //连接数据库查询对应id数据

        $Type = $SiteData['notice_type']; //公告状态

        //执行成功后返回数据
        $Response = array("code" => 200, "msg" => "成功", 'data' => array('type' => $Type));
        exit(json_encode($Response, JSON_UNESCAPED_UNICODE));
    }

    public function menudata()
    {
        //获取菜单信息

        //获取链接数据库所需参数
        $MenuNum = Db::table('menu_data')->count(); //获取menu数据条数


        $MenuData = Db::table("menu_data")->where('id', '1')->find(); //连接数据库查询对应id数据
        $MenuArray = array(); //初始化操作日志数组
        if (empty($MenuData)) {
            //菜单数据为空

            $Response = array("code" => 404, "msg" => "menu数据为空");
            exit(json_encode($Response, JSON_UNESCAPED_UNICODE));
        } else {
            for ($i = 1; $i < $MenuNum + 1; $i++) {
                //遍历菜单数据

                $MenuData = Db::table("menu_data")->where('id', $i)->find(); //连接数据库查询对应id数据
                $MenuArray[$i - 1] = ['id' => $i, 'menu_name' => $MenuData['menu_name'], 'menu_url' => $MenuData['menu_url']];
            }
            //执行成功后返回数据
            $Response = array("code" => 200, "msg" => "成功", 'data' => $MenuArray);
            exit(json_encode($Response, JSON_UNESCAPED_UNICODE));
        }
    }
}
