<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Modelo;

class Marca extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'imagem'
    ];


    public function modelos() {
        return $this->hasMany(Modelo::class);
    }

    // Validações no Model
    public function rules() {
        return [
            'nome' => 'required|unique:marcas,nome,'. $this->id .'|min:3',
            'imagem' => 'required'
        ];
    }

    /*
    unique
        1- Tabela
        2 - nome da coluna
        3- id que sera desconsiderado na pesquis
    */

    public function messages() {
        return [
            'nome.required' => 'Campo nome é obrigatório',
            'nome.unique' => 'Campo nome é unico',
            'imagem.required' => 'Campo imagem é obrigatório'
        ];
    }
}
