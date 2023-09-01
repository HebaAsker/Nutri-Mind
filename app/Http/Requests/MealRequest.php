<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MealRequest extends FormRequest
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
            "name" => "required",
            "calories" => "required|integer",
            "protein" => "required|integer",
            "fats" => "required|integer",
            "carbs" => "required|integer",
            "time" => "required|regex:/^[0-9]{2}:[0-9]{2}$/",
            "date" => "required|regex:/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/",
            "type" => "required|in:breakfast,lunch,dinner",
            'image' => 'mimes:jpeg,png,jpg,gif|max:2048',
            'patient_id' => 'required|integer|exists:patients,id',
        ];
    }

    public function messages(): array
    {
        return [
            "name.required" => "Please provide the name of the meal.",
            "calories.required" => "Please enter the number of calories for the meal.",
            "calories.integer" => "The calories must be a whole number.",
            "protein.required" => "Please enter the amount of protein for the meal.",
            "protein.integer" => "The protein must be a whole number.",
            "fats.required" => "Please enter the amount of fats for the meal.",
            "fats.integer" => "The fats must be a whole number.",
            "carbs.required" => "Please enter the amount of carbs for the meal.",
            "carbs.integer" => "The carbs must be a whole number.",
            "time.required" => "Please provide the time for the meal.",
            "time.regex" => "The time must be in the format HH:mm.",
            "date.required" => "Please provide the date for the meal.",
            "date.regex" => "The date must be in the format YYYY-MM-DD.",
            "type.required" => "Please specify the type of the meal.",
            "type.in" => "The meal type must be one of breakfast, lunch, or dinner.",
            'patient_id.*' => 'You are not authorized to access this information.',
            'image.mimes' => 'Only JPEG, PNG, JPG, and GIF images are allowed.',
            'image.max' => 'The uploaded image cannot exceed 2MB in size.',
        ];
    }
}
