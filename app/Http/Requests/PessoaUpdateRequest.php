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
        $pessoa = $this->route('pessoa');

        return [
            'cpf' => "required|min:11|max:14|unique:pessoas,cpf,{$pessoa->id},id",
            'identidade' => "sometimes|required|min:7|max:14|unique:pessoas,identidade,{$pessoa->id},id",
        ];
    }
}
