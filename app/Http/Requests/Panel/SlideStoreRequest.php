<?php

namespace App\Http\Requests\Panel;

use Illuminate\Foundation\Http\FormRequest;

class SlideStoreRequest extends FormRequest
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
            'title' => 'required',
            'image' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'O campo Título é obrigatório',
            'image.required' => 'O campo Imagem é obrigatório',
        ];
    }
}
