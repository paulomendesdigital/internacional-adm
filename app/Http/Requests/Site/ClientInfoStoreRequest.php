<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class ClientInfoStoreRequest extends FormRequest
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
            'email' => 'required',
            'birth' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'O campo E-mail é obrigatório',
            'birth.required' => 'O campo Data de Nascimento é obrigatório'
        ];
    }
}
