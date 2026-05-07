<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEnderecoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'cep' => ['required|max:11'],
            'logradouro' => ['required'],
            'complemento' => ['nullable'],
            'unidade' => ['required'],
            'bairro' => ['required'],
            'localidade' => ['required'],
            'uf' => ['required|max:2'],
            'regiao' => ['required'],
        ];
    }
}
