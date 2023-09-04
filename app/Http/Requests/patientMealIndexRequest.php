<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class patientMealIndexRequest extends FormRequest
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
            'patient_id' => 'required|exists:patients,id',
            'status' => 'required|in:suggested,selected,saved',
        ];
    }
    public function messages(): array
    {
        return [
            'patient_id.*' => 'You are not authorized to access this information.',
            'status.*'=>'You are not authorized to access this information.'
        ];
    }
}
