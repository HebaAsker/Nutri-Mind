<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReportRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'diagnosis_of_his_state' => 'required',
            'description' => 'required',
            'appointment_id' => 'required|exists:appointments,id',
        ];
    }

    public function messages()
    {
        return [
            'diagnosis_of_his_state.required' => 'Please add the dianosis of his state.',
            'description.required' => 'Please add description.',
            'appointment_id.required' => 'You are not authorized to access this information.',
            'appointment_id.exists' => 'The appointment ID does not exist.',
        ];
    }
}
