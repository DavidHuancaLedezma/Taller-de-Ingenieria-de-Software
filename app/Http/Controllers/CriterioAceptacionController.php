<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CriterioAceptacion;

use Illuminate\Support\Facades\DB;


class CriterioAceptacionController extends Controller
{
    public function registroCriterio($id_objetivo)
    {
        // Obtener el objetivo junto con su descripción
        $objetivo = DB::table('objetivo')
                    ->select('id_objetivo', 'descrip_objetivo') // Seleccionar ambos campos
                    ->where('id_objetivo', $id_objetivo)
                    ->first(); // Obtiene el primer resultado como un objeto

         // Asegurarse de que el objetivo existe
         if (!$objetivo) {
            return redirect()->back()->withErrors('El Entregable no existe.');
        }

                
        // Obtener los criterios de aceptación relacionados con el objetivo
        $criterios_aceptacion = DB::table('criterio_aceptacion')
                    ->where('id_objetivo', $id_objetivo)
                    ->select('descripcion_ca')
                    ->get();

      
        // Pasar las actividades, criterios de aceptación y estudiantes a la vista
        //return view('criterioAceptacion', compact('objetivo','criterios_aceptacion'));
        return response()->json([
            'objetivo' => $objetivo,
            'criterios_aceptacion' => $criterios_aceptacion,
           
        ]);


    }

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
            //return redirect()->back()->with('error', 'El criterio de aceptación ya existe para este objetivo.');
            return response()->json(['error' => 'El criterio de aceptación ya existe para este entregable.'], 400);
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
            //return redirect()->back()->with('success', 'Criterio de aceptación añadido correctamente.');
            return response()->json(['success' => 'Criterio de aceptación añadido correctamente.']);
        } else {
            //return redirect()->back()->with('error', 'Error al añadir el criterio de aceptación.');
            return response()->json(['error' => 'Error al añadir el criterio de aceptación.'], 500);
        }
    
    }

}
