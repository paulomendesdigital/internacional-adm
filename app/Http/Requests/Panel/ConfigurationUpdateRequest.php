<?php

namespace App\Http\Requests\Panel;

use Illuminate\Foundation\Http\FormRequest;

class ConfigurationUpdateRequest extends FormRequest
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
            'phone' => 'required',
            'email' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'phone.required' => 'O campo Telefone é obrigatório',
            'email.required' => 'O campo E-mail é obrigatório'
        ];
    }
}
