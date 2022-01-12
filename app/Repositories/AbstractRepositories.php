<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepositories 
{
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function selectAtrRegistrosRelacionados ($atributos)
    {   
        $this->model = $this->model->with($atributos);
    }

    public function filtro ($filtros)
    {
        $filtros = \explode(';', $filtros);

        foreach ($filtros as $key => $condicoes) {
            $c = \explode(':', $condicoes);
            $this->model = $this->model->where($c[0], $c[1], $c[2]);
        }
    }

    public function selectAtr($atributos)
    {
        $this->model = $this->model->selectRaw($atributos);
    }

    public function getResultados ()
    {
        return $this->model->get();
    }
}