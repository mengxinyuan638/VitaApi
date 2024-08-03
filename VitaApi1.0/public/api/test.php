<?php
//引入部分
include './ApiCounter.php';
$apicounter = new ApiCounter();
$apicounter -> increment('1');

//你的api代码部分
echo '你好';
?>