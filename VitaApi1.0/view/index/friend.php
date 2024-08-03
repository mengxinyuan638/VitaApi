<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/layui/dist/css/layui.css">
    <link rel="stylesheet" type="text/css" href="/animate/animate.css">
    <title>友情链接</title>

    <style>
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

            padding: 120px 50px;
        }

        a {
            /* 去除超链接下划线 */
            text-decoration: none;
            /* 设置超链接颜色 */
            color: #1e9fff;
        }

        .linkname {
            margin-top: 5px;
            /* 内边距 */
            color: white;
            font-size: 60px;
            /* api名称颜色 */
            text-align: center;
            /* 文本居中 */
        }

        .icon {
            border-radius: 60px;
        }
    </style>
</head>

<body style="background-color: #f5f5f5;padding: 10px;">
    <header>
        <div>
            <h1 class="linkname animate__animated animate__backInDown">友情链接</h1>
        </div>
    </header>
    <div class="layui-row">
        <div class="layui-col-xs12 layui-col-sm12 layui-col-md12">
            <div class="layui-panel" style="padding: 60px 10px;">
                <div class="layui-row animate__animated animate__fadeInUp" id="api-list">
                    
                </div>
            </div>
        </div>
    </div>
</body>
<script src="/layui/dist/layui.js"></script>
<script>
    var $ = layui.jquery;

    $.get("/index/frienddata", function(data) {
        var api_data = data.data;

        for(var i = 0;i < api_data.length;i++){
            //动态添加友链块，将html代码加入ID为api-list的元素中
                $("#api-list").append("<div class='layui-col-xs12 layui-col-sm6 layui-col-md3' style='padding: 10px;'><a href='"+api_data[i]['friend_url']+"'><div class='layui-panel hvr-api-msg' style='border-radius: 16px; padding: 10px 10px;'><div class='layui-row'><div class='layui-col-xs4 layui-col-sm4 layui-col-md4' style='padding: 10px 10px;'><img class='icon' src='"+api_data[i]['friend_icon_url']+"' alt='' width='60px' height='60px'></div><div class='layui-col-xs8 layui-col-sm8 layui-col-md8'><h2>"+api_data[i]['friend_name']+"</h2><h3>简介:</h3><p>"+api_data[i]['friend_doc']+"</p></div></div></div></a></div>")
            }
        }, "json")
</script>
</html>