<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerTablaPlanificacion;
use App\Http\Controllers\ControllerSeguimientoSemanal;
use App\Http\Controllers\ControllerObjetivos;

use App\Http\Controllers\ControllerRegistroSemanalGE;

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
//-------------------------------------------------------------------------------------------------------------
Route::get('/cargar_registro_semanal{parametroHito}', [ControllerRegistroSemanalGE::class, 'cargarRegistroSemanal']);
Route::post("/registrar_seguimiento", [ControllerRegistroSemanalGE::class, 'registrarSeguimiento']);
//-------------------------------------------------------------------------------------------------------------
