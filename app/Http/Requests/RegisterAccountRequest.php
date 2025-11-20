<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterAccountRequest extends FormRequest
{
    public function authorize()
    {
        return true; // 誰でもこのリクエストを使える
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            // お名前
            'name.required' => 'お名前を入力してください',

            // メールアドレス
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスは「ユーザー名@ドメイン」形式で入力してください',
            'email.unique' => 'このメールアドレスはすでに登録されています',

            // パスワード
            'password.required' => 'パスワードを入力してください',
        ];
    }
}
