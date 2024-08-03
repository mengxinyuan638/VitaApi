<?php

namespace app\controller;

use think\facade\Db;

class Visitor
{
    public function __construct()
    {
        //该方法为魔术方法，无需调用即可执行
        //本方法主要功能为统计累计访问数量以及当日访问数据等等

        $lockfile = "install.lock";
        if (file_exists($lockfile)) {
            // 校验安装文件若存在则显示
            $NowTime = date("Y-m-d"); //获取当前日期
            $MonthTime = date("Y-m"); //获取当前月份


            //数据库查询操作
            $VisitorData =  Db::table('visitor_data')->where('visit_time', 'total')->find(); //连接数据库查询访问用户数据这里获取的是总的访问数据
            $VisitorDataNow = Db::table('visitor_data')->where('visit_time', $NowTime)->find(); //连接数据库查询访问用户数据这里获取的是当日访问数据
            $VisitorDataMonth = Db::table('visitor_data')->where('visit_time', $MonthTime)->find(); //连接数据库查询访问用户数据这里获取的是当日访问数据


            //实现访问次数更新
            //当visit_time为total时统计次数为总的访问次数
            Db::table('visitor_data')->where('visit_time', 'total')->update([
                'visit_num' => $VisitorData['visit_num'] + 1, //总的访问次数加一
            ]);

            //当日访问数据更新
            if (empty($VisitorDataNow)) {
                //当日访问数据为空表示还未创建，创建一下

                $Data = ['visit_time' => $NowTime, 'visit_num' => 1];
                Db::name('visitor_data')->insert($Data);
            } else {
                Db::table('visitor_data')->where('visit_time', $NowTime)->update([
                    'visit_num' => $VisitorDataNow['visit_num'] + 1, //当日访问次数加一
                ]);
            }

            //当月访问数据更新
            if (empty($VisitorDataMonth)) {
                //当月访问数据为空表示还未创建，创建一下

                $Data = ['visit_time' => $MonthTime, 'visit_num' => 1];
                Db::name('visitor_data')->insert($Data);
            } else {
                Db::table('visitor_data')->where('visit_time', $MonthTime)->update([
                    'visit_num' => $VisitorDataMonth['visit_num'] + 1, //当日访问次数加一
                ]);
            }
        }else{
            echo "你还没有安装系统呢，请在浏览器地址栏输入 本站域名或IP/install/install.html进行安装吧";
            exit;
        }
    }
}
