<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PessoaUpdateRequest extends FormRequest
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
        $id = $this->route('pessoa');

        return [
            'nome' => 'max:100|nullable',
            'cpf' => "required|min:11|max:14|unique:pessoas,cpf,{$id},id",
            'identidade' => "min:8|max:14|unique:pessoas,identidade,{$id},id",
            'cep' => 'max:9|nullable',
            'end_residencial' => 'max:100|nullable',
            'bairro' => 'max:50|nullable',
            'cidade' => 'max:50|nullable',
            'uf' => 'max:2|nullable',
            'profissao' => 'max:30|nullable',
            'fone' => 'max:14|nullable',
            'celular' => 'max:15|nullable',
        ];
    }
}
