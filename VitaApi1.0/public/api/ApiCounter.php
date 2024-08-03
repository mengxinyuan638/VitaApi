<?php
// ApiCounter.php
// 该文件封装了用于统计api调用次数等方法


class ApiCounter
{
    public function increment($id)
    {
        //向控制器发送post请求,$id为要增加次数的api id

        // 初始化cURL会话
        $count = curl_init();
        // 设置cURL选项
        curl_setopt($count, CURLOPT_URL,$_SERVER['HTTP_HOST']."/api/count"); // 目标URL
        curl_setopt($count, CURLOPT_POST, 1); // 设置为POST请求
        curl_setopt($count, CURLOPT_POSTFIELDS, "id=".$id); // 请在这里填写api的id注意不要填错
        curl_setopt($count, CURLOPT_RETURNTRANSFER, true); // 将响应结果作为字符串返回，而不是直接输出
        // 执行cURL会话
        $response = curl_exec($count);
        // 关闭cURL会话
        curl_close($count);
    }
}
