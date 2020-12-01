<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

use App\User;

class LoadDataUserDefault extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    $usuario = new User();
    $usuario->name = 'Soporte Tecnología';
    $usuario->email = "soporte.tecnologia@serviciodeempleo.gov.co";
    $usuario->password = bcrypt('4Dmin.FormularioWEB');
    $usuario->save();
    $usuario->syncRoles(Role::findByName('ROLE_ADMINISTRADOR', 'web'));
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    User::truncate();
  }
}
