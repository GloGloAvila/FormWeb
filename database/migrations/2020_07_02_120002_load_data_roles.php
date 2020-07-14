<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class LoadDataRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      $rol = new Role();
      $rol->name = 'ROLE_ADMINISTRADOR';
      $rol->guard_name = 'web';
      $rol->save();

      $rol = new Role();
      $rol->name = 'ROLE_PRESTADOR';
      $rol->guard_name = 'funcionario';
      $rol->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      $roles = Role::whereIn('name', ['ROLE_ADMINISTRADOR', 'ROLE_PRESTADOR']);
      $roles->delete();
    }

}
