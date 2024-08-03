<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <title>layui初始化</title>
  <link rel="stylesheet" type="text/css" href="/layui/dist/css/layui.css" />
</head>

<body stytle="text-align: center">
  <div class="layui-container" style="margin-top: 30px">
    <div class="layui-row">
      <form class="layui-form" action="">
        <input type="hidden" id="type" name="type" />
        <div class="layui-form-item">
          <label class="layui-form-label">友链 id</label>
          <div class="layui-input-block">
            <input type="radio" id="id" name="id" value="0" title="ID" checked />
          </div>
        </div>
        <div class="layui-form-item">
          <label class="layui-form-label">友链名称</label>
          <div class="layui-input-block">
            <input type="text" id="menu-name" name="menu-name" required lay-verify="required" placeholder="请输入友链名称" autocomplete="off" class="layui-input" />
          </div>
        </div>
        <div class="layui-form-item">
          <label class="layui-form-label">友链地址</label>
          <div class="layui-input-block">
            <input type="text" id="menu-url" name="menu-url" required lay-verify="required" placeholder="请输入友链地址" autocomplete="off" class="layui-input" />
          </div>
        </div>
        <div class="layui-form-item">
          <div class="layui-input-block">
            <button class="layui-btn layui-btn-fluid" lay-submit lay-filter="formupdate">
              立即修改
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <script src="/layui/dist/layui.js" type="text/javascript" charset="utf-8"></script>
  <script type="text/javascript">
    layui.use("form", function() {
      var $ = layui.jquery;
      var form = layui.form;

      //立即提交按钮点击事件
      form.on("submit(formupdate)", function(res) {
        //AJAX请求
        console.log(res);
        $.post(
          "/home/menueditor",
          res.field,
          function(d) {
            if (d.code != 200) {
              layer.msg(d.msg);
            } else {
              var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
              parent.layer.close(index); //再执行关闭
            }
          },
          "json"
        );

        return false;
      });
    });
  </script>
</body>

</html>