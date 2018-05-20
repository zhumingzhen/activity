<?php
/**
 * Created by PhpStorm.
 * User: zhumingzhen
 * Email: z@it1.me
 * Date: 2018/4/1
 * Time: 17:39
 */
namespace App\Repositories;

class ImageMergeRepository
{
    protected $bg_img;
    protected $echo_img_path;

    public function setValue($array)
    {
        foreach ($array as $key => $value){
            $this->$key = $value;
        }
    }

    /**
     *
     * @param $dst_path  图片路径
     * @param $imgName   保存名字
     * @param string $text  水印文字
     * @param $size    字体大小
     * @param $xy      水印开始x、y坐标
     * @param $color   文字颜色
     * @param string $center  是否居中 如果设置了居中 水印x坐标失效
     */
    public function word($text, $size, $xy, $color, $center='')
    {
        // 背景图片
        $bg_img = $this->bg_img;
        // 输出的图片
        $echo_img_path = $this->echo_img_path;
        // 判断背景图片是否存在
        $dst_path = is_file($echo_img_path)?$echo_img_path:$bg_img;
        // 创建图片的实例
        $dst = imagecreatefromstring(file_get_contents($dst_path));
        // 获取背景图片宽度
        $bg_width = imagesx ( $dst );
        // 背景图片
        $bg_height = imagesy ( $dst );
        // 字体路径
        $font = public_path('/fonts/fzdbsj.TTF');
        // 文字水平居中实质
        $fontBox = imagettfbbox($size, 0, $font, $text);
        // 字体颜色
        $fontColor = imagecolorallocate($dst, $color[0], $color[1], $color[2]);  //0x00, 0x00, 0x00
        // 判断是否居中
        if($center == ''){
            imagefttext($dst, $size, 0, $xy[0]+1, $xy[1], $fontColor, $font, $text);
        }else{
            // 居中  左侧x坐标位置 = (背景图片宽度 - 文字宽度)/2
            $x_center_start = ceil(($bg_width - $fontBox[2]) / 2);
            imagefttext($dst, $size, 0, $x_center_start, $xy[1], $fontColor, $font, $text);

        }
        // 保存输出图片
        list($dst_w, $dst_h, $dst_type) = getimagesize($dst_path);
        switch ($dst_type) {
            case 1://GIF
                header('Content-Type: image/gif');
                imagegif($dst);
                break;
            case 2://JPG
                header('Content-Type: image/jpeg');
                imagejpeg($dst,$echo_img_path);
                break;
            case 3://PNG
                header('Content-Type: image/png');
                imagepng($dst);
                break;
            default:
                break;
        }
        imagedestroy($dst);

        return $echo_img_path;
    }
}