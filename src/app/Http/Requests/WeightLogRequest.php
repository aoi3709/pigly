<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class WeightLogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
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
    public function rules(): array
    {
        return [
            'date' => ['required', 'date'],
            'weight' => [
                'required',
                'numeric', 
                'min:0.1', 
                'regex:/^\d{1,4}(\.\d{1})?$/', 
            ],
            'calories' => ['required', 'numeric', 'min:0'],
            'exercise_time' => ['required', 'date_format:H:i'],
            'exercise_content' => ['nullable', 'string', 'max:120'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'date.required' => '日付を入力してください',
            'date.date' => '日付が不正な形式です',

            'weight.required' => '体重を入力してください',
            'weight.numeric' => '数字で入力してください',
            'weight.min' => '体重は0より大きい値を入力してください',
            'weight.regex' => '4桁までの数字で、小数点は1桁以内で入力してください',

            'calories.required' => '摂取カロリーを入力してください',
            'calories.numeric' => '数字で入力してください',
            'calories.min' => '摂取カロリーは0以上の値を入力してください',

            'exercise_time.required' => '運動時間を入力してください',
            'exercise_time.date_format' => '運動時間は「時間:分」形式で入力してください',

            'exercise_content.max' => '120文字以内で入力してください',
        ];
    }
}