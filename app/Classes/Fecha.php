<?php

namespace App\Classes;

use Carbon\Carbon;
use DateTimeZone;

class Fecha
{

  public static function obtenerFechaActual()
  {
    return Carbon::parse(Carbon::now(new DateTimeZone('America/Bogota')))->toDateString();
  }

}
