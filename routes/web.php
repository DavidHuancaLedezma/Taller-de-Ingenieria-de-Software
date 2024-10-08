<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ControllerRegistroSemanalGE;
use App\Http\Controllers\ControllerVisualizarPlanillaDePlanificacion;
use App\Http\Controllers\ControllerPlanillaDelProyecto;

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


//registro del control semanal con asistencias
Route::get('/cargar_registro_semanal{parametroHito}', [ControllerRegistroSemanalGE::class, 'cargarRegistroSemanal']);
Route::post("/registrar_seguimiento", [ControllerRegistroSemanalGE::class, 'registrarSeguimiento']);

//visialización de la planilla de planificación
Route::get('/visualizar_planilla_de_planificacion/{idPlanillaProyecto}', [ControllerVisualizarPlanillaDePlanificacion::class, 'visualizarPlanilla']);
