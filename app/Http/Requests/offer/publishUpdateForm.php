<?php

namespace App\Http\Requests\offer;

use Illuminate\Foundation\Http\FormRequest;

class publishUpdateForm extends FormRequest
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
            'origin_up'=>'required',
            'destination_up'=>'required',
            'description_up'=>'required',
            'limit_date_up'=>['required','date'],
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
            'origin_up.required' => 'La ville de départ est requise',
            'destination_up.required' => 'La ville de destination est requise',
            'description_up.required' => 'La description est requise',
            'limit_date_up.required' => 'La date d\'expiration est requise',
            'limit_date_up.date' => 'Le format de la date n\'est pas correcte',
        ];
    }
}
