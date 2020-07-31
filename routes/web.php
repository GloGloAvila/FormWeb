<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/inicio', 'WelcomeController@index')->name('welcome');
Route::get('/', 'HomeController@index')->name('home');

Route::resource('vigencias', 'Vigencia\VigenciaController', ['except' => ['create', 'edit']]);
Route::resource('vigencias.periodos', 'Vigencia\PeriodoController', ['only' => ['update']]);

Route::resource('periodos.prestadores', 'Periodo\PrestadorController', ['only' => ['index']])->parameters([
    'periodos' => 'periodo'
]);
Route::resource('periodos.prestadores.puntosAtencion', 'Periodo\PuntoAtencionController', ['only' => ['index']])->parameters([
    'periodos' => 'periodo',
    'prestadores' => 'prestador'
]);

Route::resource('prestadores', 'Prestador\PrestadorController', ['only' => ['index']]);
Route::resource('prestadores.puntosAtencion', 'Prestador\PuntoAtencionController', ['only' => ['index']])->parameters([
    'prestadores' => 'prestador'
]);

Route::resource('puntosAtencion.periodos.reportes', 'PuntoAtencion\ReporteController', ['only' => ['store', 'index']])->parameters([
    'puntosAtencion' => 'puntoAtencion',
    'periodos' => 'periodo'
]);
