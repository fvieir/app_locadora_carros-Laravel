<?php

namespace App\Http\Requests;

use Facade\Ignition\DumpRecorder\Dump;
use Illuminate\Foundation\Http\FormRequest;

class MarcaRequest extends FormRequest
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
            'nome' => 'required|unique:marcas,nome,'.$this->marca.'|min:3',
            'imagem' => 'required'
        ];

        if ($this->method() === 'PATCH') {
           
            $regrasDinamicas = [];
           
            foreach ($rules as $input => $regras) {
                
                if (\array_key_exists($input, \request()->all())) {
                    $regrasDinamicas[$input] = $regras;
                }
            }
            return $regrasDinamicas;
        } 
        
        return $rules; 


        //     $rules = [
        //         'nome' => 'required|unique:marcas,nome,'.$this->marca->id.'|min:3',
        //         'imagem' => 'required|mimes:png,pdf|max:3000'
        //     ];
    }

    public function messages() {
        return [
            'nome.required' => 'Campo nome é obrigatório',
            'nome.unique' => 'Registro nome já esta inserido no sistema, é um campo unico.',
            'imagem.required' => 'Campo imagem é obrigatório',
            'imagem.mimes' => 'Tipo de arquivo deve ser do tipo PNG ou PDF'
        ];
    }
}
