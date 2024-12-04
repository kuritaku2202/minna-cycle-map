<?php

namespace App\Http\Requests;

use App\Models\IncidentReport;
use Illuminate\Foundation\Http\FormRequest;

class IncidentReportRequest extends FormRequest
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
            'incidentReport.date'=>'required|date|before_or_equal:today',
            'incidentReport.time_period_id'=>'required',
            'incidentReport.description'=>'required|string|max:1000',
        ];
    }

    public function messages():array
    {
        return [
            'incidentReport.date.required'=>'必須項目です',
            'incidentReport.date.before_or_equal'=>'今日以前の日付を入力してください',
            'incidentReport.time_period_id.required'=>'必須項目です',
            'incidentReport.description.required'=>'必須項目です',
            'incidentReport.description.max'=>':max文字以内で入力してください',
        ];
    }
}
