<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actividad;

use Illuminate\Support\Facades\DB;

class ActividadController extends Controller

{
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'descripcion' => 'required|string|max:255', // Descripción de la actividad
            'resultado' => 'required|string|max:255', // Resultado esperado
            'usuario_id' => 'required|exists:usuario,id_usuario', // Verifica que el usuario exista
            'objetivo_id' => 'required|exists:objetivo,id_objetivo', // Verifica que el objetivo exista
            
        ]);
        // Verificar si ya existe una actividad con la misma descripción y resultado para el objetivo
        $existeActividad = DB::table('actividad')
            ->where('descripcion_actividad', $request->input('descripcion'))
            ->where('resultado', $request->input('resultado'))
            ->where('id_objetivo', $request->input('objetivo_id'))
            ->exists();  // Verifica si existe un registro que cumpla con estos criterios

        // Si ya existe, retornar con un mensaje de error
        if ($existeActividad) {
            return redirect()->back()->with('error', 'La actividad con este resultado ya existe para este objetivo.');
        }


        $realizado_ac = FALSE;
        // Ejecutar la consulta para insertar la actividad
        $inserted = DB::insert("INSERT INTO actividad (descripcion_actividad, resultado, realizado, id_usuario, id_objetivo) 
        VALUES (?, ?, ?, ?, ?)", [
            $request->input('descripcion'),   // Descripción de la actividad
            $request->input('resultado'),      // Resultado esperado
            $realizado_ac, 
            $request->input('usuario_id'),     // ID del estudiante seleccionado
            $request->input('objetivo_id'),    // ID del objetivo
        ]);
        if ($inserted) {
            return redirect()->back()->with('success', 'Actividad añadida correctamente.');
        } else {
            return redirect()->back()->with('error', 'Actividad no añadida correctamente.');
        }
        
    }
    
    

}
