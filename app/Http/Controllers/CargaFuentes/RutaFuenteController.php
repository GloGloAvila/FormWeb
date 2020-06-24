<?php

namespace App\Http\Controllers\CargaFuentes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RutaFuenteController extends Controller
{
  protected $sources_path;

  public function __construct()
  {
      $this->sources_path=storage_path()."/app/sources/";
  }

}
