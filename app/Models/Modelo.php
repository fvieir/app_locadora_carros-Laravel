<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    use HasFactory;

    public function marca() {
        return $this->belongsTo(Marca::class);
    }

    protected $fillable = [
        'marca_id',
        'nome',
        'imagem',
        'numero_portas',
        'lugares',
        'air_bag',
        'abs'
    ];

    public function rules()
    {
        return [
            'marca_id' => 'required|exists:marcas,id',
            'nome' => 'required|unique:modelos,nome,'.$this->id.'|min:3',
            'imagem' => 'required|file|mimes:png,jpeg,jpg',
            'numero_portas' => 'required|integer|between:1,5',
            'lugares' =>'required|integer|between:1,5',
            'air_bag' =>'required|boolean',
            'abs' => 'required|boolean'
        ];

        /*
            exists
            1 - Tabela
            2 -Campo

            digits_between => valor inicial e valor final
            Exe: 1,5 valor pode estar entre 1 ate 5

            boolean, valores aceitos
            true, false
             1,      0
            "1",   "0"
        */ 
    }
}
