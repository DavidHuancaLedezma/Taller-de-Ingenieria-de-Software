<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\ControllerTablaPlanificacion;
use App\Http\Controllers\ControllerSeguimientoSemanal;
use App\Http\Controllers\ObjetivoController;

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

//Route::get('/', [ControllerTablaPlanificacion::class, 'getTabla']);
Route::post('/seguimiento_semanal', [ControllerSeguimientoSemanal::class, 'cargarSS']);

Route::post('/registro_seguimiento_semanal', [ControllerSeguimientoSemanal::class, 'registroSemana']);


Route::get('/', function () {
    return view('welcome');
});

/*Route::get('/registro_objetivo', function () {
    return view('registro_objetivo');
});*/

// Ruta para la vista de registro de objetivo (usando registro_objetivo.blade.php)
Route::get('/registro_objetivo', [ObjetivoController::class, 'create'])->name('registro_objetivo');

// Ruta para almacenar el nuevo objetivo
Route::post('/objetivo/store', [ObjetivoController::class, 'store'])->name('objetivo.store');
