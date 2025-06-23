<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class UpdateGoalWeightRequest extends FormRequest
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
            'target_weight' => [
                'required',
                'numeric',
                'min:0.1', 
                'regex:/^\d{1,4}(\.\d{1})?$/', 
            ],
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
            'target_weight.required' => '目標の体重を入力してください',
            'target_weight.numeric' => '目標の体重は数値で入力してください',
            'target_weight.min' => '目標の体重は0より大きい値を入力してください',
            'target_weight.regex' => '4桁までの数字で、小数点は1桁以内で入力してください',
        ];
    }
}