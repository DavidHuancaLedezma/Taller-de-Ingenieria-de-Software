<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\ControllerTablaPlanificacion;
use App\Http\Controllers\ControllerSeguimientoSemanal;

use App\Http\Controllers\ObjetivoController;
use App\Http\Controllers\ActividadController;
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

//Route::get('/', [ControllerTablaPlanificacion::class, 'getTabla']);
Route::post('/seguimiento_semanal', [ControllerSeguimientoSemanal::class, 'cargarSS']);

Route::post('/registro_seguimiento_semanal', [ControllerSeguimientoSemanal::class, 'registroSemana']);


Route::get('/', function () {
    return view('/grupo_empresa/registroGE');
});

Route::get('/estudiante', function () {
    return view('/grupo_empresa/registroEstudiante');
});

Route::get('/docente', function () {
    return view('/docente/registroDocente');
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

//Ruta para la visualizacion de añadir actividad y criterio de aceptación
Route::get('/actividad_criterioAceptacion/{id_objetivo}', [ObjetivoController::class, 'registroActividadCriterio'])->name('registro_actividad_criterioAcep');

// Ruta para añadir actividad
Route::post('/actividad/store', [ActividadController::class, 'store'])->name('actividad.store');

// Ruta para añadir criterio de aceptación
Route::post('/criterio_aceptacion/store', [CriterioAceptacionController::class, 'store'])->name('criterio_aceptacion.store');


Route::get('/registro_hitos/{id_proyecto}', [HitoController::class, 'registroHitos'])->name('proyecto.hitos');

Route::post('/hitos/store/{id_proyecto}', [HitoController::class, 'store'])->name('hitos.store');


