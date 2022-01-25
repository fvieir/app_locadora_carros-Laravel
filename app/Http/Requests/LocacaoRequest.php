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
            'data_inicio_periodo' => 'required|date|before:data_final_previsto',
            'data_final_previsto' => 'required|date',
            'data_final_realizado' => 'required|date|after_or_equal:data_inicio_periodo',
            'km_inicial' => 'required|min:1',
            'km_final' => 'required|min:1'
        ];

        // Regras dinâmicas para o metodo PATCH
        if ($this->method() === 'PATCH')  {

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
