<?php

namespace App\Models;

use App\Scopes\MesScope;
use App\Models\User;

class Mes extends Opcion
{

  protected static function boot()
  {
    parent::boot();
    static::addGlobalScope(new MesScope);
  }

  public function periodos()
  {
    return $this->hasMany(Periodo::class);
  }

}
