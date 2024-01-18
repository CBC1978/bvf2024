<?php

namespace App\Http\Requests\auth;

use Illuminate\Foundation\Http\FormRequest;

class loginForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => ['required', 'email:rfc','exists:users'],
            'password' => ['required', 'min:4']
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'email.required' => 'L\'email est requis',
            'email.exists' => 'L\'email n\'existe pas',
            'email.email' => 'L\'email n\'est pas un email valide',
            'password.required' => 'Le mot de passe est requis',
            'password.min' => 'Le mot de passe doit être supérieur à 8 caractères',
        ];
    }
}
