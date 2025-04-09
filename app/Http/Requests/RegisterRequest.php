<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'firstname' => 'required|min:2',
            'lastname' => 'required|min:2',
            'email' => 'required|email:rfc,dns|unique:users',
            'password' => 'required|min:16',
            'password_confirmation' => 'required|same:password',
            'gender_id' => 'required',
        ];
    }
}
