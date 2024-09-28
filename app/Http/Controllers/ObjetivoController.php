<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hito;
use App\Models\Objetivo;
use Illuminate\Support\Facades\DB;

class ObjetivoController extends Controller
{
        // Mostrar el formulario de creación de objetivos
   /* public function create()
    {
            // Obtener todos los hitos desde la base de datos para el desplegable
        $hitos = DB::select("SELECT h.id_hito, h.numero_hito, h.fecha_inicio_hito, h.fecha_fin_hito FROM hito h, proyecto pr WHERE h.id_proyecto = pr.id_proyecto AND pr.id_proyecto = 1");
        
            // Pasamos los hitos a la vista de registro_objetivo.blade.php
        return view('registro_objetivo', compact('hitos'));
    }*/
    public function create($id_proyecto)
    {
        // Validar que el proyecto exista
        $proyecto = DB::table('proyecto')->where('id_proyecto', $id_proyecto)->first();
        if (!$proyecto) {
            return redirect()->back()->withErrors('El proyecto no existe.');
        }

        // Obtener los hitos asociados al proyecto
        $hitos = DB::select("
            SELECT h.id_hito, h.numero_hito, h.fecha_inicio_hito, h.fecha_fin_hito 
            FROM hito h
            WHERE h.id_proyecto = ?", [$id_proyecto]);

        // Pasar los hitos a la vista de registro_objetivo.blade.php
        return view('registro_objetivo', compact('hitos', 'id_proyecto'));
    }

        
    public function store(Request $request)
{
   // dd($request->all());
   // $hito = Hito::find($request->input('hito'));
    // Validar los datos del formulario
    $request->validate([
        //'id_proyecto_ob' => 'required|integer|exists:proyecto,id_proyecto', 
        'objetivo' => 'required|string|max:255',
        //'hito' => 'required|exists:hito,id_hito', // Verifica que el hito exista
        //'id_proyecto' => 'required|exists:proyecto,id_proyecto',
        'hito' => 'required|integer|exists:hito,id_hito',
           
        'prioridad' => 'required|in:Alta,Media,Baja',
        'fecha_inicio' => 'required|date',
        'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
    ]);
    
    if (is_array($request->input('objetivo'))) {
        return redirect()->back()->withErrors(['objetivo' => 'El objetivo no debe ser un array.']);
    }
    
       // Ejecutar la consulta para insertar el objetivo
       $inserted = DB::insert("INSERT INTO objetivo (descrip_objetivo, id_hito, id_proyecto, prioridad, fecha_ini_objetivo, fecha_fin_objetivo) 
       VALUES (?, ?, ?, ?, ?, ?)", [
            //$request->input('id_proyecto_ob'),
            $request->input('objetivo'),
            $request->input('hito'),
            1, // Valor por defecto para id_proyecto
            
            $request->input('prioridad'),
            $request->input('fecha_inicio'),
            $request->input('fecha_fin'),
        ]);


    // Verificar si la inserción fue exitosa
    if ($inserted) {
        //return redirect()->route('registro_objetivo')->with('success', 'Objetivo registrado correctamente.');
        return redirect()->back()->with('success', 'Objetivo registrado correctamente');
    } else {
        return redirect()->back()->with('error', 'Error al registrar el objetivo.');
    }
}

    public function registroActividadCriterio($id_objetivo)
    {
        // Obtener el objetivo junto con su descripción
        $objetivo = DB::table('objetivo')
                    ->select('id_objetivo', 'descrip_objetivo') // Seleccionar ambos campos
                    ->where('id_objetivo', $id_objetivo)
                    ->first(); // Obtiene el primer resultado como un objeto

         // Asegurarse de que el objetivo existe
         if (!$objetivo) {
            return redirect()->back()->withErrors('El objetivo no existe.');
        }

        // Implementación de la consulta solicitada con el constructor de consultas de Laravel
        $estudiantes = DB::table('estudiante')
                        ->join(DB::raw('(select eg.id_usuario
                                        from estudiante_grupoempresa eg
                                        join (
                                            select id_grupo_empresa
                                            from proyecto
                                            join (
                                                select id_proyecto
                                                from objetivo
                                                where objetivo.id_objetivo = ?
                                            ) e on proyecto.id_proyecto = e.id_proyecto
                                        ) b on eg.id_grupo_empresa = b.id_grupo_empresa) a'), 'a.id_usuario', '=', 'estudiante.id_usuario')
                        ->select('estudiante.id_usuario', 'estudiante.nombre_estudiante')
                        ->setBindings([$id_objetivo]) // Pasar el valor de $id_objetivo al query
                        ->get();

                
            // Obtener las actividades relacionadas con el objetivo
        $actividades = DB::table('actividad')
            ->where('id_objetivo', $id_objetivo)
            ->select('descripcion_actividad', 'resultado', 'id_usuario')
            ->get();

        // Obtener los criterios de aceptación relacionados con el objetivo
        $criterios_aceptacion = DB::table('criterio_aceptacion')
                    ->where('id_objetivo', $id_objetivo)
                    ->select('descripcion_ca')
                    ->get();

        // Si no hay estudiantes, podríamos manejarlo con un mensaje
        if ($estudiantes->isEmpty()) {
        return redirect()->back()->withErrors('No hay estudiantes relacionados con este objetivo.');
        }

        // Pasar las actividades, criterios de aceptación y estudiantes a la vista
        return view('actividad_criterioAceptacion', compact('objetivo', 'estudiantes', 'actividades', 'criterios_aceptacion'));

        //return view('actividad_criterioAceptacion', compact('objetivo'));
    }

}
