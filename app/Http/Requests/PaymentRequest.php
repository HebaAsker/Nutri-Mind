<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:paid,not paid',
            'card_number' => 'required|min:16|max:16',
            'CVV' => 'required|string|min:3|max:3',
            'ex_date' => 'required|date',
            'payment_method' => 'required|string',
            'doctor_id' => 'required|integer|exists:doctors,id',
            'patient_id' => 'required|integer|exists:patients,id'
        ];
    }
    public function messages(): array
{
    return [
        'price.required' => 'The price field is required.',
        'price.numeric' => 'The price must be a numeric value.',
        'price.min' => 'Please enter valid price.',
        'status.required' => 'The status field is required.',
        'status.in' => 'The status must be either "paid" or "not paid".',
        'card_number.required' => 'The card number field is required.',
        'card_number.min' => 'The card number must be exactly :16 characters.',
        'card_number.max' => 'The card number must be exactly :16 characters.',
        'CVV.required' => 'The CVV field is required.',
        'CVV.string' => 'The CVV must be a string.',
        'CVV.min' => 'The CVV must be exactly :3 characters.',
        'CVV.max' => 'The CVV must be exactly :3 characters.',
        'ex_date.required' => 'The expiration date field is required.',
        'ex_date.date' => 'The expiration date must be a valid date.',
        'payment_method.required' => 'The payment method field is required.',
        'payment_method.string' => 'Please choose the correct payment method. If you think there is a wrong thing please connect the admins.',
        'doctor_id.*' => 'You are not authorized to access this information.',
        'patient_id.*' => 'You are not authorized to access this information.'
    ];
}
}
