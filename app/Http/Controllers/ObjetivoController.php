<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hito;
use App\Models\Objetivo;

class ObjetivoController extends Controller
{
    // Mostrar el formulario
    public function create()
    {
        // Obtener todos los hitos desde la base de datos para el desplegable
        $hitos = Hito::all();
        return view('objetivo.create', compact('hitos')); // Pasamos los hitos a la vista
    }

    // Guardar el objetivo
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'objetivo' => 'required|string|max:255',
            'hito' => 'required|exists:hito,id_hito', // Verifica que el hito exista
            'prioridad' => 'required|in:Alta,Media,Baja',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);

        // Crear el objetivo
        Objetivo::create([
            'nombre_objetivo' => $request->input('objetivo'),
            'id_hito' => $request->input('hito'),
            'prioridad' => $request->input('prioridad'),
            'fecha_inicio' => $request->input('fecha_inicio'),
            'fecha_fin' => $request->input('fecha_fin'),
        ]);

        // Redirigir con un mensaje de éxito
        return redirect()->route('objetivo.create')->with('success', 'Objetivo registrado correctamente.');
    }

}
