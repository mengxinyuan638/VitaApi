<!DOCTYPE HTML>
<html>

<head>
	<title>{$site_name}-基于VitaApi管理系统搭建</title>
	<meta charset="utf-8">
	<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="/index/assets/css/main.css">
	<link rel="stylesheet" type="text/css" href="/layui/dist/css/layui.css">
	<link rel="stylesheet" type="text/css" href="/icon/iconfont.css">
	<style>
		@font-face {
			font-family: 'iconfont';
			src: url('/icon/iconfont.woff2?t=1722089244833') format('woff2'),
				url('/icon/iconfont.woff?t=1722089244833') format('woff'),
				url('/icon/iconfont.ttf?t=1722089244833') format('truetype');
		}

		.iconfont {
			font-family: "iconfont" !important;
			font-size: 16px;
			font-style: normal;
			-webkit-font-smoothing: antialiased;
			-moz-osx-font-smoothing: grayscale;
		}
	</style>
</head>

<body>

	<!-- Header -->
	<header id="header" class="alt">
		<div class="logo"><a href="index.html">{$site_name} <span>Power by VitaApi</span></a></div>
		<a href="#menu">菜单</a>
	</header><!-- Nav -->
	<nav id="menu">
		<ul class="links" id="menu-list">
			<li><a href="index/friend">友情链接</a></li>
		</ul>
	</nav><!-- Banner -->
	<section class="banner full">
		<article><img src="{$background}" alt="" width="1440" height="961">
			<div class="inner">
				<header>
					<p>{$site_title_2}</p>
					<h2>{$site_name}</h2>
				</header>
			</div>
		</article>
	</section><!-- One -->

	<!-- 公告部分 -->
	<div class="layui-row" style="padding: 15px;background-color: #f5f5f5;" id="notice">
		<div class="layui-col-xs12 layui-col-sm12 layui-col-md12">
			<div class="layui-panel" style="padding: 25px;border-radius: 16px;">
				<div>
					<i class="iconfont icon-gonggao" style="color: red;font-size: 35px;"></i>
					<i class="iconfont icon-gonggao1" style="color: #31bdec;font-size: 35px;"></i>
				</div>
				<br>
				<div style="padding: 10px;">
					<h3>{$notice_data}</h3>
				</div>
			</div>
		</div>
	</div>
	<div class="layui-row" style="padding: 15px;background-color: #f5f5f5;" id="notice">
		<div class="layui-col-xs12 layui-col-sm12 layui-col-md12">
			<div class="layui-panel" style="padding: 25px;border-radius: 16px;">
				<div class="layui-row">
					<div class="layui-col-xs12 layui-col-sm2 layui-col-md1" style="display: flex;">
						<i class="iconfont icon-sousuo" style="color: #31bdec;font-size: 25px;"></i>
						<h3>搜索API</h3>
					</div>
					<div class="layui-col-xs9 layui-col-sm7 layui-col-md9">
						<input name="search" placeholder="请输入要搜索的api名称" class="layui-input" id="search">
					</div>
					<div class="layui-col-xs3 layui-col-sm3 layui-col-md2" id="search-btn">
						<button type="button" class="layui-btn layui-bg-blue layui-btn-fluid">搜索</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="layui-row" style="padding: 15px;background-color: #f5f5f5;" id="notice">
		<div class="layui-col-xs12 layui-col-sm12 layui-col-md12">
			<div class="layui-panel" style="padding: 25px;border-radius: 16px;">
				<div class="layui-row">
					<div class="layui-col-xs12 layui-col-sm12 layui-col-md12" style="display: flex;">
						<i class="iconfont icon-jiancejieguochaxun" style="color: #31bdec;font-size: 25px;"></i>
						<h3>搜索结果:</h3>
					</div>
					<div class="layui-col-xs12 layui-col-sm12 layui-col-md12">
						<div id="search-result">

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- api列表部分 -->
	<div class="layui-row" style="padding:15px;" id="api-list">

	</div>


	<!-- Footer -->
	<footer id="footer">
		<div class="container">
			<ul class="icons">
				<a href="#">
					<li class="layui-icon layui-icon-github" style="font-size: 30px;"></li>
				</a>
			</ul>
		</div>
	</footer>
	<div class="copyright">
		<p>站长qq:{$site_qq}</p>
		© 2024 VitaApi 萌新源版权所有
	</div>

	<!-- Scripts -->
	<script src="/index/assets/js/jquery.min.js"></script>
	<script src="/index/assets/js/jquery.scrollex.min.js"></script>
	<script src="/index/assets/js/skel.min.js"></script>
	<script src="/index/assets/js/util.js"></script>
	<script src="/index/assets/js/main.js"></script>
	<script src="/component/layui/layui.js"></script>
	<script>
		//获取jquery
		var $ = layui.jquery;
		var dropdown = layui.dropdown;


		//搜索框点击事件
		$("#search-btn").click(function() {
			var name = $("#search").val()

			if (name == '') {
				alert('输入不能为空');
			} else {
				$.post("/api/search", {
					value: name
				}, function(data) {
					if (data.code == 404) {
						$("#search-result").empty();
						$("#search-result").append("<div class='layui-col-xs12 layui-col-sm12 layui-col-md12' style='padding:10px;'><div class='layui-panel' style='border-radius: 15px;padding:60px;text-align:center;'><i class='iconfont icon-wujieguo' style='color: #31bdec;font-size: 45px;'>没有找到您想要的结果</i></div></div>");
					} else {
						var api_data = data.data;
						$("#search-result").empty();
						for (var i = 0; i < api_data.length; i++) {
							//判断api状态显示不同样式
							if (api_data[i]['api_type'] == '正常') {
								//显示正常样式
								$("#search-result").append("<a href='/api/apimsg?id=" + api_data[i]['id'] + "'><div class='layui-col-xs12 layui-col-sm4 layui-col-md3' style='padding:10px;'><div class='layui-panel hvr-grow-shadow' style='border-radius: 15px;padding:10px;'><h3>" + api_data[i]['api_name'] + "<span class='layui-badge layui-bg-green' style='float: right;'>API状态:正常</span></h3><br/><p>API简介:</p><br/><p>" + api_data[i]['api_notice'] + "</p></div></div></a>")
							} else if (api_data[i]['api_type'] == '维护') {
								//显示维护
								$("#search-result").append("<a href='/api/apimsg?id=" + api_data[i]['id'] + "'><div class='layui-col-xs12 layui-col-sm4 layui-col-md3' style='padding:10px;'><div class='layui-panel hvr-grow-shadow' style='border-radius: 15px;padding:10px;'><h3>" + api_data[i]['api_name'] + "<span class='layui-badge layui-bg-orange' style='float: right;'>API状态:维护</span></h3><br/><p>API简介:</p><br/><p>" + api_data[i]['api_notice'] + "</p></div></div></a>")
							} else {
								//显示异常
								$("#search-result").append("<a href='/api/apimsg?id=" + api_data[i]['id'] + "'><div class='layui-col-xs12 layui-col-sm4 layui-col-md3' style='padding:10px;'><div class='layui-panel hvr-grow-shadow' style='border-radius: 15px;padding:10px;'><h3>" + api_data[i]['api_name'] + "<span class='layui-badge' style='float: right;'>API状态:异常</span></h3><br/><p>API简介:</p><br/><p>" + api_data[i]['api_notice'] + "</p></div></div></a>")
							}
						}
					}
				}, 'json')
			}

		});

		$.get("/index/noticedata", function(data) {
			//修改公告信息
			var notice_data = data.data;

			if (notice_data.type == 'false') {
				$("#notice").css('display', 'none'); //隐藏公告
			}
		}, "json")

		//api列表渲染
		$.get("/api/apidata", function(data) {
			var api_data = data.data;

			for (var i = 0; i < api_data.length; i++) {
				//动态添加api块，将html代码加入ID为api-list的元素中

				//判断api状态显示不同样式
				if (api_data[i]['api_type'] == '正常') {
					//显示正常样式
					$("#api-list").append("<a href='/api/apimsg?id=" + api_data[i]['id'] + "'><div class='layui-col-xs12 layui-col-sm4 layui-col-md3' style='padding:10px;'><div class='layui-panel hvr-grow-shadow' style='border-radius: 15px;padding:10px;'><h3>" + api_data[i]['api_name'] + "<span class='layui-badge layui-bg-green' style='float: right;'>API状态:正常</span><br><span class='layui-icon layui-icon-tips' style='float: right;font-size:15px;'>调用总数:" + api_data[i]['api_use_num'] + "</span></h3><br/><p>API简介:</p><br/><p>" + api_data[i]['api_notice'] + "</p></div></div></a>")
				} else if (api_data[i]['api_type'] == '维护') {
					//显示维护
					$("#api-list").append("<a href='/api/apimsg?id=" + api_data[i]['id'] + "'><div class='layui-col-xs12 layui-col-sm4 layui-col-md3' style='padding:10px;'><div class='layui-panel hvr-grow-shadow' style='border-radius: 15px;padding:10px;'><h3>" + api_data[i]['api_name'] + "<span class='layui-badge layui-bg-orange' style='float: right;'>API状态:维护</span><br><span class='layui-icon layui-icon-tips' style='float: right;font-size:15px;'>调用总数:" + api_data[i]['api_use_num'] + "</span></h3><br/><p>API简介:</p><br/><p>" + api_data[i]['api_notice'] + "</p></div></div></a>")
				} else {
					//显示异常
					$("#api-list").append("<a href='/api/apimsg?id=" + api_data[i]['id'] + "'><div class='layui-col-xs12 layui-col-sm4 layui-col-md3' style='padding:10px;'><div class='layui-panel hvr-grow-shadow' style='border-radius: 15px;padding:10px;'><h3>" + api_data[i]['api_name'] + "<span class='layui-badge' style='float: right;'>API状态:异常</span><br><span class='layui-icon layui-icon-tips' style='float: right;font-size:15px;'>调用总数:" + api_data[i]['api_use_num'] + "</span></h3><br/><p>API简介:</p><br/><p>" + api_data[i]['api_notice'] + "</p></div></div></a>")
				}
			}
		}, "json")

		//菜单相关代码
		$.get("/index/menudata", function(data) {
			var menu_data = data.data;

			for (var i = 0; i < menu_data.length; i++) {
				//动态添加菜单块，将html代码加入ID为menu-list的元素中

				$("#menu-list").append("<li><a href='" + menu_data[i]['menu_url'] + "'>" + menu_data[i]['menu_name'] + "</a></li>")
			}
		}, "json")
	</script>
</body>

</html>