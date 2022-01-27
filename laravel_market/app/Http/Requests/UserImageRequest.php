<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserImageRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'image' => [
              'required',
              'file', // ファイルがアップロードされている
              'image', // 画像ファイルである
              'mimes:jpeg,jpg,png', // 形式はjpegかpng
              'dimensions:min_width=50,min_height=50,max_width=1000,max_height=1000', // 50*50 ~ 1000*1000 まで
            ],
        ];
    }
}
