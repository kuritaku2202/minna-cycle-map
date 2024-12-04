<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SafetyReportRequest extends FormRequest
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
            'safetyReport.date'=>'required|date|before_or_equal:today',
            'safetyReport.time_period_id'=>'required',
            'safetyReport.security_staff'=>'required',
            'safetyReport.security_camera'=>'required',
        ];
    }

    public function messages():array
    {
        return [
            'safetyReport.date.required'=>'必須項目です',
            'safetyReport.date.before_or_equal:today'=>'今日以前の日付を入力してください',
            'safetyReport.time_period_id.required'=>'必須項目です',
            'safetyReport.security_staff.required'=>'必須項目です',
            'safetyReport.security_camera.required'=>'必須項目です',
        ];
    }
}
