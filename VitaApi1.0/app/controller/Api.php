<?php

namespace app\controller;

use think\db\Where;
use think\facade\Db; //引入数据库方法
use think\facade\View;

class Api
{
    public function apidata()
    {
        //该方法用于获取api列表

        //获取链接数据库所需参数
        $ApiNum = Db::table('api_data')->count(); //获取api数据条数


        $ApiData = Db::table("api_data")->where('id', '1')->find(); //连接数据库查询对应id数据
        $ApiArray = array(); //初始化操作日志数组
        if (empty($ApiData)) {
            //api数据为空

            $Response = array("code" => 404, "msg" => "api数据为空");
            exit(json_encode($Response, JSON_UNESCAPED_UNICODE));
        } else {
            for ($i = 1; $i < $ApiNum + 1; $i++) {
                //遍历api数据

                $ApiData = Db::table("api_data")->where('id', $i)->find(); //连接数据库查询对应id数据
                $ApiUseData = Db::table("api_use_data")->where('id', $i)->where('date', 'total')->find(); //连接数据库查询对应id数据
                if(empty($ApiUseData)){
                    //判断一下api调用次数是否存在，如果不存在就把调用次数弄成0
                    $UseNum = '0';
                }else{
                    $UseNum = $ApiUseData['num'];
                }
                $ApiArray[$i - 1] = ['id' => $i, 'api_type' => $ApiData['api_type'], 'api_name' => $ApiData['api_name'], 'api_link' => $ApiData['api_link'], 'api_notice' => $ApiData['api_notice'], 'api_use_num' => $UseNum];
            }
            //执行成功后返回数据
            $Response = array("code" => 200, "msg" => "成功", 'data' => $ApiArray);
            exit(json_encode($Response, JSON_UNESCAPED_UNICODE));
        }
    }

    public function apimsg()
    {
        //api详情页面视图
        $ApiId = $_GET['id']; //获取要访问的api详情页面id

        //获取目标api数据
        $NowTime = date("Y-m-d"); //获取当前日期
        $MonthTime = date("Y-m"); //获取当前月份
        $ApiData = Db::table("api_data")->where('id', $ApiId)->find(); //连接数据库查询对应id数据
        $ApiUseTotalData = Db::table("api_use_data")->where('id', $ApiId)->where('date', 'total')->find(); //连接数据库查询对应id数据
        $ApiUseData = Db::table("api_use_data")->where('id', $ApiId)->where('date', $NowTime)->find(); //连接数据库查询对应id数据
        $ApiUseMonthData = Db::table("api_use_data")->where('id', $ApiId)->where('date', $MonthTime)->find(); //连接数据库查询对应id数据
        

        $ApiName = $ApiData['api_name']; // 获取api名称
        $ApiLink = $ApiData['api_link']; //获取api地址
        $ApiNotice = $ApiData['api_notice']; //获取api简介
        $ApiExample = $ApiData['api_example']; //获取请求示例
        $ApiWay = $ApiData['api_way']; //获取请求方式
        $ApiFormat = $ApiData['api_format']; //获取返回数据格式
        if (empty($ApiUseTotalData)) {
            // 为空插入数据
            $Data = ['id' => $ApiId, 'date' => 'total', 'num' => '0'];
            Db::name('api_use_data')->insert($Data);
            $ApiUseTotalNum = '0';
        } else {
            $ApiUseTotalNum = $ApiUseTotalData['num']; //获取总的调用次数
        }
        if (empty($ApiUseMonthData)) {
            $UseMonthNum = '0';
        } else {
            $UseMonthNum = $ApiUseMonthData['num']; //获取当月调用次数
        }
        if (empty($ApiUseData)) {
            $UseNum = '0';
        } else {
            $UseNum = $ApiUseData['num']; //获取当日调用次数
        }



        //设置模板变量
        View::assign('api_id', $ApiId); //设置视图变量方便获取api id
        View::assign('api_name', $ApiName); //设置视图变量方便获取api name
        View::assign('api_link', $ApiLink); //设置视图变量方便获取api link
        View::assign('api_notice', $ApiNotice); //设置视图变量方便获取api notice
        View::assign('api_example', $ApiExample); //设置视图变量方便获取api example
        View::assign('api_way', $ApiWay); //设置视图变量方便获取api way
        View::assign('api_format', $ApiFormat); //设置视图变量方便获取api format
        View::assign('api_use_num_total', $ApiUseTotalNum); //设置视图变量方便获取api总的调用次数
        View::assign('api_use_num_month', $UseMonthNum); //设置视图变量方便获取api当月调用次数
        View::assign('api_use_num', $UseNum); //设置视图变量方便获取api当日调用次数

        return view::fetch();
    }

    public function apireturn()
    {
        //获取api返回数据

        $ApiId = $_POST['id']; //获取对应数据api id

        //数据库操作
        $ApiData = Db::table('api_data')->where('id', $ApiId)->find(); //连接数据库查询对应id数据
        $DataType = $ApiData['api_format']; //获取api返回数据类型方便展示图片或json
        $ReturnData = $ApiData['api_return']; //获取api返回数据
        $ParData = $ApiData['api_par']; //获取接口参数数据
        $ParData = json_decode($ParData); //解码将json数据转为数组方便后续转码
        $ParReturnData = $ApiData['api_par_return']; //获取接口返回参数数据
        $ParReturnData = json_decode($ParReturnData); //解码将json数据转为数组方便后续转码

        //执行成功后返回数据
        if ($DataType == "JSON") {
            $ReturnData = json_decode($ReturnData);
        }
        $Response = array("code" => 200, "msg" => "请求成功", "type" => $DataType, "data" => $ReturnData, "par" => $ParData, "parreturn" => $ParReturnData);
        exit(json_encode($Response, JSON_UNESCAPED_UNICODE));
    }

    public function search()
    {
        //用于实现api搜索


        //获取AJAX请求
        $ApiName = $_POST['value']; //获取请求的api名称或关键字

        //数据库操作
        $ApiData1 = Db::table('api_data')->where('api_name', 'like', '%' . $ApiName . '%')->select(); //连接数据库查询对应id数据
        $DataNum = Db::table('api_data')->where('api_name', 'like', '%' . $ApiName . '%')->count();

        $ApiArray = array(); //初始化操作日志数组
        if (empty($ApiData1[0])) {
            //api数据为空
            $Response = array("code" => 404, "msg" => "api数据为空");
            exit(json_encode($Response, JSON_UNESCAPED_UNICODE));
        } else {
            for ($i = 0; $i < $DataNum; $i++) {
                //遍历api数据

                $ApiData = $ApiData1[$i];
                $ApiArray[$i] = ['id' => $ApiData['id'], 'api_type' => $ApiData['api_type'], 'api_name' => $ApiData['api_name'], 'api_link' => $ApiData['api_link'], 'api_notice' => $ApiData['api_notice']];
            }
            //执行成功后返回数据
            $Response = array("code" => 200, "msg" => "成功", 'data' => $ApiArray);
            exit(json_encode($Response, JSON_UNESCAPED_UNICODE));
        }
    }

    public function count()
    {
        //用于统计api调用次数

        $Id = $_POST['id']; //获取接口提供的api id

        $NowTime = date("Y-m-d"); //获取当前日期
        $MonthTime = date("Y-m"); //获取当前月份

        //数据库操作
        $ApiTotalData = Db::table("api_use_data")->where('id', $Id)->where('date', 'total')->find(); //连接数据库查询对应id总的数据
        $ApiMonthData = Db::table("api_use_data")->where('id', $Id)->where('date', $MonthTime)->find(); //连接数据库查询对应id当月数据
        $ApiData = Db::table("api_use_data")->where('id', $Id)->where('date', $NowTime)->find(); //连接数据库查询对应id当日数据


        if (empty($ApiTotalData)) {
            // 为空插入数据
            $Data = ['id' => $Id, 'date' => 'total', 'num' => '1'];
            Db::name('api_use_data')->insert($Data);
        } else {
            $UseTotalNum = $ApiTotalData['num']; //获取总调用次数
            Db::table('api_use_data')->where('id', $Id)->where('date', 'total')->update([
                'num' => $UseTotalNum + 1, //更新总调用次数
            ]);
        }
        if (empty($ApiMonthData)) {
            $Data = ['id' => $Id, 'date' => $MonthTime, 'num' => '1'];
            Db::name('api_use_data')->insert($Data);
        } else {
            $UseMonthNum = $ApiMonthData['num']; //获取当月调用次数
            Db::table('api_use_data')->where('id', $Id)->where('date', $MonthTime)->update([
                'num' => $UseMonthNum + 1, //更新当月调用次数
            ]);
        }
        if (empty($ApiData)) {
            $Data = ['id' => $Id, 'date' => $NowTime, 'num' => '1'];
            Db::name('api_use_data')->insert($Data);
        } else {
            $UseNum = $ApiData['num']; //获取当日调用次数
            Db::table('api_use_data')->where('id', $Id)->where('date', $NowTime)->update([
                'num' => $UseNum + 1, //更新当日调用次数
            ]);
        }

        //执行成功后返回数据
        $Response = array("code" => 200, "msg" => "成功");
        exit(json_encode($Response, JSON_UNESCAPED_UNICODE));
    }
}
