<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, maximum-scale=1"
    />
    <title>登录</title>
    <link rel="icon" href="/favicon.jpg">
    <link rel="stylesheet" href="/component/pear/css/pear.css" />
    <link rel="stylesheet" href="/admin/css/other/login.css" />
    <link rel="stylesheet" href="/admin/css/variables.css" />
    <script>
      if (window.self != window.top) {
        top.location.reload();
      }
    </script>
  </head>

  <body>
    <div
      class="login-page"
      style="background-image: url(/admin/images/background.svg)"
    >
      <div class="layui-row">
        <div class="layui-col-sm6 login-bg layui-hide-xs">
          <img class="login-bg-img" src="/admin/images/login.png" alt="" />
        </div>
        <div class="layui-col-sm6 layui-col-xs12 login-form">
          <div class="layui-form">
            <div class="form-center">
              <div class="form-center-box">
                <div class="top-log-title">
                  <img class="top-log" src="/favicon.jpg" alt="VitaApi" />
                  <span>VitaApi管理系统</span>
                </div>
                <div class="top-desc">
                  一个高中生在两年前种下的种子正在悄悄发芽。<br/>Powered by 萌新源
                </div>
                <div style="margin-top: 30px">
                  <div class="layui-form-item">
                    <div class="layui-input-wrap">
                      <div class="layui-input-prefix">
                        <i class="layui-icon layui-icon-username"></i>
                      </div>
                      <input
                        name="UserName"
                        lay-verify="required"
                        placeholder="账户"
                        autocomplete="off"
                        class="layui-input"
                      />
                    </div>
                  </div>
                  <div class="layui-form-item">
                    <div class="layui-input-wrap">
                      <div class="layui-input-prefix">
                        <i class="layui-icon layui-icon-password"></i>
                      </div>
                      <input
                        type="password"
                        name="confirmPassword"
                        value=""
                        lay-verify="required|confirmPassword"
                        placeholder="密码"
                        autocomplete="off"
                        class="layui-input"
                        lay-affix="eye"
                      />
                    </div>
                  </div>
                  <div class="tab-log-verification">
                    <div class="verification-text">
                      <div class="layui-input-wrap">
                        <div class="layui-input-prefix">
                          <i class="layui-icon layui-icon-auz"></i>
                        </div>
                        <input
                          name="Code"
                          lay-verify="required"
                          value=""
                          placeholder="验证码"
                          autocomplete="off"
                          class="layui-input"
                        />
                      </div>
                    </div>
                    <img
                      src="{:captcha_src()}"
                      alt=""
                      class="verification-img"
                      onclick="ReloadImg()"
                      id="CaptChaImg"
                    />
                  </div>
                  <div class="layui-form-item">
                    <div class="remember-passsword">
                      <div class="remember-cehcked">
                        <input
                          type="checkbox"
                          name="like1[write]"
                          lay-skin="primary"
                          title="自动登录"
                        />
                      </div>
                    </div>
                  </div>
                  <div class="login-btn">
                    <button
                      type="button"
                      lay-submit
                      lay-filter="login"
                      class="layui-btn login"
                    >
                      登 录
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- 资 源 引 入 -->
    <script src="/component/layui/layui.js"></script>
    <script src="/component/pear/pear.js"></script>
    <script>
      layui.use(["form", "button", "popup"], function () {
        var form = layui.form;
        var button = layui.button;
        var popup = layui.popup;

        //获取jquery
        $ = layui.jquery;

        //获取layer组件用于弹窗，提示
        var layer = layui.layer;

        // 登 录 提 交
        form.on("submit(login)", function (data) {
          $ReturnCode = 1; //定义全局变量用于验证登录状态

          /// 验证
          $.post(
            "/Mxyadmin/login",
            data.field,
            function (response) {
              $ReturnCode = response.code;
            },
            "json"
          );

          /// 登录

          // 动画
          button.load({
            elem: ".login",
            time: 1500,
            done: function () {
              //根据接口返回数据进行验证0为登录成功，1或其他状态码为登录失败
              if ($ReturnCode == '0') {
                popup.success("登录成功", function () {
                  location.href = "/home";
                });
              }else if($ReturnCode == '2'){
                layer.alert("验证码错误，请修改后重试", {
                  icon: 2,
                });
                ReloadImg(); //验证失败,刷新验证码
              }else{
                layer.alert("用户名或密码错误，请修改后重试", {
                  icon: 2,
                });
                ReloadImg(); //验证失败,刷新验证码
              }
            },
          });

          return false;
        });
      });

      // 重新加载验证码的方法
      function ReloadImg() {
        $("#CaptChaImg").attr("src", "{:captcha_src()}?rand=" + Math.random());
      }
    </script>
  </body>
</html>
