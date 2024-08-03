<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>分析页</title>
    <meta name="renderer" content="webkit" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, maximum-scale=1"
    />
    <link rel="icon" href="/favicon.jpg">
    <link rel="stylesheet" href="../../admin/css/other/analysis.css" />
  </head>

  <body>
    <div class="pear-container">
      <div class="layui-row layui-col-space10">
        <div class="layui-col-xs6 layui-col-md3">
          <div class="layui-card top-panel">
            <div class="layui-card-header">累计访问</div>
            <div class="layui-card-body">
              <div class="layui-row layui-col-space5">
                <div
                  class="layui-col-xs8 layui-col-md8 top-panel-number"
                  style="color: #28333e"
                  id="value1"
                >
                  0
                </div>
                <div class="layui-col-xs4 layui-col-md4 top-panel-tips">
                  <svg
                    t="1688201011061"
                    class="icon"
                    viewBox="0 0 1024 1024"
                    version="1.1"
                    xmlns="http://www.w3.org/2000/svg"
                    p-id="1411"
                    width="200"
                    height="200"
                  >
                    <path
                      d="M716.8 0H307.2C137.5488 0 0 137.5488 0 307.2v409.6c0 169.6512 137.5488 307.2 307.2 307.2h409.6c169.6512 0 307.2-137.5488 307.2-307.2V307.2c0-169.6512-137.5488-307.2-307.2-307.2z"
                      fill="#D8F4EE"
                      p-id="1412"
                    ></path>
                    <path
                      d="M691.8656 639.1296a257.4592 257.4592 0 0 1-52.736 52.736l60.928 60.928a37.2992 37.2992 0 0 0 52.736-52.736l-60.928-60.928z"
                      fill="#75E8CD"
                      p-id="1413"
                    ></path>
                    <path
                      d="M486.4 716.8a230.4 230.4 0 1 0 0-460.8 230.4 230.4 0 0 0 0 460.8z m130.9696-302.5152a16.64 16.64 0 0 1 0.3584 23.5008l-115.84 119.296a16.5376 16.5376 0 0 1-3.84 3.3792 16.64 16.64 0 0 1-22.144-3.5072l-67.328-60.5184-47.232 48.64a16.64 16.64 0 0 1-23.8336-23.168l56.32-57.984a16.6912 16.6912 0 0 1 24.8832-3.072l69.5552 62.5152 105.6-108.7232a16.6144 16.6144 0 0 1 23.5008-0.3584z"
                      fill="#01C3A3"
                      p-id="1414"
                    ></path>
                    <path
                      d="M341.257236 436.535528m-7.948259-21.87091l0 0q-7.948258-21.87091-29.819168-13.922652l0 0q-21.87091 7.948258-13.922652 29.819169l0 0q7.948258 21.87091 29.819168 13.922651l0 0q21.87091-7.948258 13.922652-29.819168Z"
                      fill="#FFFFFF"
                      p-id="1415"
                    ></path>
                    <path
                      d="M331.4432 370.7392a17.2544 17.2544 0 0 0 29.3888-3.584l5.9648-13.5168a26.112 26.112 0 0 1 14.9504-13.9264l30.1056-10.9312a15.2576 15.2576 0 0 0 8.8832-20.224 15.0272 15.0272 0 0 0-18.4576-8.6016c-47.7696 15.4368-67.0976 29.3888-73.9584 57.5232a15.6672 15.6672 0 0 0 3.1488 13.2608z"
                      fill="#FFFFFF"
                      p-id="1416"
                    ></path>
                  </svg>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="layui-col-xs6 layui-col-md3">
          <div class="layui-card top-panel">
            <div class="layui-card-header">今日访问</div>
            <div class="layui-card-body">
              <div class="layui-row layui-col-space5">
                <div
                  class="layui-col-xs8 layui-col-md8 top-panel-number"
                  style="color: #28333e"
                  id="value2"
                >
                  0
                </div>
                <div class="layui-col-xs4 layui-col-md4 top-panel-tips">
                  <svg
                    t="1688201051691"
                    class="icon"
                    viewBox="0 0 1024 1024"
                    version="1.1"
                    xmlns="http://www.w3.org/2000/svg"
                    p-id="1560"
                    width="200"
                    height="200"
                  >
                    <path
                      d="M716.8 0H307.2C137.5488 0 0 137.5488 0 307.2v409.6c0 169.6512 137.5488 307.2 307.2 307.2h409.6c169.6512 0 307.2-137.5488 307.2-307.2V307.2c0-169.6512-137.5488-307.2-307.2-307.2z"
                      fill="#D8F4EE"
                      p-id="1561"
                    ></path>
                    <path
                      d="M257.92 354.304a12.8 12.8 0 0 1 12.8-12.8h51.2a12.8 12.8 0 1 1 0 25.6h-51.2a12.8 12.8 0 0 1-12.8-12.8zM258.048 485.6832a12.8 12.8 0 0 1 12.8512-12.7488l51.2 0.1536a12.8 12.8 0 1 1-0.0768 25.6l-51.2-0.1536a12.8 12.8 0 0 1-12.7488-12.8512zM257.8432 613.5808c0-7.296 5.76-13.184 12.8-13.184l51.2 0.1024c7.0912 0 12.8 5.9392 12.8 13.2096a13.0048 13.0048 0 0 1-12.8256 13.1584l-51.2-0.1024a13.0048 13.0048 0 0 1-12.8-13.184z"
                      fill="#75E8CD"
                      p-id="1562"
                    ></path>
                    <path
                      d="M281.6 307.2a51.2 51.2 0 0 1 51.2-51.2h307.2a51.2 51.2 0 0 1 51.2 51.2 51.2 51.2 0 0 1 51.2 51.2v358.4a51.2 51.2 0 0 1-51.2 51.2H332.8a51.2 51.2 0 0 1-51.2-51.2v-76.8h51.2a25.6 25.6 0 0 0 0-51.2h-51.2v-76.8h51.2a25.6 25.6 0 0 0 0-51.2h-51.2v-76.8h51.2a25.6 25.6 0 0 0 0-51.2h-51.2v-25.6z m51.2 409.6c-9.3184 0-18.0736-2.4832-25.6-6.8352V716.8a25.6 25.6 0 0 0 25.6 25.6h358.4a25.6 25.6 0 0 0 25.6-25.6V358.4a25.6 25.6 0 0 0-25.6-25.6v332.8a51.2 51.2 0 0 1-51.2 51.2H332.8z"
                      fill="#01C3A3"
                      p-id="1563"
                    ></path>
                    <path
                      d="M358.4 293.2224c0-6.4 5.1968-11.6224 11.6224-11.6224h209.4592a11.648 11.648 0 0 1 0 23.296h-209.4592a11.648 11.648 0 0 1-11.6224-11.6736zM614.4 293.2224a11.648 11.648 0 0 1 23.2704 0 11.648 11.648 0 0 1-23.2704 0z"
                      fill="#FFFFFF"
                      p-id="1564"
                    ></path>
                    <path
                      d="M426.7264 401.9712a13.568 13.568 0 0 1 5.8368-17.9456l26.624-13.952a12.8512 12.8512 0 0 1 17.5616 5.7088l18.0224 36.3264-50.3552 25.5488-17.6896-35.6864z m23.552 47.5136l84.7872 170.8544-5.0432 2.6624c-3.8144 1.9968-4.1984 7.296-0.6656 9.5232l55.3472 35.2256c3.5072 2.2272 8.2688-0.256 8.576-4.5056l4.7616-66.7136a5.3248 5.3248 0 0 0-7.9104-5.0432l-5.0176 2.6624-84.48-170.24-50.3552 25.5744z"
                      fill="#75E8CD"
                      p-id="1565"
                    ></path>
                  </svg>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="layui-col-xs6 layui-col-md3">
          <div class="layui-card top-panel">
            <div class="layui-card-header">API数量</div>
            <div class="layui-card-body">
              <div class="layui-row layui-col-space5">
                <div
                  class="layui-col-xs8 layui-col-md8 top-panel-number"
                  style="color: #28333e"
                  id="value3"
                >
                  0
                </div>
                <div class="layui-col-xs4 layui-col-md4 top-panel-tips">
                  <svg
                    t="1688201066494"
                    class="icon"
                    viewBox="0 0 1024 1024"
                    version="1.1"
                    xmlns="http://www.w3.org/2000/svg"
                    p-id="1709"
                    width="200"
                    height="200"
                  >
                    <path
                      d="M716.8 0H307.2C137.5488 0 0 137.5488 0 307.2v409.6c0 169.6512 137.5488 307.2 307.2 307.2h409.6c169.6512 0 307.2-137.5488 307.2-307.2V307.2c0-169.6512-137.5488-307.2-307.2-307.2z"
                      fill="#D8F4EE"
                      p-id="1710"
                    ></path>
                    <path
                      d="M349.056 373.2992L461.1072 512l-112.0512 138.7008C311.9872 696.6272 342.4 768 399.0528 768h225.8944c56.6528 0 87.0656-71.3728 49.9968-117.2992L562.8928 512l112.0512-138.7008c37.0688-45.9008 6.656-117.2992-49.9968-117.2992h-225.8944c-56.6528 0-87.0656 71.3984-49.9968 117.2992z m134.2464 123.904l-67.7376-84.4288c-22.2208-27.7248 22.5024-38.9632 54.7328-17.6896 29.1328 19.2 53.5808 18.1504 62.2336 17.7664l2.2272-0.0768c1.1264 0 5.7088-1.1008 12.1344-2.6368 25.9072-6.1952 81.8944-19.584 64.0768 2.6368l-67.7376 84.4544c-15.7952 19.712-44.1344 19.712-59.9296 0z"
                      fill="#01C99A"
                      p-id="1711"
                    ></path>
                    <path
                      d="M256 294.4a38.4 38.4 0 0 1 38.4-38.4h435.2a38.4 38.4 0 0 1 0 76.8h-435.2a38.4 38.4 0 0 1-38.4-38.4zM768 729.6a38.4 38.4 0 0 1-38.4 38.4h-435.2a38.4 38.4 0 0 1 0-76.8h435.2a38.4 38.4 0 0 1 38.4 38.4z"
                      fill="#75E8CD"
                      p-id="1712"
                    ></path>
                    <path
                      d="M402.7392 614.9632m7.7068-10.219845l42.926877-56.924536q7.7068-10.219845 17.926645-2.513045l0 0q10.219845 7.7068 2.513045 17.926645l-42.926877 56.924536q-7.7068 10.219845-17.926645 2.513045l0 0q-10.219845-7.7068-2.513045-17.926645Z"
                      fill="#FFFFFF"
                      p-id="1713"
                    ></path>
                    <path
                      d="M419.824586 634.79804m-7.7068 10.219845l0 0q-7.7068 10.219845-17.926645 2.513044l0 0q-10.219845-7.7068-2.513045-17.926645l0 0q7.7068-10.219845 17.926645-2.513044l0 0q10.219845 7.7068 2.513045 17.926645Z"
                      fill="#FFFFFF"
                      p-id="1714"
                    ></path>
                  </svg>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="layui-col-xs6 layui-col-md3">
          <div class="layui-card top-panel">
            <div class="layui-card-header">等待开发</div>
            <div class="layui-card-body">
              <div class="layui-row layui-col-space5">
                <div
                  class="layui-col-xs8 layui-col-md8 top-panel-number"
                  style="color: #28333e"
                  id="value4"
                >
                  0
                </div>
                <div class="layui-col-xs4 layui-col-md4 top-panel-tips">
                  <svg
                    t="1688201079590"
                    class="icon"
                    viewBox="0 0 1024 1024"
                    version="1.1"
                    xmlns="http://www.w3.org/2000/svg"
                    p-id="1858"
                    width="200"
                    height="200"
                  >
                    <path
                      d="M716.8 0H307.2C137.5488 0 0 137.5488 0 307.2v409.6c0 169.6512 137.5488 307.2 307.2 307.2h409.6c169.6512 0 307.2-137.5488 307.2-307.2V307.2c0-169.6512-137.5488-307.2-307.2-307.2z"
                      fill="#D8F4EE"
                      p-id="1859"
                    ></path>
                    <path
                      d="M327.936 280.3712a24.3712 24.3712 0 0 1 48.7424 0v48.768a24.3712 24.3712 0 1 1-48.768 0v-48.768z m195.0464 0h-121.9072v73.1392a24.3712 24.3712 0 0 1-24.3968 24.3968H327.936a24.3712 24.3712 0 0 1-24.3712-24.3968v-73.1392h-24.3712A48.768 48.768 0 0 0 230.4 329.1392v390.0928C230.4 746.1632 252.2368 768 279.168 768H644.864c3.0208 0 5.9904-0.256 8.8832-0.8192a146.304 146.304 0 1 1 39.8592-289.7408v-148.3008a48.768 48.768 0 0 0-48.7424-48.768h-24.3968v73.1392a24.3712 24.3712 0 0 1-24.3712 24.3968H547.328a24.3712 24.3712 0 0 1-24.3712-24.3968v-73.1392zM571.7248 256a24.3712 24.3712 0 0 0-24.3712 24.3712v48.768a24.3712 24.3712 0 0 0 48.768 0v-48.768a24.3712 24.3712 0 0 0-24.3968-24.3712z m-292.5568 182.8608c0-6.7328 5.4528-12.1856 12.1856-12.1856h316.928a12.1856 12.1856 0 1 1 0 24.3712h-316.928a12.1856 12.1856 0 0 1-12.1856-12.1856z m12.1856 109.7216a12.1856 12.1856 0 1 1 0-24.3968h170.6752a12.1856 12.1856 0 1 1 0 24.3968H291.328z m-12.1856 85.3248c0-6.7328 5.4528-12.1856 12.1856-12.1856h170.6752a12.1856 12.1856 0 1 1 0 24.3712H291.328a12.1856 12.1856 0 0 1-12.1856-12.1856z"
                      fill="#01C3A3"
                      p-id="1860"
                    ></path>
                    <path
                      d="M675.968 742.4a115.2 115.2 0 1 0 0-230.4 115.2 115.2 0 0 0 0 230.4z m25.7024-101.8112l30.208 30.2336a8.704 8.704 0 0 1-12.288 12.3136l-30.2336-30.2336a52.224 52.224 0 1 1 12.3136-12.288z m-7.7568-30.2848a34.816 34.816 0 1 1-69.6576 0 34.816 34.816 0 0 1 69.632 0z"
                      fill="#75E8CD"
                      p-id="1861"
                    ></path>
                    <path
                      d="M637.568 627.2a12.8 12.8 0 0 1 25.6 0 12.8 12.8 0 1 1-25.6 0z"
                      fill="#FFFFFF"
                      p-id="1862"
                    ></path>
                  </svg>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="layui-row layui-col-space10">
        <div class="layui-col-md12">
          <div class="layui-card">
            <div class="layui-card-body">
              <div class="layui-row">
                <div class="layui-col layui-col-md9">
                  <div id="echarts-records" style="height: 400px"></div>
                </div>
                <div class="layui-col layui-col-md3">
                  <div style="padding: 40px 0px 0px 50px">
                    <div class="layui-col-md9">
                      <div class="layui-card">
                        <div class="layui-card-header">用户登录日志</div>
                        <div class="layui-card-body">
                          <p>用户ID: {$userid}</p>
                          <br/>
                          <p>用户名称: <br/> {$username}</p>
                          <br/>
                          <p>最后登录时间: <br/> {$logintime}</p>
                          <br/>
                          <p>最后登录IP: <br/> {$loginip}</p>
                          <br/>
                          <p>累计登录次数: <br/> {$loginnum}</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="layui-col-md9">
          <div class="layui-card">
            <div class="layui-card-header"><p style="font-size:20px">用户操作日志</p></div>
            <div class="layui-card-body">
              <dl class="dynamic-status" id="event-list">
              </dl>
            </div>
          </div>
        </div>
        <div class="layui-col layui-col-md3">
          <div class="layui-card">
            <div
              class="layui-card-body"
              style="
                flex-direction: column;
                height: 160px;
                display: flex;
                align-items: center;
                justify-content: center;
              "
            >
              <div>
                <img src="/admin/images/logo.png" alt="VitaApi" width="75px" height="75px">
              </div>
              <br/>
              <div><p style="color: rgb(21, 186, 169);font-size:35px;">Hello Vita</p></div>
            </div>
          </div>
          <div class="layui-card">
            <div class="layui-card-header"><span style="color: red">萌新源</span>想说的:</div>
            <div class="layui-card-body" style="line-height: 40px">
              这是为了完成我两年前心愿而写的一个项目,两年前一个高中生写下了他人生中第一个web项目并取名为"<span style="color: red">萌新源api管理系统</span>"。
              一开始我也是想着做个项目练练手后来我爱上了这种感觉,虽然当时写这个项目的过程当中遇到了很多困难,但是借助互联网我都一一解决。如今我打算再做一次尝试,于
              是开启了我的新的项目,我给它取名为"<span style="color: rgb(21, 186, 169)">VitaApi管理系统</span>","<span style="color: rgb(21, 186, 169)">
              Vita</span>"取自拉丁语,意为“生命”,象征着这个系统为API管理注入了活力和生命力。我希望我的这个新项目能够给大家带来便利,希望大家能够喜欢它。至于为什么
              我会做这样一个系统,没别的就因为热爱！
            </div>
          </div>
        </div>
      </div>
    </div>
    <script>
      //获取jquery
      var $ = layui.jquery;

      $.get("/home/eventdata", function(data) {
        var event_data = data.data;

        for(var i = event_data.length - 1;i > -1;i--){
          //动态添加用户操作日志，将html代码加入ID为event-list的元素中
          $("#event-list").append("<dd><div class='dynamic-status-img'><a href='javascript:;'><img style='width: 32px; height: 32px; border-radius: 50px' src='../../admin/images/logo.png'/></a></div><div><p>用户<a style='color: var(--global-primary-color)'>"+event_data[i]['user_name']+"</a>进行了<a style='color: var(--global-primary-color)'>"+event_data[i]['event']+"</a>的操作</p><span>"+event_data[i]['event_time']+"&emsp;&emsp;ip:"+event_data[i]['event_ip']+"</span></div></dd>")
        }
      }, "json")

      layui.use(["layer", "echarts", "element", "count"], function () {
        var $ = layui.jquery,
          layer = layui.layer,
          element = layui.element,
          count = layui.count,
          echarts = layui.echarts;

        count.up("value1", {
          time: 3000,
          num: {$visitor_num_total},
          bit: 2,
          regulator: 50,
        });

        count.up("value2", {
          time: 3000,
          num: {$visitor_num_now},
          bit: 2,
          regulator: 50,
        });

        count.up("value3", {
          time: 3000,
          num: {$api_data_num},
          bit: 2,
          regulator: 50,
        });

        count.up("value4", {
          time: 3000,
          bit: 2,
          num: 0,
          regulator: 50,
        });

        var echartsRecords = echarts.init(
          document.getElementById("echarts-records"),
          "walden"
        );

        const colorList = [
          "#9E87FF",
          "#73DDFF",
          "#fe9a8b",
          "#F56948",
          "#9E87FF",
        ];
        var option = {
          title: {
            text: '{$data_time_year}年各月份流量统计', // 主标题文本
            left: 'center', // 标题水平位置
            textStyle: { // 主标题样式
              color: 'red'
            }
          },
          xAxis: {
            type: "category",
            data: [
              "1月",
              "2月",
              "3月",
              "4月",
              "5月",
              "6月",
              "7月",
              "8月",
              "9月",
              "10月",
              "11月",
              "12月",
            ],
            splitLine: false,
          },
          yAxis: {
            type: "value",
            splitLine: false,
          },
          grid: {
            x: "50px",
            y: "50px",
            x2: "50px",
            y2: "50px",
          },
          series: [
            {
              data: [{$visitor_num_month}],
              type: "bar",
              label:{
                show: true,
                position: 'top'
              },
              showBackground: true,
              backgroundStyle: {
                color: "rgba(180, 180, 180, 0.2)",
              },
              itemStyle: {
                normal: {
                  color: "#16baaa",
                },
              },
            },
          ],
        };
        echartsRecords.setOption(option);

        setInterval(() => {
          echartsRecords.resize();
        }, 500);

        window.onresize = function () {
          echartsRecords.resize();
        };
      });
    </script>
  </body>
</html>
