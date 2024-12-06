<?php

namespace App\Http\Requests\auth\signature;

use Illuminate\Foundation\Http\FormRequest;

class signatureFormAdd extends FormRequest
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
            'signature'=>'required',
            'signature.mimes'=>'image/jpeg,image/png,image/jpg',
            'signature.max'=>'2048',
        ];
    }

    public function messages(): array
    {
        return [
            'signature.required' => 'Le fichier signature est requis',
            'signature.mimes' => 'Le fichier signature doit être une image',
            'signature.max' => 'Le fichier signature doit être inférieur à 2Mo',
        ];
    }
}
