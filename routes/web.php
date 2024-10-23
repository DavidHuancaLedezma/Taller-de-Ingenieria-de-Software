<?php

use App\Http\Controllers\Controller;
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


Route::get('/', function () {
    return view('/grupo_empresa/registroGE');
});

Route::get('/estudiante', function () {
    return view('/grupo_empresa/registroEstudiante');
});
Route::get('/objetivos', function () {
    return view('/objetivos/visualizarObjetivos');
});

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



// Ruta para la vista de registro de objetivo (usando registro_objetivo.blade.php)
//Route::get('/registro_objetivo', [ObjetivoController::class, 'create'])->name('registro_objetivo');
Route::get('/registro_objetivo/{id_proyecto}', [ObjetivoController::class, 'create'])->name('registro_objetivo');


// Ruta para almacenar el nuevo objetivo
Route::post('/objetivo/store', [ObjetivoController::class, 'store'])->name('objetivo.store');

//Ruta para la visualizacion de añadir actividad y criterio de aceptación
Route::get('/actividad_criterioAceptacion/{id_objetivo}', [ObjetivoController::class, 'registroActividadCriterio'])->name('registro_actividad_criterioAcep');

// Ruta para añadir actividad
Route::post('/actividad/store', [ActividadController::class, 'store'])->name('actividad.store');

// Ruta para añadir criterio de aceptación
Route::post('/criterio_aceptacion/store', [CriterioAceptacionController::class, 'store'])->name('criterio_aceptacion.store');


Route::get('/registro_hitos/{id_proyecto}', [HitoController::class, 'registroHitos'])->name('proyecto.hitos');

Route::post('/hitos/store/{id_proyecto}', [HitoController::class, 'store'])->name('hitos.store');

//Tipo de Evaluaciones 
Route::get('/autoevaluacion/{idEstudiante}', [ControllerAutoevaluacion::class, 'autoevaluacion']);
Route::get('/evaluacion_cruzada/{idGrupoEmpresa}', [ControllerEvaluacionCruzada::class, 'evaluacionCruzada']);

//Rutas extras para el funcionamiento de evaluaciones
Route::post('/guardar_nota_autoevaluacion', [ControllerAutoevaluacion::class, 'registroNota']);
Route::post('/obtener_criterios_y_parametros', [ControllerEvaluacionCruzada::class, 'getCriteriosParametros']);
Route::post('/guardar_nota_evaluacion_cruzada', [ControllerEvaluacionCruzada::class, 'guardarNotaGrupoEmpresas']);


//HOME estudiante
Route::get('/estudiante_home/{idEstudiante}', [ControllerHome::class, 'openHome']);

//Home docente
Route::get('/docente_home/{idDocente}', [ControllerHomeDocente::class, 'openHomeDocente']);
