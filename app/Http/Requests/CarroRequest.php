<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarroRequest extends FormRequest
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
        $rules = [
            'placa' => 'required',
            'disponivel' => 'required',
            'km' => 'required',
            'modelo_id' => 'required'
        ];

        if ($this->method() === 'PATCH') {
            
            if (\request()->all() === [] || \request()->all() === null) {
                return  $rules;
            }

            $rules_patch = '';

            foreach ($rules as $input => $regras) {
                $conteudo = \request()->all();

                if (\array_key_exists($input, $conteudo)) {
                    $rules_patch = [$input => $regras];
                }
            }
            return $rules_patch;
        }

        return $rules;
        
    }

    public function messages()
    {
        return [
            'placa.required' => 'Placa é um campo obrigatório',
            'disponivel.required' => 'Disponivel é um campo obrigatório',
            'km.required' => 'km é um campo obrigatório',
            'modelo_id.required' => 'Id modelo é obrigatório'
        ];
    }
}
