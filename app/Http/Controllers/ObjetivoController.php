<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hito;
use App\Models\Objetivo;
use Illuminate\Support\Facades\DB;

class ObjetivoController extends Controller
{
       
    public function create($id_estudiante)
    {
        // Validar que el proyecto exista
        $id_proyecto = $this->get_idProyecto ($id_estudiante);
         //$proyecto = DB::table('proyecto')->where('id_proyecto', $id_proyecto)->first();
         if (!$id_proyecto) {
             return redirect()->back()->withErrors('El proyecto no existe.');
         }
        // Obtener la fecha actual
        $fecha_actual = now(); // Obtiene la fecha y hora actua
        // Obtener los hitos asociados al proyecto
        $hitos = DB::select("
            SELECT h.id_hito, h.numero_hito, h.fecha_inicio_hito, h.fecha_fin_hito 
            FROM hito h
            WHERE h.id_proyecto = ? AND h.fecha_fin_hito >= ?", [$id_proyecto, $fecha_actual]);
        // Pasar los hitos a la vista de registro_objetivo.blade.php
        return view('registro_objetivo', compact('hitos', 'id_proyecto', 'id_estudiante'));
    }
    private function get_idProyecto($id_estudiante){
        $respuesta = DB::select(
            "SELECT pr.id_proyecto
             FROM proyecto pr, estudiante es, estudiante_grupoempresa egr, grupo_empresa ge
             WHERE es.id_usuario = egr.id_usuario 
             AND egr.id_grupo_empresa = ge.id_grupo_empresa 
             AND ge.id_grupo_empresa = pr.id_grupo_empresa 
             AND es.id_usuario = ?", [$id_estudiante]
        );
        
        // Verifica si la consulta devolvió resultados
        if (!empty($respuesta)) {
            // Extraer `id_proyecto` del primer resultado
            return $respuesta[0]->id_proyecto;
        } else {
            return null; // Retorna null si no hay resultados
        }
        
    }
        
    public function store(Request $request)
{
   
    // Validar los datos del formulario
    $request->validate([
        //'id_proyecto_ob' => 'required|integer|exists:proyecto,id_proyecto', 
        'objetivo' => 'required|string|max:255',
        'proyecto_id' => 'required|integer|exists:proyecto,id_proyecto', // Asegúrate de que esto esté presente
        'hito' => 'required|integer|exists:hito,id_hito', 
        
        'fecha_inicio' => 'required|date',
        'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
    ]);
    
    // Verificar si ya existe un objetivo con el mismo id_proyecto e id_hito
    $existeObjetivo = DB::table('objetivo')
        ->where('descrip_objetivo', $request->input('objetivo'))
        //->where('id_proyecto', $request->input('proyecto_id'))
        ->where('id_hito', $request->input('hito'))
        ->exists(); // Verifica si ya existe

        // Si ya existe, retornar con un mensaje de error
    if ($existeObjetivo) {
        return redirect()->back()->with('error', 'Ya existe este entregable para este hito.');
    }
    if (is_array($request->input('objetivo'))) {
        return redirect()->back()->withErrors(['objetivo' => 'El entregable no debe ser un array.']);
    }

       // Ejecutar la consulta para insertar el objetivo
       $inserted = DB::insert("INSERT INTO objetivo (descrip_objetivo, id_hito, id_proyecto, entregado_ob, fecha_ini_objetivo, fecha_fin_objetivo) 
       VALUES (?, ?, ?, false, ?, ?)", [
            //$request->input('id_proyecto_ob'),
            $request->input('objetivo'),
            $request->input('hito'),
            $request->input('proyecto_id'),
            $request->input('fecha_inicio'),
            $request->input('fecha_fin'),
        ]);


    // Verificar si la inserción fue exitosa
    if ($inserted) {
        //return redirect()->route('registro_objetivo')->with('success', 'Objetivo registrado correctamente.');
        return redirect()->back()->with('success', 'Entregable registrado correctamente');
    } else {
        return redirect()->back()->with('error', 'Error al registrar el Entregable.');
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
            return redirect()->back()->withErrors('El Entregable no existe.');
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
        return view('actividad', compact('objetivo', 'estudiantes', 'actividades', 'criterios_aceptacion'));

        //return view('actividad_criterioAceptacion', compact('objetivo'));
    }
}
