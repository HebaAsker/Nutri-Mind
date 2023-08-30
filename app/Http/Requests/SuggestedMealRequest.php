<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SuggestedMealRequest extends FormRequest
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
            'name' => 'required',
            'calories' => 'required|integer|min:0',
            'protein' => 'required|integer|min:0',
            'fats' => 'required|integer|min:0',
            'carbs' => 'required|integer|min:0',
            'image' => 'required|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'calories.required' => 'The calories field is required.',
            'calories.integer' => 'The calories must be an integer.',
            'calories.min' => 'The calories must be at least 0.',
            'protein.required' => 'The protein field is required.',
            'protein.integer' => 'The protein must be an integer.',
            'protein.min' => 'The protein must be at least 0.',
            'fats.required' => 'The fats field is required.',
            'fats.integer' => 'The fats must be an integer.',
            'fats.min' => 'The fats must be at least 0.',
            'carbs.required' => 'The carbs field is required.',
            'carbs.integer' => 'The carbs must be an integer.',
            'carbs.min' => 'The carbs must be at least 0.',
            'image.required' => 'The image field is required.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
            'image.max' => 'The image must not exceed :max kilobytes in size.',
        ];
    }
}
