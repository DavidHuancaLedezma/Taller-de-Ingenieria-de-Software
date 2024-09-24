<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hito;
use App\Models\Objetivo;
use Illuminate\Support\Facades\DB;

class ObjetivoController extends Controller
{
        // Mostrar el formulario de creación de objetivos
    public function create()
    {
            // Obtener todos los hitos desde la base de datos para el desplegable
        $hitos = DB::select("SELECT h.id_hito, h.numero_hito, h.fecha_inicio_hito, h.fecha_fin_hito FROM hito h, proyecto pr WHERE h.id_proyecto = pr.id_proyecto AND pr.id_proyecto = 1");
        
            // Pasamos los hitos a la vista de registro_objetivo.blade.php
        return view('registro_objetivo', compact('hitos'));
    }
        
    public function store(Request $request)
{
    $hito = Hito::find($request->input('hito'));
    // Validar los datos del formulario
    $request->validate([
        'objetivo' => 'required|string|max:255',
        'hito' => 'required|exists:hito,id_hito', // Verifica que el hito exista
        'prioridad' => 'required|in:Alta,Media,Baja',
        'fecha_inicio' => 'required|date',
        'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
    ]);

       // Ejecutar la consulta para insertar el objetivo
       $inserted = DB::insert("INSERT INTO objetivo (descrip_objetivo, id_hito, id_proyecto, prioridad, fecha_ini_objetivo, fecha_fin_objetivo) 
       VALUES (?, ?, ?, ?, ?, ?)", [
            $request->input('objetivo'),
            $request->input('hito'),
            1, // Valor por defecto para id_proyecto
            $request->input('prioridad'),
            $request->input('fecha_inicio'),
            $request->input('fecha_fin'),
        ]);


    // Verificar si la inserción fue exitosa
    if ($inserted) {
        return redirect()->route('registro_objetivo')->with('success', 'Objetivo registrado correctamente.');
    } else {
        return redirect()->route('registro_objetivo')->with('error', 'Error al registrar el objetivo.');
    }
}

}
