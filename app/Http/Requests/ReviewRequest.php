<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
            'doctor_id' => 'required|integer|exists:doctors,id',
            'patient_id' => 'required|integer|exists:patients,id',
            'rate' => 'required|integer|between:1,5'
        ];
    }
    public function messages(): array
    {
        return [
            'patient_id.*' => 'You are not authorized to access this information.',
            'doctor_id.*' => 'You are not authorized to access this information.',
            'rate.required' => 'The rate is required.',
            'rate.integer' => 'The rate must be an integer.',
            'rate.between' => 'The rate must be between 1 and 5.',
        ];
    }
}
