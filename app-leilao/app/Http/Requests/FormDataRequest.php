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
            'password' => 'min:6|required_with:c-password|same:c-password',
            'c-password' => 'required|min:6',
            'phone' => 'required',
            'zip_code' => 'required',
            'street' => 'required',
            'number' => 'required',
            'district' => 'required',
            'city' => 'required',
            'state' => 'required',
            'terms' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nome obrigatório',
            'name.min' => 'Nome deve conter sobrenome e no mínimo 5 caracteres.',
            'email.required' => 'E-mail é de preenchimento obrigatório.',
            'email.unique' => 'E-mail já cadastrado em nossa base.',
            'password.required' => 'Senha é de preenchimento obrigatório.',
            'password.same' => 'Senha e confirmação de senha devem ser iguais',
            'c-password.confirmed' => 'Senhas não conferem, favor revisar',
            'c-password.required' => 'Confirmação de senha obrigatória',
            'password.min' => 'Senha deve conter pelo menos 6 dígitos',
            'phone.required' => 'Telefone é obrigatório',
            'zip_code.required' => 'CEP é obrigatório',
            'street.required' => 'Logradouro é obrigatório',
            'number.required' => 'Número é obrigatório',
            'district.required' => 'Município é obrigatório',
            'city.required' => 'Cidade é obrigatório',
            'state.required' => 'Estado é obrigatório',
            'terms.required' => 'Obrigatório aceitar os termos'
        ];
    }
}
