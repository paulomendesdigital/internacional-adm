<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class ClientStoreRequest extends FormRequest
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
            'name' => 'required',
            'phone' => 'required',
            'modality_id' => 'required',
            'abrangencia' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo Nome é obrigatório',
            'phone.required' => 'O campo Telefone é obrigatório',
            'modality_id.required' => 'O campo Modalidade é obrigatório',
            'abrangencia.required' => 'O campo Abrangência é obrigatório',
        ];
    }
}
