<?php

namespace App\Models;

use App\Scopes\TipoFuncionarioScope;

class TipoFuncionario extends Opcion
{

  protected static function boot()
  {
    parent::boot();
    static::addGlobalScope(new TipoFuncionarioScope);
  }

  public function funcionarios()
  {
    return $this->hasMany(Funcionario::class);
  }

}
