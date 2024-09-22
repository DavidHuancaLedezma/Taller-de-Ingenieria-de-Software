<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerTablaPlanificacion;
use App\Http\Controllers\ControllerSeguimientoSemanal;
use App\Http\Controllers\ControllerObjetivos;

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

Route::get('/', [ControllerTablaPlanificacion::class, 'getTabla']);

//Rutas para seguimiento semanal
Route::post('/seguimiento_semanal', [ControllerSeguimientoSemanal::class, 'cargarSS']);
Route::post('/registro_seguimiento_semanal', [ControllerSeguimientoSemanal::class, 'registroSemana']);
Route::post('/recuperar_seguimiento_semanal', [ControllerSeguimientoSemanal::class, 'recuperarSemana']);
Route::post('/actualizar_seguimiento_semanal', [ControllerSeguimientoSemanal::class, 'actualizarSemana']);

//Rutas para objetivos

Route::post('/cargar_objetivos', [ControllerObjetivos::class, 'cargarObjetivos']);
Route::post('/obtener_actividades', [ControllerObjetivos::class, 'getActividades']);

/*
Route::get('/', function () {
    return view('welcome');
});
*/
