<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Route;


use App\Http\Controllers\ControllerRegistroSemanalGE;
use App\Http\Controllers\ControllerVisualizarPlanillaDePlanificacion;
use App\Http\Controllers\ControllerPlanillaDelProyecto;

//use App\Http\Controllers\ControllerTablaPlanificacion;
use App\Http\Controllers\ControllerSeguimientoSemanal;


use App\Http\Controllers\ObjetivoController;
use App\Http\Controllers\ActividadController;
use App\Http\Controllers\ControllerAutoevaluacion;
use App\Http\Controllers\ControllerEvaluacionCruzada;
use App\Http\Controllers\ControllerHome;
use App\Http\Controllers\ControllerHomeDocente;
use App\Http\Controllers\CriterioAceptacionController;

use App\Http\Controllers\HitoController;
//use App\Http\Controllers\FinalHitoController;
use App\Http\Controllers\EvaluacionFinHitoController;
use App\Http\Controllers\PlanillaPlanificacionController;
use App\Http\Controllers\PlanillaEvaluacionController;

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
//NOTA IMPORTANTE: la url /cargar_registro_semanal no funciona si se coloca / para los parametros(se tiene que sustituir el / con _ )
Route::get('/cargar_registro_semanal{parametroHito}_{idDocente}', [ControllerRegistroSemanalGE::class, 'cargarRegistroSemanal']);
Route::post('/obtener_id_hito_grupo_empresa_combo_box', [ControllerRegistroSemanalGE::class, 'getIdHitoComboxSeleccionado']);
Route::post("/registrar_seguimiento", [ControllerRegistroSemanalGE::class, 'registrarSeguimiento']);


//visialización de la planilla de planificación
Route::get('/visualizar_planilla_de_planificacion/{idPlanillaProyecto}/{idDocente}', [ControllerVisualizarPlanillaDePlanificacion::class, 'visualizarPlanilla']);
Route::post('/obtener_id_proyecto_de_grupo_empresa', [ControllerVisualizarPlanillaDePlanificacion::class, 'getIdProyectoDeGrupoEmpresa']);


Route::get('/', function () {
    return view('/Inicio');
})->name('inicio');

Route::get('/estudiante', function () {
    return view('/grupo_empresa/registroEstudiante');
});

Route::get('/docente', function () {
    return view('/docente/registroDocente');
});


// Ruta para mostrar la evaluación de un estudiante
Route::get('/evaluacionPares/{id}/evaluar', [EvaluacionParesController::class, 'evaluarEstudiante'])->name('evaluar.estudiante');
Route::post('/validacion_fechas_evaluacion_pares', [EvaluacionParesController::class, 'validacionFechasEvaluacionPares']);
Route::get('/evaluacion_pares/{idEvaluacionPares}', [EvaluacionParesController::class, 'evaluacionPares']);
Route::post('/guardar_nota_evaluacion_pares',[EvaluacionParesController::class,'guardarNotaEstudiantes']);

use App\Http\Controllers\GrupoEmpresaController;

Route::get('/registro-grupo-empresa', [GrupoEmpresaController::class, 'showForm']);
Route::get('/registro-grupo-empresa', [GrupoEmpresaController::class, 'create'])->name('grupo_empresa.create');
Route::post('/registro-grupo-empresa/store', [GrupoEmpresaController::class, 'store'])->name('grupo_empresa.store');
Route::get('/registro-grupo-empresa/success', [GrupoEmpresaController::class, 'success'])->name('grupo_empresa.success');

use App\Http\Controllers\RegistroEstudianteController;
// Ruta para mostrar el formulario de registro
Route::get('/registro-estudiante', [RegistroEstudianteController::class, 'create'])->name('registro_estudiante.form');

// Ruta para manejar el envío del formulario de registro
Route::post('/registro-estudiante', [RegistroEstudianteController::class, 'store'])->name('registro_estudiante.store');
Route::get('/registro-estudiante', [RegistroEstudianteController::class, 'create'])->name('registro_estudiante.create');

// Ruta para redirigir en caso de éxito (puedes cambiar el nombre a success2 si lo prefieres)
Route::get('/registro-success', function () {
    return view('success2'); // Asegúrate de tener una vista 'success2.blade.php'
})->name('registro.success');


use App\Http\Controllers\RegistroDocenteController;

// Ruta para mostrar el formulario
Route::get('/registro-docente', [RegistroDocenteController::class, 'create'])->name('registro_docente.create');

// Ruta para procesar el formulario
Route::post('/registro-docente', [RegistroDocenteController::class, 'store'])->name('registro_docente.store');

// Ruta para la vista de éxito después de registrar un docente
Route::get('/registro-docente-success', function () {
    return view('success'); // Vista de éxito para docentes
})->name('registro_docente.success');


// Ruta para la vista de registro de objetivo (usando registro_objetivo.blade.php)
//Route::get('/registro_objetivo', [ObjetivoController::class, 'create'])->name('registro_objetivo');
Route::get('/registro_objetivo/{id_proyecto}', [ObjetivoController::class, 'create'])->name('registro_objetivo');


// Ruta para almacenar el nuevo objetivo
Route::post('/objetivo/store', [ObjetivoController::class, 'store'])->name('objetivo.store');

//Ruta para la visualizacion de añadir actividad
Route::get('/actividad/{id_objetivo}', [ObjetivoController::class, 'registroActividadCriterio'])->name('registro_actividad_criterioAcep');

//Ruta para la visualizacion de añadir criterio de aceptación
Route::get('/criterioAceptacion/{id_objetivo}', [CriterioAceptacionController::class, 'registroCriterio'])->name('registro_criterioAcep');

// Ruta para añadir actividad
Route::post('/actividad/store', [ActividadController::class, 'store'])->name('actividad.store');

// Ruta para añadir criterio de aceptación
Route::post('/criterio_aceptacion/store', [CriterioAceptacionController::class, 'store'])->name('criterio_aceptacion.store');


Route::get('/registro_hitos/{id_proyecto}', [HitoController::class, 'registroHitos'])->name('proyecto.hitos');

Route::post('/hitos/store/{id_proyecto}', [HitoController::class, 'store'])->name('hitos.store');


//Ruta para la visualizacion de evaluacion final de hito
Route::get('/evaluacion_final_hito/{id_hito}', [ControllerRegistroSemanalGE::class, 'cargarRegistroSemanal']);
//Route::post('/guardar_evaluacion_hito/{id_hito}', [FinalHitoController::class, 'registrarFinHito'])->name('guardar_evaluacion_hito');
Route::post('/finHito/store/{id_hito}', [EvaluacionFinHitoController::class, 'store'])->name('finHito.store');

//Tipo de Evaluaciones 
Route::get('/autoevaluacion/{idEstudiante}', [ControllerAutoevaluacion::class, 'autoevaluacion']);
Route::get('/evaluacion_cruzada/{idGrupoEmpresa}/{idEstudiante}', [ControllerEvaluacionCruzada::class, 'evaluacionCruzada']);

//Rutas extras para el funcionamiento de evaluaciones
Route::post('/guardar_nota_autoevaluacion', [ControllerAutoevaluacion::class, 'registroNota']);
Route::post('/obtener_criterios_y_parametros_dj', [ControllerEvaluacionCruzada::class, 'getCriteriosParametros']);
Route::post('/guardar_nota_evaluacion_cruzada', [ControllerEvaluacionCruzada::class, 'guardarNotaGrupoEmpresas']);
Route::post('/fechas_validas_de_evaluacion_cruzada', [ControllerEvaluacionCruzada::class, 'rangoFechasEvaluacionCruzada']);


// HOME estudiante
Route::get('/estudiante_home/{idEstudiante}', [ControllerHome::class, 'openHome'])
    ->name('estudiante_home');

// HOME docente
Route::get('/docente_home/{idDocente}', [ControllerHomeDocente::class, 'openHomeDocente'])
    ->name('docente_home');


Route::view('/planilla-planificacion', 'planilla_planificacion.h_planilla_planificacion');
Route::view('/criterioAceptacion', 'planilla_planificacion.criterioAceptacion_select');

Route::get('/planilla_planificacion_actividad/{id_proyecto}', [PlanillaPlanificacionController::class, 'create_actividad']);
Route::get('/get-entregables', [PlanillaPlanificacionController::class, 'getEntregablesPorHito'])->name('get.entregables');
Route::get('/entregable-data/{id_objetivo}', [PlanillaPlanificacionController::class, 'getEntregableData'])->name('get.entregableData');

Route::get('/actividades/{id_objetivo}', [PlanillaPlanificacionController::class, 'getActividadesPorEntregable'])->name('get.actividades');

Route::get('/planilla_planificacion_criterio_aceptacion/{id_proyecto}', [PlanillaPlanificacionController::class, 'create_criterio_aceptacion']);

Route::get('/planilla_evaluacion/{id_docente}', [PlanillaEvaluacionController::class, 'create']);
Route::post('/planilla_evaluacion/store', [PlanillaEvaluacionController::class, 'store'])->name('planilla_evaluacion.store');

Route::get('/get-empresas-por-evaluacion/{id_tipo_evaluacion}/{id_docente}', [PlanillaEvaluacionController::class, 'getEmpresasPorEvaluacion']);

//Rutas del login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/obtener_criterios_y_parametros', [EvaluacionParesController::class, 'getCriteriosParametros']);
