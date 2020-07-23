<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;

use App\Models\Dominio;

class EstadoReporteScope implements Scope
{
  public function apply(Builder $builder, Model $model)
  {
    $dominio = Dominio::where('grupo', 'estado_reporte')->first();
    $builder->where('dominio_id', $dominio->id);
  }
}

