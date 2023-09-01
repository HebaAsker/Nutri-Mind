<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoteRequest extends FormRequest
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
            'patient_id' => 'required|integer|exists:patients,id',
            'title' => [
                'max:255'
            ]
        ];
    }
    public function messages(): array
    {
        return [
            'patient_id.*'=>'You are not authorized to access this information.',
            'title.max' => 'The title must not excced 255 characters'
        ];
    }
}
