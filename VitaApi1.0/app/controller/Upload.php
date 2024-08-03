<?php

namespace app\controller;

use think\facade\Db;

//用于控制系统各项文件上传功能

class Upload extends Base
{
    public function background()
    {
        //首页背景
        $file = $_FILES['file']; // 获取上传的文件
        $name_back = "./user_data/uploads/back/" . $_FILES["file"]["name"]; //拼接文件路径方便存储还有判断是否存在同名文件
        $uploadDir = './user_data/uploads/back/'; //规定存放背景图片目录
        if (!file_exists($uploadDir)) {
            //当存放背景的目录不存在时就创建目录
            mkdir($uploadDir, 0777, true);
        }
        if ($file == null) {
            exit(json_encode(array('code' => 1, 'msg' => '未上传图片'), JSON_UNESCAPED_UNICODE));
        }
        // 获取文件后缀
        $temp = explode(".", $_FILES["file"]["name"]);
        $extension = end($temp);
        // 判断文件是否合法
        if (!in_array($extension, array("gif", "jpeg", "jpg", "png"))) {
            exit(json_encode(array('code' => 2, 'msg' => '上传图片不合法'), JSON_UNESCAPED_UNICODE));
        } else if (file_exists($name_back)) {
            $msg = "图片已经上传过了，不能再上传了";
            exit(json_encode(array('code' => 3, 'msg' => $msg), JSON_UNESCAPED_UNICODE));
        } else {
            //所有操作都合法就移动文件到目标目录

            //链接数据库并更新修改后的数据
            Db::table('site_data')->where('id', 'site')->update([
                'background' => '/user_data/uploads/back/' . $_FILES["file"]["name"], //更新背景链接
            ]);
            move_uploaded_file($_FILES["file"]["tmp_name"], './user_data/uploads/back/' . $_FILES["file"]["name"]);
            exit(json_encode(array('code' => 200, 'msg' => '上传成功'), JSON_UNESCAPED_UNICODE));
        }
    }
}
