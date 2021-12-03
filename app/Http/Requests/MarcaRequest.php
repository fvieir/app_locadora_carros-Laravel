<?php

namespace App\Http\Requests;

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
        if ($this->method() === 'PATCH' || $this->method() === 'PUT') {
            
            $rules = [
                'nome' => 'required|unique:marcas,nome,'.$this->marca->id.'|min:3',
                'imagem' => 'required|mimes:png,pdf|max:3000'
            ];
            /*
           unique
               1- Tabela
               2 - nome da coluna
               3- id que sera desconsiderado na pesquisa
            */
        } else {
            $rules = [
                'nome' => 'required| unique:marcas,nome,|min:3',
                'imagem' => 'required|mimes:png,pdf|max:1000',
            ];
        }
        
        // Recuperar apenas as regras do input enviado
        if($this->method() === 'PATCH') {
            
            if (\request()->all() === [] || \request()->all() === null) {                
                return $rules;
            }

            $rules_patch = '';

            foreach ($rules as $input => $regras) {

                $conteudo = \request()->all();

                if (array_key_exists($input, $conteudo)){
                    $rules_patch = [$input =>$regras];
                }
            }

            return $rules_patch;
        }

        return $rules;
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
