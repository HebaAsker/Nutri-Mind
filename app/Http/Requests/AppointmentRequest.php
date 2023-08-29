<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name' => 'required|string|max:255',
            'age' => 'required|integer',
            'doctor_work_time_id' => [
                'required',
                'integer',
                'exists:doctor_work_times,id',
                'unique:appointments,doctor_work_time_id'
            ],
            'doctor_id' => 'required|integer|exists:doctors,id',
            'payment_id' => [
                'required',
                'integer',
                'exists:payments,id',
                'unique:appointments,payment_id'
            ],
            'patient_id' => 'required|integer|exists:patients,id'
        ];
    }
    public function messages(): array
    {
        return [
            'doctor_work_time_id.unique' => 'That time is not available.',
        ];
    }
}
