<?php

namespace App\Models;

use App\Scopes\EstadoReporteScope;

class EstadoReporte extends Opcion
{

  protected static function boot()
  {
    parent::boot();
    static::addGlobalScope(new EstadoReporteScope);
  }

  public function periodos()
  {
    return $this->hasMany(Periodo::class);
  }

}
