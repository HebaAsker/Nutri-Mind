<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientMealRequest extends FormRequest
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
            'meal_id' => 'required|exists:suggested_meals,id',
        ];
    }
    public function messages(): array
    {
        return [
            'patient_id.*' => 'You are not authorized to access this information.',
            'meal_id.required' => 'You are not authorized to access this information.',
            'meal_id.exists' => 'The selected meal is invalid.',
        ];
    }
}
