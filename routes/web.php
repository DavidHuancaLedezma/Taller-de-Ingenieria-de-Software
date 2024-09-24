<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('/grupo_empresa/registroGE');
});
use Illuminate\Support\Facades\DB;
Route::get('/test-db', function () {
    try {
        $results = DB::select('SELECT version()');
        return $results;
    } catch (\Exception $e) {
        return 'Error de conexión: ' . $e->getMessage();
    }
});
use App\Http\Controllers\GrupoEmpresaController;

Route::get('/registro-grupo-empresa', [GrupoEmpresaController::class, 'showForm']);
Route::get('/registro-grupo-empresa', [GrupoEmpresaController::class, 'create'])->name('grupo_empresa.create');
Route::post('/registro-grupo-empresa/store', [GrupoEmpresaController::class, 'store'])->name('grupo_empresa.store');
Route::get('/registro-grupo-empresa/success', [GrupoEmpresaController::class, 'success'])->name('grupo_empresa.success');
