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
    return view('/Inicio');
});

Route::get('/estudiante', function () {
    return view('/grupo_empresa/registroEstudiante');
});

Route::get('/docente', function () {
    return view('/docente/registroDocente');
});



Route::get('/evaluacion_pares/{idEvaluacionPares}', [EvaluacionParesController::class, 'evaluacionPares']);

Route::post('/guardar_nota_evaluacion_pares',[EvaluacionParesController::class,'guardarNotaEstudiantes']);



Route::post('/guardar-nota-pares', [EvaluacionParesController::class, 'guardarNotaPares'])->name('guardar.nota.pares');
// Ruta para mostrar la evaluación de un estudiante 
Route::get('/evaluacionPares/{id}/evaluar', [EvaluacionParesController::class, 'evaluarEstudiante'])->name('evaluar.estudiante');
Route::post('/obtener_criterios_y_parametros', [EvaluacionParesController::class, 'getCriteriosParametros']);


use App\Http\Controllers\GrupoEmpresaController;

Route::get('/registro-grupo-empresa', [GrupoEmpresaController::class, 'showForm']);
Route::get('/registro-grupo-empresa', [GrupoEmpresaController::class, 'create'])->name('grupo_empresa.create');
Route::post('/registro-grupo-empresa/store', [GrupoEmpresaController::class, 'store'])->name('grupo_empresa.store');
Route::get('/registro-grupo-empresa/success', [GrupoEmpresaController::class, 'success'])->name('grupo_empresa.success');



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
Route::get('/evaluacion_cruzada/{idGrupoEmpresa}', [ControllerEvaluacionCruzada::class, 'evaluacionCruzada']);

//Rutas extras para el funcionamiento de evaluaciones
Route::post('/guardar_nota_autoevaluacion', [ControllerAutoevaluacion::class, 'registroNota']);
Route::post('/obtener_criterios_y_parametros', [ControllerEvaluacionCruzada::class, 'getCriteriosParametros']);
Route::post('/guardar_nota_evaluacion_cruzada', [ControllerEvaluacionCruzada::class, 'guardarNotaGrupoEmpresas']);


//HOME estudiante
Route::get('/estudiante_home/{idEstudiante}', [ControllerHome::class, 'openHome']);

//Home docente
Route::get('/docente_home/{idDocente}', [ControllerHomeDocente::class, 'openHomeDocente']);

use App\Http\Controllers\InicioController;

//Route::get('/inicio', [InicioController::class, 'index'])->name('inicio');
//Route ::get('/estudiante/estudiante',[InicioController::class,'registrarse'])->name('estudiante.estudiante');
Route ::get('/login',[LoginController::class,'VeriniciarSesion'])->name('login');
Route::post('/obtener_criterios_y_parametros', [EvaluacionParesController::class, 'getCriteriosParametros']);

//Login
use App\Http\Controllers\RegistroEstudianteController;
// Ruta para mostrar el formulario de registro
Route::get('/registro-estudiante', [RegistroEstudianteController::class, 'create'])->name('registro_estudiante.form');

// Ruta para manejar el envío del formulario de registro
Route::post('/registro-estudiante', [RegistroEstudianteController::class, 'store'])->name('registro_estudiante.store');
Route::get('/registro-estudiante', [RegistroEstudianteController::class, 'create'])->name('registro_estudiante.create');//ver registroEst
//
Route::post('/login', [LoginController::class, 'iniciarSesion']); //ver  login
Route::post('/logout', [LoginController::class, 'cerrarSesion'])->name('logout'); // Cierra la sesión

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard'); // Protege la ruta del dashboard con middleware de autenticación
