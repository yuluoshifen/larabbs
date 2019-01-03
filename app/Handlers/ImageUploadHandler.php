<?php
/**
 * Created by PhpStorm.
 * User: 雨落十分
 * Date: 2019/1/2
 * Time: 22:23
 */

namespace App\Handlers;

use Image;

class ImageUploadHandler
{
    //限制上传文件类型
    protected $allow_ext = ['png', 'jpg', 'gif', 'jpeg'];

    public function save($file, $folder, $file_prefix, $max_width = false)
    {
        //获取文件后缀名
        $extension = strtolower($file->getClientOriginalExtension()) ?: 'png';

        //判断上传的文件是否是图片
        if (!in_array($extension, $this->allow_ext)) {
            return false;
        }

        //文件存储路径
        $folder_name = "uploads/images/$folder/" . date("Ym/d", time());

        //文件存储绝对路径
        $upload_path = public_path() . '/' . $folder_name;

        //拼接文件名
        $filename = $file_prefix . '_' . time() . '_' . str_random(10) . '.' . $extension;

        //将图片移到指定目录
        $file->move($upload_path, $filename);

        if ($max_width && $extension != 'gif') {
            $this->reduceSize($upload_path . '/' . $filename, $max_width);
        }

        return ['path' => config('app.url') . "/$folder_name/$filename"];
    }

    public function reduceSize($file_path, $max_width)
    {
        //实例化，参数为绝对路径
        $image = Image::make($file_path);

        //进行大小调整
        $image->resize($max_width, null, function ($constraint) {
            //宽度是$max_width，高度等比例缩放
            $constraint->aspectRatio();

            //防止截图时图片尺寸变大
            $constraint->upsize();
        });

        //保存修改后的图片
        $image->save();
    }
}