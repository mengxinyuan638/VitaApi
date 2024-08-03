<?php

namespace app\controller;

use think\facade\View;
use think\facade\Cookie;
use think\facade\Db;

class Home extends Base
{ //继承控制器实现权限控制
    public function index()
    {
        return view::fetch();
    }

    public function webmsg()
    {
        //编辑平台信息页面的视图
        return view::fetch();
    }

    public function apimsg()
    { //api信息页视图
        return view::fetch();
    }

    public function friendmsg()
    {
        //友情链接信息页视图
        return view::fetch();
    }

    public function logout()
    {
        //用于注销登录
        Cookie::delete('admin_name');
        Cookie::delete('admin_id');
    }

    public function work()
    { //工作台视图
        return view::fetch();
    }

    public function analysis()
    { //分析页面视图

        $UserId = Cookie::get('admin_id'); //获取用户id
        $UserName = Cookie::get('admin_name'); //获取用户名称
        $NowTime = date("Y-m-d"); //获取当前日期
        $YearTime = date("Y"); //获取当前年份

        //数据库操作
        $UserCheck = Db::table('admin_user')->where('username', $UserName)->find(); //连接数据库查询相关用户账户是否存在，此处先验证用户名是否存在
        $VisitorData = Db::table('visitor_data')->where('visit_time', 'total')->find(); //连接数据库查询总的用户访问数据
        $VisitorDataNow = Db::table('visitor_data')->where('visit_time', $NowTime)->find(); //连接数据库查询用户访问数据这里获取的是当日访问数据
        $ApiNum = Db::table('api_data')->count(); //获取api数据条数

        //获取登录数据及转换
        $LoginTime = $UserCheck['login_time_last']; //获取最后登录时间
        $LoginTime = date('Y-m-d H:i:s', $LoginTime); //将时间戳转换成时间
        $LoginIp = $UserCheck['login_ip_last']; //获取最后登录ip地址
        $LoginNum = $UserCheck['login_num']; //获取累计登录次数

        //获取访客数据及转换
        $VisitNumTotal = $VisitorData['visit_num']; //获取总的用户访问次数
        if (empty($VisitorDataNow)) {
            //当数据库中没有今日访问数据那么今日访问数据为0
            $VisitNumNow = 0; //获取当日用户访问次数
        } else {
            $VisitNumNow = $VisitorDataNow['visit_num']; //获取当日用户访问次数
        }
        //当月访客次数数据转换
        $MonthArray = array(); //初始化数据组
        for ($i = 1; $i < 13; $i++) {
            //该方法用于遍历数据库当月数据，若无数据则将当月数据设置为0

            if ($i < 10) {
                //因为date()函数返回的月份如果小于10时会显示0X，此时需要我们在$i前加上0若i大于或等于10则不加
                $m = '0' . $i;
            } else {
                $m = $i;
            }
            $VisitorDataMonth = Db::table('visitor_data')->where('visit_time', $YearTime . '-' . $m)->find(); //连接数据库查询用户访问数据这里获取的是当月访问数据
            if (empty($VisitorDataMonth)) {
                //查无当月数据设置当月为0
                $MonthArray[$i - 1] = 0;
            } else {
                //查询到当月数据将数据加入数组
                $MonthArray[$i - 1] = $VisitorDataMonth['visit_num'];
            }
        }
        $MonthArray = implode(',', $MonthArray);


        //用户登录信息视图变量设定
        View::assign('userid', $UserId); //设置视图变量方便获取用户id
        View::assign('username', $UserName); //设置视图变量方便获取用户名称
        View::assign('logintime', $LoginTime); //设置视图变量方便获取最后登录时间
        View::assign('loginip', $LoginIp); //设置视图变量方便获取最后登录ip地址
        View::assign('loginnum', $LoginNum); //设置视图变量方便获取累计登录次数

        //访客信息视图变量设定
        View::assign('visitor_num_total', $VisitNumTotal); //设置视图变量方便获取累计访客数量
        View::assign('visitor_num_now', $VisitNumNow); //设置视图变量方便获取当日访客数量
        View::assign('visitor_num_month', $MonthArray); //设置视图变量方便获取当月访客数量

        //api数据视图变量设定
        View::assign('api_data_num', $ApiNum); //设置视图变量方便获取api数量
        View::assign('data_time_year', $YearTime); //设置视图变量方便获取当前年份

        return view::fetch();
    }

    public function apidata()
    {
        //本方法用于返回api信息
        //如要新增数据记得要写四个地方
        $ApiNum = Db::table('api_data')->count(); //获取api数据条数
        $Page = $_GET['page']; //获取前端要求的页数
        $Limit = $_GET['limit']; //获取前端要求的每页条数

        $ApiDataArray = array();
        //该部分为分页功能核心算法
        if ($Page == 1) {
            //当前端要求页数为1时
            if ($ApiNum > $Limit) {
                //当api数据条数大于每页限制条数时仅打印限制的条数
                for ($i = 1; $i < $Limit + 1; $i++) {
                    //该方法用于遍历数据库数据，将数据转换成数组

                    $ApiData = Db::table('api_data')->where('id', $i)->find(); //连接数据库查询对应id数据
                    $ApiDataArray[$i - 1] = array("id" => $i, "api_name" => $ApiData['api_name'], "api_notice" => $ApiData['api_notice'], "api_link" => $ApiData['api_link'], "api_example" => $ApiData['api_example'], "api_way" => $ApiData['api_way'], "api_format" => $ApiData['api_format'], "api_return" => $ApiData['api_return'], "api_par" => $ApiData['api_par'], "api_par_return" => $ApiData['api_par_return'], "api_type" => $ApiData['api_type']);
                }
            } else {
                //当api条数小于每页限制条数时 将现有数据全部打印出来
                for ($i = 1; $i < $ApiNum + 1; $i++) {
                    //该方法用于遍历数据库数据，将数据转换成数组

                    $ApiData = Db::table('api_data')->where('id', $i)->find(); //连接数据库查询对应id数据
                    $ApiDataArray[$i - 1] = array("id" => $i, "api_name" => $ApiData['api_name'], "api_notice" => $ApiData['api_notice'], "api_link" => $ApiData['api_link'], "api_example" => $ApiData['api_example'], "api_way" => $ApiData['api_way'], "api_format" => $ApiData['api_format'], "api_return" => $ApiData['api_return'], "api_par" => $ApiData['api_par'], "api_par_return" => $ApiData['api_par_return'], "api_type" => $ApiData['api_type']);
                }
            }
        } else {
            //当前端要求页数大于1时
            $LimitTotal = ($Page - 1) * $Limit; //算出前端要求的页数之前不需要的数据总数
            if ($ApiNum - $LimitTotal > $Limit) {
                //当数据库中api信息条数减去不要的总数后还是大于限制条数那么仅打印到限制条数
                //例如数据库中有21条而前端要求第二页即LimitTotal为10，此时去掉不要的还剩下11条明显大于Limit
                //这种情况下只要打印限制的条数就行，也就是11到20即可

                for ($i = 1; $i < $Limit + 1; $i++) {
                    //该方法用于遍历数据库数据，将数据转换成数组

                    $ApiData = Db::table('api_data')->where('id', $i + $LimitTotal)->find(); //连接数据库查询对应id数据
                    $ApiDataArray[$i - 1] = array("id" => $i + $LimitTotal, "api_name" => $ApiData['api_name'], "api_notice" => $ApiData['api_notice'], "api_link" => $ApiData['api_link'], "api_example" => $ApiData['api_example'], "api_way" => $ApiData['api_way'], "api_format" => $ApiData['api_format'], "api_return" => $ApiData['api_return'], "api_par" => $ApiData['api_par'], "api_par_return" => $ApiData['api_par_return'], "api_type" => $ApiData['api_type']);
                }
            } else {
                for ($i = 1; $i < $ApiNum - $LimitTotal + 1; $i++) {
                    //该方法用于遍历数据库数据，将数据转换成数组

                    $ApiData = Db::table('api_data')->where('id', $i + $LimitTotal)->find(); //连接数据库查询对应id数据
                    $ApiDataArray[$i - 1] = array("id" => $i + $LimitTotal, "api_name" => $ApiData['api_name'], "api_notice" => $ApiData['api_notice'], "api_link" => $ApiData['api_link'], "api_example" => $ApiData['api_example'], "api_way" => $ApiData['api_way'], "api_format" => $ApiData['api_format'], "api_return" => $ApiData['api_return'], "api_par" => $ApiData['api_par'], "api_par_return" => $ApiData['api_par_return'], "api_type" => $ApiData['api_type']);
                }
            }
        }

        $ReturnArray = array("code" => 0, "message" => "", "count" => $ApiNum, "data" => $ApiDataArray);
        //返回api数据其中JSON_UNESCAPED_UNICODE参数是在转换json时防止中文乱码
        exit(json_encode($ReturnArray, JSON_UNESCAPED_UNICODE));
    }

    public function delapi()
    {
        $DelId = $_GET['id']; //获取要删除的api ID
        $ApiNum = Db::table('api_data')->count(); //获取api数据条数

        Db::table('api_data')->where('id', $DelId)->delete(); //删除对应id的api数据

        //删除算法
        for ($i = $DelId; $i < $ApiNum; $i++) {
            //该方法用于更新其他数据的id
            //原理是如：有10条数据删除了第4条那么前3条id不用动只需后面几条数据id依次减去1即可实现更新id
            Db::table('api_data')->where('id', $i + 1)->update([
                'id' => $i //将后一位id改成前一位如5变4
            ]);
        }

        //写入事件需要的变量
        $UserId = Cookie::get('admin_id'); //获取用户id
        $UserName = Cookie::get('admin_name'); //获取用户名称
        $EventTime = time(); //获取事件发生时间
        $EventIp = $_SERVER["REMOTE_ADDR"]; //获取操作者ip地址

        //写入事件发生数据
        $EventNum = Db::table('event_data')->count(); //获取操作日志数据条数
        $Event = ['id' => $EventNum + 1, 'user_name' => $UserName, 'event' => '删除ID为:' . $DelId . '的api', 'event_time' => $EventTime, 'event_ip' => $EventIp];
        Db::name('event_data')->insert($Event);

        //执行成功后返回数据
        $Response = array("code" => 200, "msg" => "删除成功");
        exit(json_encode($Response, JSON_UNESCAPED_UNICODE));
    }

    public function editapi()
    { //api信息编辑页视图
        return view::fetch();
    }

    public function apieditor()
    { //api编辑接口
        //获取AJAX请求数据
        $ApiId = $_POST['id']; //获取编辑的api数据id
        $ApiName = $_POST['api-name']; //获取api名称
        $ApiNotice = $_POST['api-notice']; //获取api公告
        $ApiLink = $_POST['api-link']; //获取api地址
        $ApiExample = $_POST['api-example']; //获取请求示例
        $ApiWay = $_POST['api-way']; //获取请求方式值为GET POST
        $ApiType = $_POST['api-type']; //获取接口状态
        $ApiFormat = $_POST['api-format']; //获取返回数据格式如: JSON TEXT IMAGE等
        $ApiReturn = $_POST['api-return']; //获取api返回数据
        $ApiPar = $_POST['api-par']; //获取接口参数数据
        $ApiParReturn = $_POST['api-par-return']; //获取接口返回参数数据

        //链接数据库并更新修改后的api数据
        Db::table('api_data')->where('id', $ApiId)->update([
            'api_name' => $ApiName, //更新api名称
            'api_notice' => $ApiNotice, //更新api简介
            'api_link' => $ApiLink,  //更新api地址
            'api_example' => $ApiExample,  //更新请求示例
            'api_way' => $ApiWay,  //更新请求方式
            'api_type' => $ApiType,  //更新接口状态
            'api_format' => $ApiFormat,  //更新返回数据格式
            'api_return' => $ApiReturn,  //更新返回数据格式
            'api_par' => $ApiPar,  //更新接口参数数据
            'api_par_return' => $ApiParReturn,  //更新接口返回参数数据
        ]);

        //写入事件需要的变量
        $UserId = Cookie::get('admin_id'); //获取用户id
        $UserName = Cookie::get('admin_name'); //获取用户名称
        $EventTime = time(); //获取事件发生时间
        $EventIp = $_SERVER["REMOTE_ADDR"]; //获取操作者ip地址

        //写入事件发生数据
        $EventNum = Db::table('event_data')->count(); //获取操作日志数据条数
        $Event = ['id' => $EventNum + 1, 'user_name' => $UserName, 'event' => '修改ID为:' . $ApiId . '的api', 'event_time' => $EventTime, 'event_ip' => $EventIp];
        Db::name('event_data')->insert($Event);

        //执行成功后返回数据
        $Response = array("code" => 200, "msg" => "编辑成功");
        exit(json_encode($Response, JSON_UNESCAPED_UNICODE));
    }

    public function addapi()
    { //添加api信息页视图
        return view::fetch();
    }

    public function apiadd()
    {
        //该方法定义了添加api的接口
        $ApiNum = Db::table('api_data')->count(); //获取api数据条数
        $UserId = Cookie::get('admin_id'); //获取用户id
        $UserName = Cookie::get('admin_name'); //获取用户名称
        $EventTime = time(); //获取事件发生时间
        $EventIp = $_SERVER["REMOTE_ADDR"]; //获取操作者ip地址

        //获取AJAX请求数据
        $ApiName = $_POST['api-name']; //获取api名称
        $ApiNotice = $_POST['api-gg']; //获取api公告
        $ApiLink = $_POST['api-dz']; //获取api地址
        $ApiExample = $_POST['api-sl']; //获取请求示例
        $ApiWay = $_POST['api-way']; //获取请求方式值为GET POST
        $ApiFormat = $_POST['api-format']; //获取返回数据格式如: JSON TEXT IMAGE等
        $ApiReturn = $_POST['api-return']; //获取接口返回数据
        $ApiPar = $_POST['api-par']; //获取接口参数数据
        $ApiParReturn = $_POST['api-par-return']; //获取接口返回参数数据


        //插入新的api数据
        $NewApiId = $ApiNum + 1;
        $Data = ['id' => $NewApiId, 'api_name' => $ApiName, 'api_link' => $ApiLink, 'api_notice' => $ApiNotice, 'api_example' => $ApiExample, 'api_way' => $ApiWay, 'api_format' => $ApiFormat, 'api_return' => $ApiReturn, 'api_par' => $ApiPar, 'api_par_return' => $ApiParReturn, 'api_type' => '正常'];
        Db::name('api_data')->insert($Data);
        //写入api调用数据
        $Data = ['id' => $NewApiId, 'date' => 'total', 'num' => '0'];
        Db::name('api_use_data')->insert($Data);

        //写入事件发生数据
        $EventNum = Db::table('event_data')->count(); //获取操作日志数据条数
        $Event = ['id' => $EventNum + 1, 'user_name' => $UserName, 'event' => '增加ID为:' . $NewApiId . '的api', 'event_time' => $EventTime, 'event_ip' => $EventIp];
        Db::name('event_data')->insert($Event);

        //执行成功后返回数据
        $Response = array("code" => 200, "msg" => "添加成功");
        exit(json_encode($Response, JSON_UNESCAPED_UNICODE));
    }

    public function eventdata()
    {
        //该方法用于获取用户操作日志

        //获取链接数据库所需参数
        $UserName = Cookie::get('admin_name');
        $EventNum = Db::table('event_data')->count(); //获取操作日志数据条数


        $EventData = Db::table("event_data")->where('id', '1')->find(); //连接数据库查询对应id数据
        $EventArray = array(); //初始化操作日志数组
        if (empty($EventData)) {
            //操作日志为空

            $Response = array("code" => 404, "msg" => "操作日志为空");
            exit(json_encode($Response, JSON_UNESCAPED_UNICODE));
        } else {
            for ($i = 1; $i < $EventNum + 1; $i++) {
                //遍历操作日志

                $EventData = Db::table("event_data")->where('id', $i)->find(); //连接数据库查询对应id数据
                $EventTime = date('Y-m-d H:i:s', $EventData['event_time']); //将时间戳转换成时间
                $EventArray[$i - 1] = ['id' => $EventData['id'], 'user_name' => $EventData['user_name'], 'event' => $EventData['event'], 'event_time' => $EventTime, 'event_ip' => $EventData['event_ip']];
            }
            //执行成功后返回数据
            $Response = array("code" => 200, "msg" => "成功", 'data' => $EventArray);
            exit(json_encode($Response, JSON_UNESCAPED_UNICODE));
        }
    }


    public function sitemsg()
    {
        //获取平台信息数据
        $SiteData = Db::table("site_data")->where('id', 'site')->find(); //连接数据库查询对应id数据

        $SiteName = $SiteData['site_name']; //获取平台名称
        $SiteQQ = $SiteData['site_qq']; //获取站长qq
        $SiteLink = $SiteData['site_link']; //获取站点域名
        $SiteTitle2 = $SiteData['site_title_2']; //获取站点标题2
        $NoticeData = $SiteData['notice_data']; //获取公告内容
        $NoticeType = $SiteData['notice_type']; //获取公告弹窗

        $ReturnArray = array("code" => 0, "message" => "成功", "data" => array("sitename" => $SiteName, "siteqq" => $SiteQQ, "sitelink" => $SiteLink, "sitetitle2" => $SiteTitle2, "noticedata" => $NoticeData, "noticetype" => $NoticeType));
        //返回api数据其中JSON_UNESCAPED_UNICODE参数是在转换json时防止中文乱码
        exit(json_encode($ReturnArray, JSON_UNESCAPED_UNICODE));
    }

    public function siteedit()
    {
        //用于修改站点信息

        //获取AJAX请求信息
        $SiteName = $_POST['site-name']; //获取站点名称
        $SiteQQ = $_POST['site-qq']; //获取站长qq
        $SiteLink = $_POST['site-url']; //获取站点域名
        $SiteTitle2 = $_POST['title-2']; //获取站点副标题


        //链接数据库并更新修改后的api数据
        Db::table('site_data')->where('id', 'site')->update([
            'site_name' => $SiteName, //更新站点名称
            'site_qq' => $SiteQQ, //更新站长qq
            'site_link' => $SiteLink, //更新站点域名
            'site_title_2' => $SiteTitle2, //更新站点副标题
        ]);

        //写入事件需要的变量
        $UserId = Cookie::get('admin_id'); //获取用户id
        $UserName = Cookie::get('admin_name'); //获取用户名称
        $EventTime = time(); //获取事件发生时间
        $EventIp = $_SERVER["REMOTE_ADDR"]; //获取操作者ip地址

        //写入事件发生数据
        $EventNum = Db::table('event_data')->count(); //获取操作日志数据条数
        $Event = ['id' => $EventNum + 1, 'user_name' => $UserName, 'event' => '修改了站点信息', 'event_time' => $EventTime, 'event_ip' => $EventIp];
        Db::name('event_data')->insert($Event);

        //执行成功后返回数据
        $Response = array("code" => 200, "msg" => "编辑成功");
        exit(json_encode($Response, JSON_UNESCAPED_UNICODE));
    }

    public function noticeedit()
    {
        //用于修改公告信息

        //获取AJAX请求信息
        $NoticeData = $_POST['notice-data']; //获取公告内容

        //链接数据库并更新修改后的api数据
        Db::table('site_data')->where('id', 'site')->update([
            'notice_data' => $NoticeData, //更新公告内容
        ]);

        //写入事件需要的变量
        $UserId = Cookie::get('admin_id'); //获取用户id
        $UserName = Cookie::get('admin_name'); //获取用户名称
        $EventTime = time(); //获取事件发生时间
        $EventIp = $_SERVER["REMOTE_ADDR"]; //获取操作者ip地址

        //写入事件发生数据
        $EventNum = Db::table('event_data')->count(); //获取操作日志数据条数
        $Event = ['id' => $EventNum + 1, 'user_name' => $UserName, 'event' => '修改了公告信息', 'event_time' => $EventTime, 'event_ip' => $EventIp];
        Db::name('event_data')->insert($Event);

        //执行成功后返回数据
        $Response = array("code" => 200, "msg" => "修改成功");
        exit(json_encode($Response, JSON_UNESCAPED_UNICODE));
    }

    public function friendadd()
    {
        //添加友链相关代码

        //该方法定义了添加api的接口
        $ApiNum = Db::table('friend_data')->count(); //获取api数据条数
        $UserId = Cookie::get('admin_id'); //获取用户id
        $UserName = Cookie::get('admin_name'); //获取用户名称
        $EventTime = time(); //获取事件发生时间
        $EventIp = $_SERVER["REMOTE_ADDR"]; //获取操作者ip地址

        //获取AJAX请求数据
        $FriendName = $_POST['friend-name']; //获取友链名称
        $FriendIconUrl = $_POST['friend-icon-url']; //获取友链头像
        $FriendDoc = $_POST['friend-doc']; //获取友链简介
        $FriendUrl = $_POST['friend-url']; //获取友链地址


        //插入新的友情链接数据
        $NewApiId = $ApiNum + 1;
        $Data = ['id' => $NewApiId, 'friend_name' => $FriendName, 'friend_url' => $FriendUrl, 'friend_doc' => $FriendDoc, 'friend_icon_url' => $FriendIconUrl];
        Db::name('friend_data')->insert($Data);

        //写入事件发生数据
        $EventNum = Db::table('event_data')->count(); //获取操作日志数据条数
        $Event = ['id' => $EventNum + 1, 'user_name' => $UserName, 'event' => '增加ID为:' . $NewApiId . '的友链', 'event_time' => $EventTime, 'event_ip' => $EventIp];
        Db::name('event_data')->insert($Event);

        //执行成功后返回数据
        $Response = array("code" => 200, "msg" => "添加成功");
        exit(json_encode($Response, JSON_UNESCAPED_UNICODE));
    }

    public function frienddata()
    {
        //返回友链数据
        //懒得改变量名直接把api表格数据的代码cv了

        //如要新增数据记得要写四个地方
        $ApiNum = Db::table('friend_data')->count(); //获取api数据条数
        $Page = $_GET['page']; //获取前端要求的页数
        $Limit = $_GET['limit']; //获取前端要求的每页条数

        $ApiDataArray = array();
        //该部分为分页功能核心算法
        if ($Page == 1) {
            //当前端要求页数为1时
            if ($ApiNum > $Limit) {
                //当api数据条数大于每页限制条数时仅打印限制的条数
                for ($i = 1; $i < $Limit + 1; $i++) {
                    //该方法用于遍历数据库数据，将数据转换成数组

                    $ApiData = Db::table('friend_data')->where('id', $i)->find(); //连接数据库查询对应id数据
                    $ApiDataArray[$i - 1] = array("id" => $i, "friend_name" => $ApiData['friend_name'], "friend_doc" => $ApiData['friend_doc'], "friend_url" => $ApiData['friend_url'], "friend_icon_url" => $ApiData['friend_icon_url']);
                }
            } else {
                //当api条数小于每页限制条数时 将现有数据全部打印出来
                for ($i = 1; $i < $ApiNum + 1; $i++) {
                    //该方法用于遍历数据库数据，将数据转换成数组
                    $ApiData = Db::table('friend_data')->where('id', $i)->find(); //连接数据库查询对应id数据
                    $ApiDataArray[$i - 1] = array("id" => $i, "friend_name" => $ApiData['friend_name'], "friend_doc" => $ApiData['friend_doc'], "friend_url" => $ApiData['friend_url'], "friend_icon_url" => $ApiData['friend_icon_url']);
                }
            }
        } else {
            //当前端要求页数大于1时
            $LimitTotal = ($Page - 1) * $Limit; //算出前端要求的页数之前不需要的数据总数
            if ($ApiNum - $LimitTotal > $Limit) {
                //当数据库中api信息条数减去不要的总数后还是大于限制条数那么仅打印到限制条数
                //例如数据库中有21条而前端要求第二页即LimitTotal为10，此时去掉不要的还剩下11条明显大于Limit
                //这种情况下只要打印限制的条数就行，也就是11到20即可

                for ($i = 1; $i < $Limit + 1; $i++) {
                    //该方法用于遍历数据库数据，将数据转换成数组

                    $ApiData = Db::table('friend_data')->where('id', $i)->find(); //连接数据库查询对应id数据
                    $ApiDataArray[$i - 1] = array("id" => $i, "friend_name" => $ApiData['friend_name'], "friend_doc" => $ApiData['friend_doc'], "friend_url" => $ApiData['friend_url'], "friend_icon_url" => $ApiData['friend_icon_url']);
                }
            } else {
                for ($i = 1; $i < $ApiNum - $LimitTotal + 1; $i++) {
                    $ApiData = Db::table('friend_data')->where('id', $i)->find(); //连接数据库查询对应id数据
                    $ApiDataArray[$i - 1] = array("id" => $i, "friend_name" => $ApiData['friend_name'], "friend_doc" => $ApiData['friend_doc'], "friend_url" => $ApiData['friend_url'], "friend_icon_url" => $ApiData['friend_icon_url']);
                }
            }
        }

        $ReturnArray = array("code" => 0, "message" => "", "count" => $ApiNum, "data" => $ApiDataArray);
        //返回api数据其中JSON_UNESCAPED_UNICODE参数是在转换json时防止中文乱码
        exit(json_encode($ReturnArray, JSON_UNESCAPED_UNICODE));
    }

    public function delfriend()
    {
        //用于删除友链
        //太懒了直接把api的代码cv过来

        $DelId = $_GET['id']; //获取要删除的api ID
        $ApiNum = Db::table('friend_data')->count(); //获取api数据条数

        Db::table('friend_data')->where('id', $DelId)->delete(); //删除对应id的api数据

        //删除算法
        for ($i = $DelId; $i < $ApiNum; $i++) {
            //该方法用于更新其他数据的id
            //原理是如：有10条数据删除了第4条那么前3条id不用动只需后面几条数据id依次减去1即可实现更新id
            Db::table('friend_data')->where('id', $i + 1)->update([
                'id' => $i //将后一位id改成前一位如5变4
            ]);
        }

        //写入事件需要的变量
        $UserId = Cookie::get('admin_id'); //获取用户id
        $UserName = Cookie::get('admin_name'); //获取用户名称
        $EventTime = time(); //获取事件发生时间
        $EventIp = $_SERVER["REMOTE_ADDR"]; //获取操作者ip地址

        //写入事件发生数据
        $EventNum = Db::table('event_data')->count(); //获取操作日志数据条数
        $Event = ['id' => $EventNum + 1, 'user_name' => $UserName, 'event' => '删除ID为:' . $DelId . '的友链', 'event_time' => $EventTime, 'event_ip' => $EventIp];
        Db::name('event_data')->insert($Event);

        //执行成功后返回数据
        $Response = array("code" => 200, "msg" => "删除成功");
        exit(json_encode($Response, JSON_UNESCAPED_UNICODE));
    }

    public function friendeditor()
    { //api编辑接口
        //获取AJAX请求数据
        $ApiId = $_POST['id']; //获取编辑的友链数据id
        $ApiName = $_POST['friend-name']; //获取友链名称
        $ApiNotice = $_POST['friend-doc']; //获取友链简介
        $ApiLink = $_POST['friend-url']; //获取友链地址
        $ApiExample = $_POST['friend-icon-url']; //获取友链头像地址

        //链接数据库并更新修改后的api数据
        Db::table('friend_data')->where('id', $ApiId)->update([
            'friend_name' => $ApiName, //更新友链名称
            'friend_doc' => $ApiNotice, //更新友链简介
            'friend_url' => $ApiLink,  //更新友链链接
            'friend_icon_url' => $ApiExample,  //更新友链头像
        ]);

        //写入事件需要的变量
        $UserId = Cookie::get('admin_id'); //获取用户id
        $UserName = Cookie::get('admin_name'); //获取用户名称
        $EventTime = time(); //获取事件发生时间
        $EventIp = $_SERVER["REMOTE_ADDR"]; //获取操作者ip地址

        //写入事件发生数据
        $EventNum = Db::table('event_data')->count(); //获取操作日志数据条数
        $Event = ['id' => $EventNum + 1, 'user_name' => $UserName, 'event' => '修改ID为:' . $ApiId . '的友链', 'event_time' => $EventTime, 'event_ip' => $EventIp];
        Db::name('event_data')->insert($Event);

        //执行成功后返回数据
        $Response = array("code" => 200, "msg" => "编辑成功");
        exit(json_encode($Response, JSON_UNESCAPED_UNICODE));
    }

    public function addfriend()
    {
        //添加友链视图
        return view::fetch();
    }

    public function editfriend()
    { //api信息编辑页视图
        return view::fetch();
    }

    public function noticetype()
    {
        //修改公告状态

        $Type = $_POST['noticetype']; //公告状态

        //链接数据库并更新修改后的api数据
        Db::table('site_data')->where('id', 'site')->update([
            'notice_type' => $Type, //更新公告状态
        ]);

        //写入事件需要的变量
        $UserId = Cookie::get('admin_id'); //获取用户id
        $UserName = Cookie::get('admin_name'); //获取用户名称
        $EventTime = time(); //获取事件发生时间
        $EventIp = $_SERVER["REMOTE_ADDR"]; //获取操作者ip地址

        //写入事件发生数据
        $EventNum = Db::table('event_data')->count(); //获取操作日志数据条数
        $Event = ['id' => $EventNum + 1, 'user_name' => $UserName, 'event' => '修改了公告状态为:' . $Type, 'event_time' => $EventTime, 'event_ip' => $EventIp];
        Db::name('event_data')->insert($Event);

        //执行成功后返回数据
        $Response = array("code" => 200, "msg" => "编辑成功");
        exit(json_encode($Response, JSON_UNESCAPED_UNICODE));
    }

    public function menumsg()
    {
        //菜单信息视图
        return view::fetch();
    }

    public function addmenu()
    {
        //添加菜单视图
        return view::fetch();
    }

    public function editmenu()
    {
        //编辑菜单
        return view::fetch();
    }

    public function menuadd()
    {
        //添加菜单相关代码

        //该方法定义了添加api的接口
        $ApiNum = Db::table('menu_data')->count(); //获取api数据条数
        $UserId = Cookie::get('admin_id'); //获取用户id
        $UserName = Cookie::get('admin_name'); //获取用户名称
        $EventTime = time(); //获取事件发生时间
        $EventIp = $_SERVER["REMOTE_ADDR"]; //获取操作者ip地址

        //获取AJAX请求数据
        $MenuName = $_POST['menu-name']; //获取菜单名称
        $MenuUrl = $_POST['menu-url']; //获取菜单地址


        //插入新的菜单数据
        $NewApiId = $ApiNum + 1;
        $Data = ['id' => $NewApiId, 'menu_name' => $MenuName, 'menu_url' => $MenuUrl];
        Db::name('menu_data')->insert($Data);

        //写入事件发生数据
        $EventNum = Db::table('event_data')->count(); //获取操作日志数据条数
        $Event = ['id' => $EventNum + 1, 'user_name' => $UserName, 'event' => '增加ID为:' . $NewApiId . '的菜单', 'event_time' => $EventTime, 'event_ip' => $EventIp];
        Db::name('event_data')->insert($Event);

        //执行成功后返回数据
        $Response = array("code" => 200, "msg" => "添加成功");
        exit(json_encode($Response, JSON_UNESCAPED_UNICODE));
    }

    public function menueditor()
    {
        //编辑菜单
        //用于修改菜单信息
        //获取AJAX请求数据
        $ApiId = $_POST['id']; //获取编辑的友链数据id
        $ApiName = $_POST['menu-name']; //获取友链名称
        $ApiLink = $_POST['menu-url']; //获取友链地址

        //链接数据库并更新修改后的api数据
        Db::table('menu_data')->where('id', $ApiId)->update([
            'menu_name' => $ApiName, //更新友链名称
            'menu_url' => $ApiLink,  //更新友链链接
        ]);

        //写入事件需要的变量
        $UserId = Cookie::get('admin_id'); //获取用户id
        $UserName = Cookie::get('admin_name'); //获取用户名称
        $EventTime = time(); //获取事件发生时间
        $EventIp = $_SERVER["REMOTE_ADDR"]; //获取操作者ip地址

        //写入事件发生数据
        $EventNum = Db::table('event_data')->count(); //获取操作日志数据条数
        $Event = ['id' => $EventNum + 1, 'user_name' => $UserName, 'event' => '修改ID为:' . $ApiId . '的菜单', 'event_time' => $EventTime, 'event_ip' => $EventIp];
        Db::name('event_data')->insert($Event);

        //执行成功后返回数据
        $Response = array("code" => 200, "msg" => "编辑成功");
        exit(json_encode($Response, JSON_UNESCAPED_UNICODE));
    }

    public function delmenu()
    {
        //删除菜单

        //用于删除友链
        //太懒了直接把api的代码cv过来

        $DelId = $_GET['id']; //获取要删除的api ID
        $ApiNum = Db::table('menu_data')->count(); //获取api数据条数

        Db::table('menu_data')->where('id', $DelId)->delete(); //删除对应id的api数据

        //删除算法
        for ($i = $DelId; $i < $ApiNum; $i++) {
            //该方法用于更新其他数据的id
            //原理是如：有10条数据删除了第4条那么前3条id不用动只需后面几条数据id依次减去1即可实现更新id
            Db::table('menu_data')->where('id', $i + 1)->update([
                'id' => $i //将后一位id改成前一位如5变4
            ]);
        }

        //写入事件需要的变量
        $UserId = Cookie::get('admin_id'); //获取用户id
        $UserName = Cookie::get('admin_name'); //获取用户名称
        $EventTime = time(); //获取事件发生时间
        $EventIp = $_SERVER["REMOTE_ADDR"]; //获取操作者ip地址

        //写入事件发生数据
        $EventNum = Db::table('event_data')->count(); //获取操作日志数据条数
        $Event = ['id' => $EventNum + 1, 'user_name' => $UserName, 'event' => '删除ID为:' . $DelId . '的菜单', 'event_time' => $EventTime, 'event_ip' => $EventIp];
        Db::name('event_data')->insert($Event);

        //执行成功后返回数据
        $Response = array("code" => 200, "msg" => "删除成功");
        exit(json_encode($Response, JSON_UNESCAPED_UNICODE));
    }

    public function menudata()
    {
        //返回菜单信息
        //懒得改变量名直接把api表格数据的代码cv了

        //如要新增数据记得要写四个地方
        $ApiNum = Db::table('menu_data')->count(); //获取api数据条数
        $Page = $_GET['page']; //获取前端要求的页数
        $Limit = $_GET['limit']; //获取前端要求的每页条数

        $ApiDataArray = array();
        //该部分为分页功能核心算法
        if ($Page == 1) {
            //当前端要求页数为1时
            if ($ApiNum > $Limit) {
                //当api数据条数大于每页限制条数时仅打印限制的条数
                for ($i = 1; $i < $Limit + 1; $i++) {
                    //该方法用于遍历数据库数据，将数据转换成数组

                    $ApiData = Db::table('menu_data')->where('id', $i)->find(); //连接数据库查询对应id数据
                    $ApiDataArray[$i - 1] = array("id" => $i, "menu_name" => $ApiData['menu_name'], "menu_url" => $ApiData['menu_url']);
                }
            } else {
                //当api条数小于每页限制条数时 将现有数据全部打印出来
                for ($i = 1; $i < $ApiNum + 1; $i++) {
                    //该方法用于遍历数据库数据，将数据转换成数组
                    $ApiData = Db::table('menu_data')->where('id', $i)->find(); //连接数据库查询对应id数据
                    $ApiDataArray[$i - 1] = array("id" => $i, "menu_name" => $ApiData['menu_name'], "menu_url" => $ApiData['menu_url']);
                }
            }
        } else {
            //当前端要求页数大于1时
            $LimitTotal = ($Page - 1) * $Limit; //算出前端要求的页数之前不需要的数据总数
            if ($ApiNum - $LimitTotal > $Limit) {
                //当数据库中api信息条数减去不要的总数后还是大于限制条数那么仅打印到限制条数
                //例如数据库中有21条而前端要求第二页即LimitTotal为10，此时去掉不要的还剩下11条明显大于Limit
                //这种情况下只要打印限制的条数就行，也就是11到20即可

                for ($i = 1; $i < $Limit + 1; $i++) {
                    //该方法用于遍历数据库数据，将数据转换成数组

                    $ApiData = Db::table('menu_data')->where('id', $i)->find(); //连接数据库查询对应id数据
                    $ApiDataArray[$i - 1] = array("id" => $i, "menu_name" => $ApiData['menu_name'], "menu_url" => $ApiData['menu_url']);
                }
            } else {
                for ($i = 1; $i < $ApiNum - $LimitTotal + 1; $i++) {
                    $ApiData = Db::table('menu_data')->where('id', $i)->find(); //连接数据库查询对应id数据
                    $ApiDataArray[$i - 1] = array("id" => $i, "menu_name" => $ApiData['menu_name'], "menu_url" => $ApiData['menu_url']);
                }
            }
        }

        $ReturnArray = array("code" => 0, "message" => "", "count" => $ApiNum, "data" => $ApiDataArray);
        //返回api数据其中JSON_UNESCAPED_UNICODE参数是在转换json时防止中文乱码
        exit(json_encode($ReturnArray, JSON_UNESCAPED_UNICODE));
    }
}
