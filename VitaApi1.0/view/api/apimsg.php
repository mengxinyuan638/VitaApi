<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/layui/dist/css/layui.css">
    <link rel="stylesheet" type="text/css" href="/animate/animate.css">
    <style>
        .api-return-json {
            /*字体样式*/
            font-family: micsoft yahei;
            font-size: 20px;
            line-height: 2;
            color: #000000;
        }

        .hvr-api-msg {
            vertical-align: middle;
            -webkit-transform: perspective(1px) translateZ(0);
            transform: perspective(1px) translateZ(0);
            box-shadow: 0 0 1px rgba(0, 0, 0, 0);
            -webkit-transition-duration: 0.3s;
            transition-duration: 0.3s;
            -webkit-transition-property: box-shadow, transform;
            transition-property: box-shadow, transform;
        }

        .hvr-api-msg:hover,
        .hvr-api-msg:focus,
        .hvr-api-msg:active {

            box-shadow: 0 10px 10px -10px rgba(0, 0, 0, 0.5);
            -webkit-transform: scale(1.1);
            transform: scale(1.1);
        }

        header {
            background-color: #1e9fff;
            /* 背景颜色 */

            padding: 25px;
        }

        a {
            /* 去除超链接下划线 */
            text-decoration: none;
            /* 设置超链接颜色 */
            color: #1e9fff;
        }


        .apiname {
            margin-top: 5px;
            /* 内边距 */
            color: white;
            font-size: 60px;
            /* api名称颜色 */
            text-align: center;
            /* 文本居中 */
        }

        .api-id {
            color: white;
            font-size: 60px;
            /* api名称颜色 */
        }

        .count {
            color: white;
            font-size: 15px;
            padding: 0px;
            margin: 0px;
            display: inline;
        }

        .apinotice {
            padding: 5px;
            /* 内边距 */
            color: white;
            font-size: 30px;
        }

        .apilink {
            color: #1e9fff;
            display: inline-block;
            position: relative;
            font-size: 20px;
        }

        .apilink::after {
            content: '';
            position: absolute;
            width: 100%;
            transform: scaleX(0);
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: #1e9fff;
            transform-origin: bottom right;
            transition: transform 0.25s ease-out;
        }

        .apilink:hover::after {
            transform: scaleX(1);
            transform-origin: bottom left;
        }
    </style>
</head>

<body>
    <!-- 这里记录一个要点很容易出错，就是模板变量一定要是{$api_id}这样紧凑的不能是{ $api_id }这样分散的会报错 -->
    <!-- 这个小错误害我排查了好久 -->
    <header>
        <div>
            <h1 class="api-id animate__animated animate__bounceInLeft">#{$api_id}</h1>
            <h3 class="apiname animate__animated animate__backInDown" style="font-size:45px;">{$api_name}</h3>
            <div class="animate__animated animate__backInDown" style="text-align: center;">
                <p class="count ">累计调用:{$api_use_num_total}|</p>
                <p class="count ">当月调用:{$api_use_num_month}|</p>
                <p class="count ">当日调用:{$api_use_num}</p>
            </div>
            <p class="apinotice animate__animated animate__backInLeft">{$api_notice}</p>
        </div>
    </header>

    <div class="layui-row animate__animated animate__fadeInUp" style="padding: 20px;">
        <div class="layui-col-xs12 layui-col-sm6 layui-col-md3" style="padding: 10px;">
            <h2 style="color: #1e9fff;font-size: 25px;">接口请求说明:</h2>
            <br>
            <h2>请求地址:</h2>
            <br>
            <a href="{$api_link}">
                <p class="apilink">{$api_link}</p>
            </a>
            <br>
            <br>
            <h2>返回格式:</h2>
            <br>
            <span class="layui-badge layui-bg-blue">{$api_format}</span>
            <br>
            <br>
            <h2>请求方式:</h2>
            <br>
            <span class="layui-badge layui-bg-blue">{$api_way}</span>
            <br>
            <br>
            <h2>请求示例:</h2>
            <br>
            <a href="{$api_example}">
                <p class="apilink">{$api_example}</p>
            </a>
        </div>

        <div class="layui-col-xs12 layui-col-sm12 layui-col-md9" style="padding: 10px;">
            <h2 style="color: #1e9fff;font-size: 25px;">请求参数:</h2>
            <br>
            <div class="layui-panel hvr-api-msg" style="border-radius: 10px;padding: 20px;">
                <div style="font-size: 20px;">
                    <table class="layui-table">
                        <colgroup>
                            <col width="100">
                            <col width="100">
                            <col width="100">
                            <col width="300">
                        </colgroup>
                        <thead>
                            <tr>
                                <th>参数名称</th>
                                <th>参数类型</th>
                                <th>是否必填项</th>
                                <th>信息备注</th>
                            </tr>
                        </thead>
                        <tbody id="api-par">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="layui-row animate__animated animate__fadeInUp" style="padding: 20px;">
        <div class="layui-col-xs12 layui-col-sm6 layui-col-md3" style="padding: 10px;">
            <h2 style="color: #1e9fff;font-size: 25px;">接口返回示例:</h2>
            <br>
            <div class="layui-panel hvr-api-msg" style="border-radius: 10px;padding: 20px;">
                <div style="font-size: 20px;">
                    <div id="api-return">

                    </div>
                    <pre id="api-return-json" class="api-return-json"></pre>
                </div>
            </div>
        </div>

        <div class="layui-col-xs12 layui-col-sm12 layui-col-md9" style="padding: 10px;">
            <h2 style="color: #1e9fff;font-size: 25px;">返回参数:</h2>
            <br>
            <div class="layui-panel hvr-api-msg" style="border-radius: 10px;padding: 20px;">
                <div style="font-size: 20px;">
                    <table class="layui-table">
                        <colgroup>
                            <col width="100">
                            <col width="100">
                            <col width="300">
                        </colgroup>
                        <thead>
                            <tr>
                                <th>参数名称</th>
                                <th>参数类型</th>
                                <th>参数说明</th>
                            </tr>
                        </thead>
                        <tbody id="api-par-return">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="/layui/dist/layui.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    layui.use('form', function() {
        var $ = layui.jquery;

        //AJAX请求
        //该请求用作动态渲染api的返回数据以及参数数据如果type为JSON那么就将数据格式化后再动态添加到pre元素当中实现格式化展示JSON数据
        $.post("/api/apireturn", {
            id: {$api_id}
        }, function(d) {
            if (d.code != 200) {
                layer.msg(d.msg);
            } else {
                for (var i = 0; i < d.par.data.length; i++) {
                    //动态添加参数数据，将html代码加入ID为api-par的元素中
                    $("#api-par").append("<tr><td>" + d.par.data[i]['name'] + "</td><td>" + d.par.data[i]['type'] + "</td><td>" + d.par.data[i]['need'] + "</td><td>" + d.par.data[i]['doc'] + "</td></tr>")

                }
                for (var i = 0; i < d.parreturn.data.length; i++) {
                    //动态添加返回参数数据，将html代码加入ID为api-par-return的元素中
                    $("#api-par-return").append("<tr><td>" + d.parreturn.data[i]['name'] + "</td><td>" + d.parreturn.data[i]['type'] + "</td><td>" + d.parreturn.data[i]['doc'] + "</td></tr>")

                }
                if (d.type == "JSON") {
                    //json数据
                    var formattedJson = JSON.stringify(d.data, null, 2);
                    $("#api-return-json").text(formattedJson);
                } else if (d.type == "LIVE") {
                    //实时展示
                    $("#api-return").html('<iframe src="' + d.data + '" scrolling="no" frameborder="0"></iframe>');
                } else {
                    //其他数据按html代码处理
                    $("#api-return").html(d.data)
                }
            }
        }, "json");
    })
</script>

</html>