<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <title>平台信息管理</title>
  <style type="text/css">

  </style>
</head>

<body>

  <!-- 站点信息管理 -->
  <div class="layui-container" style="padding: 10px;">
    <div class="layui-card" id="card" style="border-radius: 16px;">
      <div class="layui-card-header">API前台管理</div>
      <div class="layui-card-body" stytle="margin-left: 40px;">
        <form class="layui-form layui-form-pane" action="">
          <div class="layui-form-item" style="margin-top: 30px;">
            <label class="layui-form-label">平台名称</label>
            <div class="layui-input-inline">
              <input type="text" id="site-name" name="site-name" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">站长QQ</label>
            <div class="layui-input-inline">
              <input type="text" id="site-qq" name="site-qq" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">本站网址</label>
            <div class="layui-input-block">
              <input type="text" id="site-url" name="site-url" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <label class="layui-form-label">首页副标题</label>
            <div class="layui-input-block">
              <input type="text" id="title-2" name="title-2" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
          </div>
          <div class="layui-form-item">
            <button class="layui-btn layui-btn-fluid" lay-submit lay-filter="siteedit">立即修改</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- 公告管理 -->
  <div class="layui-container" style="padding: 10px;">
    <div class="layui-card" id="card" style="border-radius: 16px;">
      <div class="layui-card-header">公告管理</div>
      <div class="layui-card-body" stytle="margin-left: 40px;">
        <form class="layui-form" action="">
          <div class="layui-form-item" style="margin-top: 30px;">
            <label class="layui-form-label">公告开关</label>
            <div class="layui-input-block" id="notice-type">

            </div>
          </div>
          <div class="layui-form-item" style="margin-top: 30px;">
            <label class="layui-form-label">公告内容</label>
            <div class="layui-input-block">
              <textarea id="notice-data" name="notice-data" placeholder="请输入公告内容" class="layui-textarea"></textarea>
            </div>
          </div>
          <div class="layui-form-item">
            <button class="layui-btn layui-btn-fluid" lay-submit lay-filter="noticeedit">立即修改</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- 背景上传 -->
  <div class="layui-container" style="padding: 10px;">
    <div class="layui-card" id="card" style="border-radius: 16px;">
      <div class="layui-card-header">背景上传</div>
      <div class="layui-card-body" stytle="margin-left: 40px;">
        <div class="layui-upload-drag" style="display: block;padding:160px 0px;" id="ID-upload-drag">
          <i class="layui-icon layui-icon-upload"></i>
          <div>点击上传，或将文件拖拽到此处</div>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    layui.use('form', function() {
      var $ = layui.jquery;
      var form = layui.form;
      var upload = layui.upload;

      upload.render({
        elem: '#ID-upload-drag',
        url: '/upload/background', // 实际使用时改成您自己的上传接口即可。
        done: function(res) {
          if(res.code == '200'){
            layer.msg('上传成功');
          }else{
            layer.msg(res.msg);
          }
        }
      });


      //回显站点信息
      $.post("/home/sitemsg", function(d) {
        //前台管理
        $("body").find("#site-name").val(d.data.sitename); //回显平台名称
        $("body").find("#site-qq").val(d.data.siteqq); //回显站长qq
        $("body").find("#site-url").val(d.data.sitelink); //回显站点域名
        $("body").find("#title-2").val(d.data.sitetitle2); //回显站点副标题

        //公告管理
        $("body").find("#notice-data").val(d.data.noticedata); //回显公告内容
        //判断公告是否开启
        if (d.data.noticetype == 'true') {
          $("#notice-type").html('<input type="checkbox" name="notice-type" id="notice-type" lay-filter="notice-type" title="开启|关闭" lay-skin="switch" checked>')
          form.render('checkbox'); //渲染开关按钮
        } else {
          $("#notice-type").html('<input type="checkbox" name="notice-type" id="notice-type" lay-filter="notice-type" title="开启|关闭" lay-skin="switch">')
          form.render('checkbox'); //渲染开关按钮
        }
      }, "json");

      //站点信息修改事件
      form.on('submit(siteedit)', function(res) { //修改前台信息管理的操作
        //AJAX
        $.post("/home/siteedit", res.field, function(d) {
          if (d.code == 200) {
            //修改成功后回显站点信息
            $.post("/home/sitemsg", function(d) {
              //前台管理
              $("body").find("#site-name").val(d.data.sitename); //回显平台名称
              $("body").find("#site-qq").val(d.data.siteqq); //回显站长qq
              $("body").find("#site-url").val(d.data.sitelink); //回显站点域名
              $("body").find("#title-2").val(d.data.sitetitle2); //回显站点副标题
            }, "json");
            layer.alert('修改站点信息成功');
          } else {
            layer.alert('未知错误,修改站点信息失败');
          }
        }, "json");
      })

      //公告信息修改事件
      form.on('submit(noticeedit)', function(res) { //修改前台信息管理的操作
        //AJAX
        $.post("/home/noticeedit", res.field, function(d) {
          if (d.code == 200) {
            //修改成功后回显站点信息
            $.post("/home/sitemsg", function(d) {
              //公告管理
              $("body").find("#notice-data").val(d.data.noticedata); //回显公告内容
            }, "json");
            layer.alert('修改站点信息成功');
          } else {
            layer.alert('未知错误,修改站点信息失败');
          }
        }, "json");
      })

      //公告开关事件
      form.on('switch(notice-type)', function(data) {
        webtype = data.elem.checked;
        if (webtype == true) {
          layer.confirm("是否开启弹窗公告？", {
            icon: 3,
            title: '提示'
          }, function(index) {
            //AJAX
            $.post("/home/noticetype", {
              noticetype: "true"
            }, function(res) {
              console.log(res);
              if (res.code != 200) {
                alyer.alert('开启失败！')
              } else {
                layer.close(index); //关闭弹出层
                layer.alert('开启成功');
              }
            }, "json")
          })
        } else {
          layer.confirm("是否关闭弹窗公告？", {
            icon: 3,
            title: '提示'
          }, function(index) {
            //AJAX
            $.post("/home/noticetype", {
              noticetype: "false"
            }, function(res) {
              console.log(res);
              if (res.code != 200) {
                alyer.alert('关闭失败！')
              } else {
                layer.close(index); //关闭弹出层
                layer.alert('关闭成功');
              }

            }, "json")
          })
        }
      })

    })
  </script>
</body>

</html>