<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormDataRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|min:5',
            'email' => 'required|email|unique:users',
            //'gender' => 'required',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nome obrigatório',
            'name.min' => 'Nome deve conter sobrenome e no mínimo 5 caracteres.',
            'email.required' => 'E-mail é de preenchimento obrigatório.',
            'email.unique' => 'E-mail já cadastrado em nossa base.',
            'password.required' => 'Senha é de preenchimento obrigatório.'
        ];
    }
}
