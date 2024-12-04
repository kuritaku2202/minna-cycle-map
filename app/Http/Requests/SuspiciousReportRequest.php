<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SuspiciousReportRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'suspiciousReport.date'=>'required|date|before_or_equal:today',
            'suspiciousReport.time_period_id'=>'required',
            'suspiciousReport.description'=>'required|string|max:1000',
        ];
    }

    public function messages():array
    {
        return [
            'suspiciousReport.date.required'=>'必須項目です',
            'suspiciousReport.date.before_or_equal:today'=>'今日以前の日付を入力してください',
            'suspiciousReport.time_period_id.required'=>'必須項目です',
            'suspiciousReport.description.required'=>'必須項目です',
            'suspiciousReport.description.max'=>':max文字以内で入力してください',
        ];
    }
}
