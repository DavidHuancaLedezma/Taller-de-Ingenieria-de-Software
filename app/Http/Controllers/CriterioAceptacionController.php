<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CriterioAceptacion;

use Illuminate\Support\Facades\DB;


class CriterioAceptacionController extends Controller
{
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'objetivo_id' => 'required|exists:objetivo,id_objetivo', // Verifica que el objetivo exista
            'descripcionCriterio' => 'required|string|max:255', // Descripción del criterio de aceptación
        ]);

         // Verificar si ya existe un criterio de aceptación con la misma descripción para el objetivo
        $existeCriterio = DB::table('criterio_aceptacion')
         ->where('id_objetivo', $request->input('objetivo_id'))
         ->where('descripcion_ca', $request->input('descripcionCriterio'))
         ->exists(); // Verifica si ya existe

        // Si ya existe, retornar con un mensaje de error
        if ($existeCriterio) {
            return redirect()->back()->with('error', 'El criterio de aceptación ya existe para este objetivo.');
        }
        $cumplido_ca = FALSE;
        // Ejecutar la consulta para insertar el criterio de aceptación
        $inserted = DB::insert("INSERT INTO criterio_aceptacion (id_objetivo, descripcion_ca, cumplido) 
        VALUES (?, ?, ?)", [
            $request->input('objetivo_id'),       // ID del objetivo
            $request->input('descripcionCriterio'), // Descripción del criterio
            $cumplido_ca,
        ]);

        // Verificar si la inserción fue exitosa
        if ($inserted) {
            return redirect()->back()->with('success', 'Criterio de aceptación añadido correctamente.');
        } else {
            return redirect()->back()->with('error', 'Error al añadir el criterio de aceptación.');
        }
    
    }

}
