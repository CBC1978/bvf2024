<?php

namespace App\Http\Requests\offer;

use Illuminate\Foundation\Http\FormRequest;

class applyForm extends FormRequest
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
            'price'=>['required'],
            'weight'=>['required'],
            'description'=>['required'],
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
            'price.required' => 'Le prix est requis',
            'weight.required' => 'Le poids est requis',
            'description.required' => 'La description est requise',
        ];
    }
}
