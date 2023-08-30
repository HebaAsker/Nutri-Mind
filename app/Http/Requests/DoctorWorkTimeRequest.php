<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorWorkTimeRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'date' => 'required|date',
            'doctor_id' => 'required|integer|exists:doctors,id',
            'available_times' => 'array',
            'available_times.*' => 'string|regex:/^[0-2][0-9]:[0-5][0-9]$/|unique:doctor_work_times,date,time'
        ];
    }
    public function messages(): array
    {
        return [
            'date.required' => 'The date field is required.',
            'date.date' => 'Please enter a valid date.',
            'doctor_id.required' => 'Please select doctor.',
            'doctor_id.integer' => 'You are not authorized to access this information.',
            'doctor_id.exists' => 'The selected doctor does not exist.',
            'available_times.array' => 'The available times must be an array.',
            'available_times.*.string' => 'Each available time must be a string.',
            'available_times.*.regex' => 'Invalid time format. Please enter a time in the format HH:MM.',
            'available_times.*.unique' => 'The selected time slot is already taken for the specified date.',
        ];
    }
}
