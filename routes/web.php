<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\ControllerTablaPlanificacion;
use App\Http\Controllers\ControllerSeguimientoSemanal;
use App\Http\Controllers\ObjetivoController;
use App\Http\Controllers\ActividadController;
use App\Http\Controllers\CriterioAceptacionController;


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



Route::get('/registro_actividad_criterioAcep/{id_objetivo}', [ObjetivoController::class, 'registroActividadCriterio'])->name('registro_actividad_criterioAcep');

// Ruta para añadir actividad
Route::post('/actividad/store', [ActividadController::class, 'store'])->name('actividad.store');

// Ruta para añadir criterio de aceptación
Route::post('/criterio_aceptacion/store', [CriterioAceptacionController::class, 'store'])->name('criterio_aceptacion.store');
