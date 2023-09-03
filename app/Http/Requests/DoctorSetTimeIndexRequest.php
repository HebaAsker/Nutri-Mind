<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorSetTimeIndexRequest extends FormRequest
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
    public function rules()
    {
        return [
            'date' => 'required|date',
            'doctor_id' => 'required|integer',
        ];
    }
    public function messages()
    {
        return [
            'date.required' => 'The date field is required.',
            'date.date' => 'The date must be a valid date.',
            'doctor_id.*' => 'You are not authorized to access doctor-related information.'
        ];
    }
}
