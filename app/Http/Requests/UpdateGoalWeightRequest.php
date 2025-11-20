<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGoalWeightRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'goal_weight' => [
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
            'goal_weight.required' => '体重を入力してください',
            'goal_weight.numeric' => '数字で入力してください',
            'goal_weight.max' => '4桁までの数字で入力してください',
            'goal_weight.regex' => '小数点は1桁で入力してください',
        ];
    }
}
