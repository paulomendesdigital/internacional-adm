<?php

namespace App\Http\Requests\Panel;

use Illuminate\Foundation\Http\FormRequest;

class AgeFormRequest extends FormRequest
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
            'initial_age' => 'required|numeric',
            'final_age' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo Nome é obrigatório',
            'initial_age.required' => 'O campo Idade Inicial é obrigatório',
            'final_age.required' => 'O campo Idade Final é obrigatório',
        ];
    }
}
