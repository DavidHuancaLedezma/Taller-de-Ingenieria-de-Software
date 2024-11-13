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
       // Verificar si ya existe una descripción de actividad con un resultado diferente para el mismo objetivo
        $existeDescripcionConDiferenteResultado = DB::table('actividad')
            ->where('descripcion_actividad', $request->input('descripcion'))
            ->where('resultado', '!=', $request->input('resultado'))
            ->where('id_objetivo', $request->input('objetivo_id'))
            ->exists();
       // Verificar si ya existe un resultado esperado con una descripción diferente para el mismo objetivo
        $existeResultadoConDiferenteDescripcion = DB::table('actividad')
            ->where('resultado', $request->input('resultado'))
            ->where('id_objetivo', $request->input('objetivo_id'))
            ->where('descripcion_actividad', '!=', $request->input('descripcion'))
            ->exists();
        // Si ya existe, retornar con un mensaje de error
        if ($existeActividad) {
            //return redirect()->back()->with('error', 'La actividad con este resultado ya existe para este objetivo.');
            return response()->json(['error' => 'La actividad con este resultado ya existe para este entregable.'], 500);
        }
        // Si ya existe una descripción con un resultado diferente, retornar con un mensaje de error
        if ($existeDescripcionConDiferenteResultado) {
            //return redirect()->back()->with('error', 'Ya existe una actividad con esta descripción para este objetivo.');
            return response()->json(['error' => 'Ya existe una actividad con esta descripción para este entregable.'], 500);
        }
        if ($existeResultadoConDiferenteDescripcion) {
            //return redirect()->back()->with('error', 'El resultado esperado ya está asociado a otra actividad para este objetivo.');
            return response()->json(['error' => 'El resultado esperado ya está asociado a otra actividad para este entregable.'], 500);
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
            //return redirect()->back()->with('success', 'Actividad añadida correctamente.');
            return response()->json(['success' => 'Actividad añadida correctamente.']);

        } else {
            //return redirect()->back()->with('error', 'Actividad no añadida correctamente.');
            return response()->json(['error' => 'Error al añadir la actividad.'], 500);
        }
        
    }
    
    

}
