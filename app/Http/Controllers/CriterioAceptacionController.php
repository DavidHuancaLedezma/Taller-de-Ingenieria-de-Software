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
