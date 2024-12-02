<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PlanillaPlanificacionController extends Controller
{
    public function create_actividad($id_estudiante)
    {
        $id_proyecto = $this->get_idProyecto($id_estudiante);
        
        if (!$id_proyecto) {
            return redirect()->back()->withErrors('El proyecto no existe.');
        }
        
        // Obtener la fecha actual
        $fecha_actual = now(); // Obtiene la fecha y hora actual
        
        // Consultar la etapa activa del proyecto
        $etapa_activa = DB::table('etapa')
            ->where('id_proyecto', $id_proyecto)
            ->where('etapa_activa', 1) // Filtra por etapa activa
            ->first();
        
        // Validar si la etapa activa es "Planificación" o "Desarrollo"
        if ($etapa_activa && in_array($etapa_activa->nombre_etapa, ['Planificación', 'Desarrollo'])) {
            
            // Obtener los hitos asociados al proyecto
            $hitos = DB::select("
                SELECT h.id_hito, h.numero_hito, h.fecha_inicio_hito, h.fecha_fin_hito 
                FROM hito h
                WHERE h.id_proyecto = ? AND h.fecha_fin_hito >= ?", [$id_proyecto, $fecha_actual]);
    
            // Obtener los entregables asociados al proyecto
            $entregables = DB::select("
                select id_hito, id_objetivo, descrip_objetivo
                from objetivo
                where id_proyecto =?", [$id_proyecto]);
    
            // Obtener los estudiantes asociados al proyecto
            $estudiantes = DB::select("
                select estudiante.id_usuario, estudiante.nombre_estudiante
                from estudiante, (
                    select eg.id_usuario
                    from estudiante_grupoempresa eg, 
                        (select id_grupo_empresa
                        from proyecto
                        where id_proyecto = ?) b
                    where eg.id_grupo_empresa = b.id_grupo_empresa
                ) a
                where estudiante.id_usuario = a.id_usuario", [$id_proyecto]);
            
            // Convertir el arreglo de estudiantes a una colección
            $estudiantes = collect($estudiantes);
    
            // Redirigir a la vista de añadir actividad
            return view('planilla_planificacion.actividad_select', compact('hitos', 'entregables', 'estudiantes', 'id_estudiante'));
        } else {
            // Si no está en "Planificación" o "Desarrollo", redirigir a la vista rangoEtapa.etapa
            $etapa_actual = DB::table('etapa')
                ->where('id_proyecto', $id_proyecto)
                ->where('nombre_etapa', 'Desarrollo') 
                ->first();
    
            $mensaje_inicio = 'La etapa de planificación del proyecto fue habilitada en las fechas:';
            $mensaje_error = 'El proyecto no está en la etapa de "Planificación" o "Desarrollo". No se pueden añadir actividades.';
            $fechas_etapa = $etapa_actual
                ? ['inicio' => $etapa_actual->fecha_inicio_etapa, 'fin' => $etapa_actual->fecha_fin_etapa] 
                : null;
    
            // Redirigir a la vista de rango de etapa con los mensajes y fechas
            return view('rangoEtapa.etapa', compact('mensaje_error', 'mensaje_inicio', 'fechas_etapa', 'id_estudiante'));
        }
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

    public function getEntregablesPorHito(Request $request)
    {
        $id_hito = $request->input('id_hito');

        // Obtener entregables del hito seleccionado
        $entregables = DB::select(
            "SELECT id_objetivo, descrip_objetivo
            FROM objetivo
            WHERE id_hito = ?", [$id_hito]);

        // Retornar los entregables como JSON
        return response()->json($entregables);
    }
    public function getEntregableData($id_objetivo)
    {
        // Obtener el objetivo junto con su descripción
        $objetivo = DB::table('objetivo')
                    ->select('id_objetivo', 'descrip_objetivo')
                    ->where('id_objetivo', $id_objetivo)
                    ->first();

        if (!$objetivo) {
            return response()->json(['error' => 'El Entregable no existe.'], 404);
        }

        // Obtener estudiantes relacionados
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
                        ->setBindings([$id_objetivo])
                        ->get();

        // Obtener actividades del objetivo
        $actividades = DB::table('actividad')
                        ->where('id_objetivo', $id_objetivo)
                        ->select('descripcion_actividad', 'resultado', 'id_usuario')
                        ->get();

        return response()->json([
            'objetivo' => $objetivo,
            'actividades' => $actividades,
            'estudiantes' => $estudiantes,
        ]);
    }
    public function getActividadesPorEntregable($id_objetivo)
    {
        $actividades = DB::table('actividad')
            ->where('id_objetivo', $id_objetivo)
            ->get();

        $estudiantes = DB::table('estudiante')->get();

        return response()->json(['actividades' => $actividades, 'estudiantes' => $estudiantes]);
    }

    // ------------ Criterio de Aceptacion-------------------------
    public function create_criterio_aceptacion($id_estudiante)
    {
        $id_proyecto = $this->get_idProyecto($id_estudiante);
        
        if (!$id_proyecto) {
            return redirect()->back()->withErrors('El proyecto no existe.');
        }
        
        // Obtener la fecha actual
        $fecha_actual = now(); // Obtiene la fecha y hora actual
        
        // Consultar la etapa activa del proyecto
        $etapa_activa = DB::table('etapa')
            ->where('id_proyecto', $id_proyecto)
            ->where('etapa_activa', 1) // Filtra por etapa activa
            ->first();
        
        // Validar si la etapa activa es "Planificación" o "Desarrollo"
        if ($etapa_activa && in_array($etapa_activa->nombre_etapa, ['Planificación', 'Desarrollo'])) {
            
            // Obtener los hitos asociados al proyecto
            $hitos = DB::select("
                SELECT h.id_hito, h.numero_hito, h.fecha_inicio_hito, h.fecha_fin_hito 
                FROM hito h
                WHERE h.id_proyecto = ? AND h.fecha_fin_hito >= ?", [$id_proyecto, $fecha_actual]);
    
            // Obtener los entregables asociados al proyecto
            $entregables = DB::select("
                select id_hito, id_objetivo, descrip_objetivo
                from objetivo
                where id_proyecto =?", [$id_proyecto]);
            
            // Redirigir a la vista de añadir criterio de aceptación
            return view('planilla_planificacion.criterioAceptacion_select', compact('hitos', 'entregables', 'id_estudiante'));
        } else {
            // Si no está en "Planificación" o "Desarrollo", redirigir a la vista rangoEtapa.etapa
            $etapa_actual = DB::table('etapa')
                ->where('id_proyecto', $id_proyecto)
                ->where('nombre_etapa', 'Desarrollo') 
                ->first();
    
            $mensaje_inicio = 'La etapa de planificación del proyecto fue habilitada en las fechas:';
            $mensaje_error = 'El proyecto no está en la etapa de "Planificación" o "Desarrollo". No se pueden añadir criterios de aceptación.';
            $fechas_etapa = $etapa_actual
                ? ['inicio' => $etapa_actual->fecha_inicio_etapa, 'fin' => $etapa_actual->fecha_fin_etapa] 
                : null;
    
            // Redirigir a la vista de rango de etapa con los mensajes y fechas
            return view('rangoEtapa.etapa', compact('mensaje_error', 'mensaje_inicio', 'fechas_etapa', 'id_estudiante'));
        }
    }
    

}
