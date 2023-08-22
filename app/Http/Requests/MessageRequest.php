<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array>
     */
    public function rules(): array
    {
        return [
            'content' =>'required',
<<<<<<< HEAD
            'receiver_name' => 'required',
=======
            'status' => 'required',
>>>>>>> aa22e7d0d2ea83fc3861372d5f4a83f8dfbe9b22

        ];
    }
}
