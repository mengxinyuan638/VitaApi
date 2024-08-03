<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <title>添加api</title>
  <link rel="stylesheet" type="text/css" href="/layui/dist/css/layui.css">
</head>

<body>
  <div class="layui-container" style="padding:15px">
    <div class="layui-row">
      <form class="layui-form" action="">
        <div class="layui-form-item">
          <label class="layui-form-label">API名称</label>
          <div class="layui-input-block">
            <input type="text" name="api-name" required lay-verify="required" placeholder="请输入API名称" autocomplete="off"
              class="layui-input">
          </div>
        </div>
        <div class="layui-form-item">
          <label class="layui-form-label">API简介</label>
          <div class="layui-input-block">
            <input type="text" name="api-gg" required lay-verify="required" placeholder="请输入API简介" autocomplete="off"
              class="layui-input">
          </div>
        </div>
        <div class="layui-form-item">
          <label class="layui-form-label">API地址</label>
          <div class="layui-input-block">
            <input type="text" name="api-dz" required lay-verify="required" placeholder="请输入API地址" autocomplete="off"
              class="layui-input">
          </div>
        </div>
        <div class="layui-form-item">
          <label class="layui-form-label">请求示例</label>
          <div class="layui-input-block">
            <input type="text" name="api-sl" required lay-verify="required" placeholder="请输入请求示例" autocomplete="off"
              class="layui-input">
          </div>
        </div>
        <div class="layui-form-item">
          <label class="layui-form-label">请求方式</label>
          <div class="layui-input-block">
            <select name="api-way" required lay-verify="required">
              <option value="">请选择</option>
              <option value="GET">GET</option>
              <option value="POST">POST</option>
            </select>
          </div>
        </div>
        <div class="layui-form-item">
          <label class="layui-form-label">返回格式</label>
          <div class="layui-input-block">
            <select name="api-format" required lay-verify="required">
              <option value="">请选择</option>
              <option value="IMAGE">IMAGE</option>
              <option value="TEXT">TEXT</option>
              <option value="JSON">JSON</option>
              <option value="URL">URL</option>
              <option value="LIVE">实时(返回数据填接口地址)</option>
            </select>
          </div>
        </div>
        <div class="layui-form-item">
          <label class="layui-form-label">返回数据</label>
          <div class="layui-input-block">
            <textarea name="api-return" required lay-verify="required" placeholder="请在这里输入接口返回数据,注意JSON数据一定要按照JSON格式来,格式正确才会自动解析,IMAGE可以使用img标签来显示图像其余类型可直接输入文本并且可以使用html语法如<img>标签等等" class="layui-textarea"></textarea>
          </div>
        </div>
        <div class="layui-form-item">
          <label class="layui-form-label">接口参数</label>
          <div class="layui-input-block">
            <textarea name="api-par" required lay-verify="required" placeholder='请在这里输入接口参数,请输入JSON格式如{"data":[{"name": "q","doc": "你要问的问题","type": "str","need": "否"},{"name": "q2","doc": "你要问的问题2","type": "str","need": "否"}]},注意doc以及type,name为必填项,name为参数名,doc为接口参数描述，type为参数数据类型，need为参数是否必填,请务必确保填入数据格式正确' class="layui-textarea"></textarea>
          </div>
        </div>
        <div class="layui-form-item">
          <label class="layui-form-label">接口返回参数</label>
          <div class="layui-input-block">
            <textarea name="api-par-return" required lay-verify="required" placeholder='请在这里输入接口返回参数,请输入JSON格式如{"data":[{"name": "code","doc": "返回状态码","type": "int"},{"name": "data","doc": "接口返回的数据","type": "str"}]},注意doc以及type,name为必填项,name为参数名,doc为接口返回参数描述，type为返回参数数据类型,请务必确保填入数据格式正确' class="layui-textarea"></textarea>
          </div>
        </div>
        <div class="layui-form-item">
          <div class="layui-input-block">
            <button class="layui-btn" lay-submit lay-filter="formAdd">立即提交</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <script src="/layui/dist/layui.js" type="text/javascript" charset="utf-8"></script>
  <script type="text/javascript">
    layui.use('form', function () {
      var $ = layui.jquery;
      var form = layui.form;

      //立即提交按钮点击事件
      form.on('submit(formAdd)', function (res) {
        //AJAX请求
        $.post("/home/apiadd", res.field, function (d) {
          if (d.code != 200) {
            layer.msg(d.msg);
          } else {
            var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
            parent.layer.close(index); //再执行关闭
          }
        }, "json");

        return false;
      });
    })
  </script>
</body>

</html>