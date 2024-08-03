<?php

$host = $_POST['db']['host'];
$user = $_POST['db']['username'];
$psw = $_POST['db']['password'];
$port = $_POST['db']['port'];
$db_name = $_POST['db']['db_name'];
$backname = $_POST['username'];
$backpassword = $_POST['password'];

$backpassword = md5($backpassword); #加密一下密码
$conn = mysqli_connect($host, $user, $psw, $db_name);
$sql = "INSERT INTO admin_user (uid, username,password,login_time_last,login_num,login_ip_last) VALUES (1, '{$backname}', '{$backpassword}', 0, 0, '0');";
if (mysqli_query($conn, $sql)) {
    $lockfile = "../install.lock";
    $fp2 = fopen($lockfile, 'w');
    fwrite($fp2, '安装效验文件');
    fclose($fp2);
    $m = array("code" => 200, "msg" => "用户创建成功");
    exit(json_encode($m, JSON_UNESCAPED_UNICODE));
} else {
    $m = array("code" => 500, "msg" => "创建用户错误:" . mysqli_error($conn));
    exit(json_encode($m, JSON_UNESCAPED_UNICODE));
}
