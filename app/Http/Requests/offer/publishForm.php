<?php

namespace App\Http\Requests\offer;

use Illuminate\Foundation\Http\FormRequest;

class publishForm extends FormRequest
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
            'origin'=>'required',
            'destination'=>'required',
            'description'=>'required',
            'limit_date'=>['required','date'],
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
            'origin.required' => 'La ville de départ est requise',
            'destination.required' => 'La ville de destination est requise',
            'description.required' => 'La description est requise',
            'limit_date.required' => 'La date d\'expiration est requise',
            'limit_date.date' => 'Le format de la date n\'est pas correcte',
        ];
    }
}
