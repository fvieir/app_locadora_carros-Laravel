<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocacaoRequest extends FormRequest
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
            'cliente_id' => 'required',
            'carro_id' => 'required',
            'valor_diaria' => 'required|numeric|min:1|max:10000000',
            'data_inicio_periodo' => 'required|date|before:data_final_previsto',
            'data_final_previsto' => 'required|date',
            'data_final_realizado' => 'required|date|after_or_equal:data_inicio_periodo',
            'km_inicial' => 'required|min:1',
            'km_final' => 'required|min:1'
        ];

        // Regras dinâmicas para o metodo PATCH
        if ($this->method() === 'PATCH')  {

            if (\request()->all() === [] || \request()->all() === null) {
                return $rules;
            }
            
           $rules_patch = [];        

           foreach ($rules as $input => $regras) {

               if (array_key_exists($input, request()->all())) {
                $rules_patch[$input] = $regras;
               }
           }

           return $rules_patch;
           
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'data_inicio_periodo.before' => 'Insira uma data menor que data final de previsão',
            'data_final_realizado.after_or_equal' => 'Insira uma data maior que data final de previsão'
        ];
    }
}
