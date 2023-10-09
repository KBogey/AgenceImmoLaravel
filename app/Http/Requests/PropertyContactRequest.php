<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertyContactRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'firstname' => ['string', 'required', 'min:2'],
            'lastname' => ['string', 'required', 'min:2'],
            'phone' => ['string', 'required', 'min:10'],
            'email' => ['email', 'required', 'min:4'],
            'message' => ['string', 'required', 'min:4']

        ];
    }
}
