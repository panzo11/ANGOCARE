<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoacaoFinanciamentoRequest extends FormRequest
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
            
            'valores'=>'required',
            'comprovativo'=>'required|mimes:pdf,jpg,jpeg,png',
        ];
    }
    public function messages(): array
    {
        return [
            'valores.required'=>'Valores é um campo obrigatorio',
            'comprovativo.required' => 'Um comprovativo é necessário.',
            'comprovativo.mimes' => 'O comprovativo deve ser um arquivo do tipo: pdf, jpg, jpeg, png.',
        ];
    }
}
