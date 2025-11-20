<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterStep2Request extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'current_weight' => [
                'required',
                'numeric',
                'max:999.9',
                'regex:/^\d{1,3}(\.\d)?$/',
            ],
            'target_weight' => [
                'required',
                'numeric',
                'max:999.9',
                'regex:/^\d{1,3}(\.\d)?$/',
            ],
        ];
    }

    public function messages()
    {
        return [
            'current_weight.required' => '体重を入力してください',
            'current_weight.numeric' => '数字で入力してください',
            'current_weight.max' => '4桁までの数字で入力してください',
            'current_weight.regex' => '小数点は1桁で入力してください',
            'target_weight.required' => '体重を入力してください',
            'target_weight.numeric' => '数字で入力してください',
            'target_weight.max' => '4桁までの数字で入力してください',
            'target_weight.regex' => '小数点は1桁で入力してください',
        ];
    }
}
