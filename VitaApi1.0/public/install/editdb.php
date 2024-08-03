<?php
error_reporting(0);
if ($_POST['host'] != "" && $_POST['username'] != "" && $_POST['password'] != "" && $_POST['port'] != "" && $_POST['db_name'] != "") {
    $host = $_POST['host'];
    $user = $_POST['username'];
    $psw = $_POST['password'];
    $port = $_POST['port'];
    $db_name = $_POST['db_name'];

    // 读取SQL文件内容
    $sql = file_get_contents("./data.sql");
    //创建数据库链接
    $conn = mysqli_connect($host, $user, $psw, $db_name);

    // 执行SQL语句
    if ($conn->multi_query($sql)) {
        $m = array("code" => 200, "msg" => "数据库表格创建成功");
    } else {
        $m = array("code" => 200, "msg" => "Error: " . $sql . "<br>" . $conn->error);
    }

    // 关闭连接
    $conn->close();
    exit(json_encode($m, JSON_UNESCAPED_UNICODE));
}
