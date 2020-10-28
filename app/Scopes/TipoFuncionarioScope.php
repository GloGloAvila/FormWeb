<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;

use App\Models\Dominio;

class TipoFuncionarioScope implements Scope
{
  public function apply(Builder $builder, Model $model)
  {
    $dominio = Dominio::where('grupo', 'tipo_funcionario')->first();
    $builder->where('dominio_id', $dominio->id);
  }
}

