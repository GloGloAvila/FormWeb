<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Auth::routes();

Route::get('/inicio', 'WelcomeController@index')->name('welcome');
Route::get('/', 'HomeController@index')->name('home');

Route::resource('vigencias', 'Vigencia\VigenciaController', ['except' => ['create', 'edit']]);
Route::resource('vigencias.periodos', 'Vigencia\PeriodoController', ['only' => ['update']]);

Route::resource('periodos.prestadores', 'Periodo\PrestadorController', ['only' => ['index']])->parameters([
    'periodos' => 'periodo'
]);
Route::resource('periodos.prestadores.puntosAtencion', 'Periodo\PuntoAtencionController', ['only' => ['index']])
    ->parameters([
        'periodos' => 'periodo',
        'prestadores' => 'prestador'
    ]);

Route::resource('tiposFuncionario', 'TipoFuncionario\TipoFuncionarioController', ['only' => ['index']]);

Route::resource('prestadores', 'Prestador\PrestadorController', ['only' => ['index']]);
Route::resource('prestadores.puntosAtencion', 'Prestador\PuntoAtencionController', ['only' => ['index']])->parameters([
    'prestadores' => 'prestador'
]);
Route::resource('prestadores.funcionarios', 'Prestador\FuncionarioController', ['only' => ['index', 'store', 'update']])->parameters([
    'prestadores' => 'prestador',
    'funcionarios' => 'funcionario'
]);

Route::resource('puntosAtencion.periodos.reportes', 'PuntoAtencion\ReporteController', ['only' => ['store', 'index']])->parameters([
    'puntosAtencion' => 'puntoAtencion',
    'periodos' => 'periodo'
]);
