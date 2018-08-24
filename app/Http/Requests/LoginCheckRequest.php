<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginCheckRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'email'=>[
                'required',
                //'regex:/^1[34578][0-9]\d{4,8}|(\w)+(\.\w+)*@(\w)+((\.\w+)+)|[0-9a-zA-Z_]+$/',//验证为手机号，邮箱，或帐号
                'regex:/^1[34578][0-9]\d{4,8}|(\w)+(\.\w+)*@(\w)+((\.\w+)+)+$/',//验证为手机号，邮箱
            ],
            'password'=>'required|between:6,18',//验证密码
        ];
    }
    public function messages(){
        return [
            'email.required' => '帐号不能为空',
            'email.regex' => '帐号不合法',
            'password.required'  => '密码不能为空',
            'password.between'  => '密码错误',
        ];
    }
}
