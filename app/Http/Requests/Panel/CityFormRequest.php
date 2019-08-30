<?php

namespace App\Http\Requests\Panel;

use Illuminate\Foundation\Http\FormRequest;

class CityFormRequest extends FormRequest
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
            'state_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo Nome é obrigatório',
            'state_id.required' => 'O campo Estado é obrigatório',
        ];
    }
}
