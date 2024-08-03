<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>API信息</title>
  </head>
  <body>
    <div class="layui-container">
      <table class="layui-hide" id="ID-api-data" lay-filter="apidata"></table>
      <button
        id="add-api"
        type="button"
        class="layui-btn layui-btn-fluid layui-btn-lg layui-btn-normal"
      >
        添加API信息
      </button>
    </div>

    <script>
      function setpage() {
        //该方法是为了调整api编辑页面大小以适配移动端
        var width = window.innerWidth;
        if (width > 600) {
          return ["50%", "90%"];
        } else {
          return ["90%", "90%"];
        }
      }
      layui.use("table", function () {
        var table = layui.table;
        var $ = layui.jquery;
        var form = layui.form;

        //操作列事件
        table.on("tool(apidata)", function (obj) {
          if (obj.event == "del") {
            //删除api操作
            layer.confirm(
              //弹窗确认是否进行删除操作
              "是否删除？",
              {
                icon: 3,
                title: "重要提示",
              },
              function (index) {
                //点击确定后发送AJAX请求
                $.getJSON(
                  "/home/delapi",
                  {
                    id: obj.data.id, //发送要删除的api的ID
                  },
                  function (response) {
                    if (response.code != 200) {
                      layer.msg(response.msg);
                    } else {
                      obj.del(); //删除当前行DOM
                      layer.close(index); //关闭弹出层
                      layer.msg(response.msg);
                      table.reload("ID-api-data", {
                        scrollPos: "fixed", // 保持滚动条位置不变,重载表格数据
                        where: {
                          nowTime: new Date().getTime(),
                        },
                      });
                    }
                  }
                );
              }
            );
          } else if (obj.event == "edit") {
            //编辑
            console.log("编辑");
            layer.open({
              type: 2,
              title: "修改API信息",
              content: "/home/editapi",
              area: setpage(),
              end: function () {
                //表格数据刷新
                table.reload("ID-api-data", {
                  where: {
                    nowTime: new Date().getTime(),
                  },
                });
              },
              success: function (layero, index) {
                //修改成功后将editapi页面回显数据

                var body = layer.getChildFrame("body", index); //获取editapi对象
                body.find("#api-name").val(obj.data.api_name); //回显名称
                body.find("#api-notice").val(obj.data.api_notice); //回显简介
                body.find("#api-link").val(obj.data.api_link); //回显地址
                body.find("#api-example").val(obj.data.api_example); //回显请求示例
                body.find("#api-return").val(obj.data.api_return); //回显接口返回数据
                body.find("#api-par").val(obj.data.api_par); //回显接口参数数据
                body.find("#api-par-return").val(obj.data.api_par_return); //回显接口返回参数数据
                body.find("#api-type").val(obj.data.api_type); //回显接口状态
                form.render(body.find("#api-type"));//刷新一下选择框让数据成功回显
                body.find("#api-way").val(obj.data.api_way); //回显请求方式
                form.render(body.find("#api-way"));//刷新一下选择框让数据成功回显
                body.find("#api-format").val(obj.data.api_format); //回显接口返回数据格式
                form.render(body.find("#api-format"));//刷新一下选择框让数据成功回显
                body.find("input[name='id']").attr({
                  //设置api ID方便后续对接接口
                  value: obj.data.id,
                });
              },
            });
          }
        });

        // 已知数据渲染
        var inst = table.render({
          elem: "#ID-api-data",
          page: true, //开启分页
          url: "/home/apidata/?nowTime=" + new Date().getTime(), //api信息请求接口
          limit: 10, //每页显示条数
          cols: [
            [
              {
                field: "id",
                title: "ID",
                width: 10,
                sort: true,
                fixed: "left",
              },
              {
                field: "api_name",
                width: 200,
                title: "API接口名称",
              },
              {
                field: "api_notice",
                width: 200,
                title: "API简介",
              },
              {
                field: "api_link",
                width: 200,
                title: "API地址",
              },
              {
                field: "api_example",
                width: 200,
                title: "请求示例",
              },
              {
                field: "api_type",
                width: 100,
                title: "接口状态",
              },
              {
                field: "api_way",
                width: 100,
                title: "请求方式",
              },
              {
                field: "api_format",
                width: 100,
                title: "返回格式",
              },
              {
                field: "api_return",
                width: 300,
                title: "api返回数据",
              },
              {
                field: "api_par",
                width: 300,
                title: "接口参数",
              },
              {
                field: "api_par_return",
                width: 300,
                title: "接口返回参数",
              },
              {
                title: "操作",
                width: 150,
                align: "center",
                templet: function () {
                  var str =
                    '<button type="button" class="layui-btn layui-btn-xs layui-btn-danger" lay-event=\'del\'>删除</button>';
                  str +=
                    '<button type="button" class="layui-btn layui-btn-xs layui-btn-normal" lay-event=\'edit\'>修改</button>';
                  return str;
                },
              },
            ],
          ],
        });

        //给添加API按钮绑定事件
        $("#add-api").click(function () {
          //点击添加按钮时弹出一个表单弹出层
          layer.open({
            type: 2,
            title: "添加API信息",
            content: "home/addapi",
            area: setpage(),
            end: function () {
              //表格数据刷新
              table.reload("ID-api-data", {
                where: {
                  nowTime: new Date().getTime(),
                },
              });
            },
          });
        });
      });
    </script>
  </body>
</html>
