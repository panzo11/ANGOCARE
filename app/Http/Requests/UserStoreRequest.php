<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome' => 'max:255',
            'logotipo' => 'mimes:pdf,jpg,jpeg,png',
            'documentos.*.documento' => 'mimes:pdf,jpg,jpeg,png',
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
            'vc_tipo_utilizador'=>'required',
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
            'nome.string' => 'O nome deve ser uma string.',
            'nome.max' => 'O nome não pode ter mais de 255 caracteres.',
            'logotipo.mimes' => 'O logotipo deve ser um arquivo do tipo: pdf, jpg, jpeg, png.',
            'descricao.string' => 'A descrição deve ser uma string.',
            'documentos.*.documento.mimes' => 'O documento deve ser um arquivo do tipo: pdf, jpg, jpeg, png.',
            'name.required' => 'O campo nome é obrigatório.',
            'email.required' => 'O campo email é obrigatório.',
            'password.required' => 'O campo senha é obrigatório.',
            'vc_tipo_utilizador.required' => 'O campo tipo de utilizador é obrigatório.',
        ];
    }
}
