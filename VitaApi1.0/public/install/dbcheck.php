<?php
error_reporting(0);
if ($_POST['host'] != "" && $_POST['username'] != "" && $_POST['password'] != "" && $_POST['port'] != "" && $_POST['db_name'] != "") {
    $host = $_POST['host'];
    $user = $_POST['username'];
    $psw = $_POST['password'];
    $port = $_POST['port'];
    $db_name = $_POST['db_name'];

    $conn = mysqli_connect($host, $user, $psw, $db_name);
    if (!$conn) {
        $m = array("code" => 500, "msg" => "数据库链接失败，请检查填写信息是否正确，错误信息：" . mysqli_connect_error());
        exit(json_encode($m, JSON_UNESCAPED_UNICODE));
    } else {
        $databaseFile = '../../config/database.php';
        $contents = file_get_contents($databaseFile);

        // 匹配数据库主机名、数据库名、用户名和密码
        //匹配主机地址
        preg_match('/\'hostname\'\s*=>\s*env\(\'DB_HOST\',\s*\'(.*?)\'\)/', $contents, $matches);
        $dbHost = $matches[1];
        //匹配数据库名
        preg_match('/\'database\'\s*=>\s*env\(\'DB_NAME\',\s*\'(.*?)\'\)/', $contents, $matches);
        $dbName = $matches[1];
        //匹配数据库用户
        preg_match('/\'username\'\s*=>\s*env\(\'DB_USER\',\s*\'(.*?)\'\)/', $contents, $matches);
        $dbUser = $matches[1];
        //匹配数据库密码
        preg_match('/\'password\'\s*=>\s*env\(\'DB_PASS\',\s*\'(.*?)\'\)/', $contents, $matches);
        $dbPass = $matches[1];
        //匹配数据库端口
        preg_match('/\'hostport\'\s*=>\s*env\(\'DB_PORT\',\s*\'(.*?)\'\)/', $contents, $matches);
        $dbPort = $matches[1];

        // 替换数据库主机名、数据库名、用户名和密码
        $contents = str_replace($dbHost, $host, $contents); // 替换数据库主机名
        $contents = str_replace($dbName, $db_name, $contents); // 替换数据库名
        $contents = str_replace($dbUser, $user, $contents); // 替换数据库用户名
        $contents = str_replace($dbPass, $psw, $contents); // 替换数据库密码
        $contents = str_replace($dbPort, $port, $contents); // 替换数据库端口

        // 保存修改后的配置文件内容
        file_put_contents($databaseFile, $contents);
        $m = array("code" => 200, "msg" => "数据库链接成功，配置文件生成成功开始系统安装");
        exit(json_encode($m, JSON_UNESCAPED_UNICODE));
    }
}
