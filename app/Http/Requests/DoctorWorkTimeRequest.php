<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DoctorWorkTimeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'day' => [
                'required',
                'array',
                Rule::in(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday','Saturday','Sunday']),
            ],
            'time' => [
                'required',
                Rule::in(['9:00 am to 2:00 pm', '2:00 pm to 6:00 pm']),
            ],
            'doctor_id' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'day.required' => 'The day field is required.',
            'day.array' => 'Invalid data.',
            'day.in' => 'Invalid weekday name.',
            'time.required' => 'The time field is required.',
            'time.in' => 'The time must be either "9:00 am to 2:00 pm" or "2:00 pm to 6:00 pm".',
            'doctor_id.*' => 'You are not authorized to access doctor-related information.',
        ];
    }
}
