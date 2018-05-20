<?php

namespace App\Http\Controllers;

use App\Repositories\ImageMergeRepository;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function show()
    {
        return view('show');
    }

    public function store(Request $request,ImageMergeRepository $imageMergeRepository)
    {
        $username = $request->username;
        $rand = rand(1,18);
        // 背景图片
        $bg_img = public_path('image/'.$rand.'.jpg');
        // 输出的图片 如果存在输出的图片 则在此图片的基础上打文字水印
        $echo_img_path = public_path('image/activity/'.$username.'.jpg');
        $return_img_path = 'image/activity/'.$username.'.jpg';

        // 设置背景图片和输出图片
        $imageMergeRepository->setValue(['bg_img' => $bg_img, 'echo_img_path' => $echo_img_path]);
        // 标题
        $imageMergeRepository->word(
            $username,
            '42',
            ['300','190'],
            ['255','0','0']
        );
        return view('image',compact('return_img_path'));
    }

    public function image()
    {
        return view('image');
    }
}
