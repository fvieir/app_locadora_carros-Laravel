<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Locacao extends Model
{
    use HasFactory;
    protected $table = 'locacoes';
    protected $fillable = [
        'cliente_id',
        'carro_id',
        'data_inicio_periodo',
        'data_final_previsto',
        'data_final_realizado',
        'valor_diaria',
        'km_inicial',
        'km_final'
    ];

    public function cliente () 
    {
        return $this->hasOne('\App\Models\cliente');
    }

    public function carros () 
    {
        return $this->hasMany('\App\Models\carro');
    }
}
