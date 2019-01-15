<?php

namespace App\Http\Requests;

class ReplyRequest extends Request
{
    public function rules()
    {
        return [
            'content' => 'required|min:2'
        ];
    }

    public function messages()
    {
        return [
            'required' => '内容不能为空',
            'min' => '回复内容最少两字符'
        ];
    }
}
