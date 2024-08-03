<p align="center">
<img  src="./img/logo.png" width="90px" height="90px">
</p>
<h1 align="center">VitaApi管理系统</h1>
<p align="center">
  <img src="https://img.shields.io/badge/PHP-8.0+-blue" alt="PHP"/>
  <img src="https://img.shields.io/badge/jquery-orange" alt="jquery"/>
  <img src="https://img.shields.io/badge/Layui-green" alt="Layui"/>
  <img src="https://img.shields.io/badge/ThinkPHP-6.1-green"/>
  <img src="https://img.shields.io/badge/Version-v1.0.0-blue" alt="version"/>
  <img src="https://img.shields.io/badge/萌新源API管理系统-续作-green"/>
</p>
<hr>



## 介绍
前端基于layui以及pear-Admin-layui
后端基于国产ThinkPHP框架
开发的API管理后台

## 版本要求
PHP8.0及以上版本
Mysql数据库

目前仅支持mysql

## 安装教程

前往[CSDN](https://blog.csdn.net/m0_66648798/article/details/140888896)阅读

## 更新日志

2024.8.3 v1.0.0

- VitaApi第一版



## 功能简介

1. ### api调用功能统计

​	要使用api统计功能需要在api源码头部引入我封装的文件 `ApiCounter.php` ,具体代码如下

​	其中increment函数内填入本api对应的id

```php
<?php
//引入部分
include './ApiCounter.php';
$apicounter = new ApiCounter();
$apicounter -> increment('1');

//你的api代码部分
echo '你好';
?>
```



## 参与贡献

欢迎各位提交issue还有pr

加入我的qq群：934541995反馈问题或参与讨论
