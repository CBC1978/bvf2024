<?php

namespace App\Http\Requests\auth;

use Illuminate\Foundation\Http\FormRequest;

class updateProfil extends FormRequest
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
            'name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'user_phone' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'verified' => 'required',
            'password_confirm' => 'string|same:password',
            'password' => 'string'

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
            'name.required' => 'Le nom est requis',
            'first_name.required' => 'Le prénom est requis',
            'user_phone.required' => 'Le contact est requis',
            'email.email' => 'L\'email n\'est pas un email valide',
            'password_confirm.same' => "Les mots de passe ne sont pas identiques",
        ];
    }
}
