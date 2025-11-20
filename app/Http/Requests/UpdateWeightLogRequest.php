<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWeightLogRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'date' => ['required', 'date'],
            'weight' => ['required', 'numeric', 'max:999.9', 'regex:/^\d{1,3}(\.\d)?$/'],
            'calories' => ['required', 'numeric', 'max:9999'],
            'exercise_time' => ['required'],
            'exercise_content' => ['required', 'string', 'max:120'],
        ];
    }

    public function messages(): array
    {
        return [
            'date.required' => '日付を入力してください',

            'weight.required' => '体重を入力してください',
            'weight.numeric' => '数字で入力してください',
            'weight.max' => '4桁までの数字で入力してください',
            'weight.regex' => '小数点は1桁で入力してください',

            'calories.required' => '摂取カロリーを入力してください',
            'calories.numeric' => '数字で入力してください',

            'exercise_time.required' => '運動時間を入力してください',

            'exercise_content.required' => '運動内容を入力してください',
            'exercise_content.max' => '120文字以内で入力してください',
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->has('exercise_time') && !empty($this->exercise_time)) {
            try {
                $formatted = \Carbon\Carbon::createFromFormat('H:i', $this->exercise_time)->format('H:i');
                $this->merge(['exercise_time' => $formatted]);
            } catch (\Exception $e) {
                // 無効な形式ならそのまま（バリデーションで弾かれる）
            }
        }
    }
}
