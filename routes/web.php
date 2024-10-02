<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerTablaPlanificacion;
use App\Http\Controllers\ControllerSeguimientoSemanal;
use App\Http\Controllers\HitoController;

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
Route::post('/seguimiento_semanal', [ControllerSeguimientoSemanal::class, 'cargarSS']);

Route::post('/registro_seguimiento_semanal', [ControllerSeguimientoSemanal::class, 'registroSemana']);

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/registro_hitos/{id_proyecto}', [HitoController::class, 'registroHitos'])->name('proyecto.hitos');

Route::post('/hitos/store/{id_proyecto}', [HitoController::class, 'store'])->name('hitos.store');
