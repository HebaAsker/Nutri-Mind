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

    public function rules(): array
    {
        return [
            'day_name' => 'required|string|unique:doctor_work_times,day_name,finish_time,start_time,doctor_id',
            'start_time' => 'required|date_format:H:i:s',
            'finish_time' => 'required|date_format:H:i:s',
            'status' => 'required|in:set,not set',
            'doctor_id' => 'required|integer|exists:doctors,id'
        ];
    }

    public function messages(): array
    {
        return [
            'day_name.required' => 'Please choose day to set these work time in.',
            'day_name.date' => 'You are not authorized to access this information.If you think that there is any thing wrong please connect the admins.',
            'start_time.required' => 'The start time field is required.',
            'start_time.date_format' => 'Invalid time format. Please enter a time in the format HH:MM.',
            'finish_time.required' => 'The finish time field is required.',
            'finish_time.date_format' => 'Invalid time format. Please enter a time in the format HH:MM.',
            'status.required' => 'The status field is required.',
            'status.in' => 'The status must be one of the following: set, not set.',
            'doctor_id.required' => 'Please select doctor.',
            'doctor_id.integer' => 'You are not authorized to access this information.',
            'doctor_id.exists' => 'The selected doctor does not exist.',
            'day_name.unique' => 'The selected day, finish time, and start time combination is already taken.',
        ];
    }
}
