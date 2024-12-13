<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class PlanillaEvaluacionController extends Controller
{
    public function create($idDocente)
    {
        // Obtener el ID del proyecto asociado al docente
        $id_proyecto = DB::select("
            SELECT pr.id_proyecto 
            FROM proyecto pr, grupo_materia gm
            WHERE gm.id_grupo = pr.id_grupo 
            AND gm.id_usuario = ?", [$idDocente]);

        $id_proyecto = $id_proyecto ? $id_proyecto[0]->id_proyecto : null;

        // Validar si el proyecto existe
        if (!$id_proyecto) {
            return redirect()->back()->withErrors('El proyecto no existe.');
        }

        // Consultar la etapa activa del proyecto
        $etapa_activa = DB::table('etapa')
            ->where('id_proyecto', $id_proyecto)
            ->where('etapa_activa', 1) // Filtra por etapa activa
            ->first();

        // Verificar si la etapa activa es "Final"
        if ($etapa_activa && $etapa_activa->nombre_etapa === 'Final') {
            // Si está en la etapa final, redirigir a la vista de evaluación
            $tipos_evaluacion = DB::select("SELECT * FROM tipo_evaluacion");
            $criterios_evaluacion = DB::select("SELECT * FROM criterio_evaluacion");
            $parametros = DB::select("SELECT * FROM parametro_evaluacion");
            $escalas = DB::select("SELECT * FROM escala_medicion");
            $fecha_etapa_final = $etapa_activa->fecha_fin_etapa;

            // Redirigir a la vista de evaluación
            return view('planilla_evaluacion.planilla_evaluacion', compact('tipos_evaluacion', 'criterios_evaluacion', 'parametros', 'escalas', 'idDocente','fecha_etapa_final'));
        } else {
            // Si no está en la etapa "Final", redirigir a la vista de rango de etapa
            $mensaje_error = 'Los proyectos no están en la etapa final. No se puede proceder a crear planilla de evaluación.';
            
            // Consultar las fechas de la etapa actual
            $etapa_actual = DB::table('etapa')
                ->where('id_proyecto', $id_proyecto)
                ->where('nombre_etapa', 'Final') 
                ->first();

            $mensaje_inicio = 'La etapa final de los proyectos están habilitados en las fechas:';
            $fechas_etapa = $etapa_actual 
                ? ['inicio' => $etapa_actual->fecha_inicio_etapa, 'fin' => $etapa_actual->fecha_fin_etapa] 
                : null;

            // Redirigir a la vista de rango de etapa con los mensajes y fechas
            return view('rangoEtapa.etapa_final', compact('mensaje_error', 'mensaje_inicio', 'fechas_etapa', 'idDocente'));
        }
    }


    public function getEmpresasPorEvaluacion($id_tipo_evaluacion, $id_docente)
    {
        $grupoEmpresas = DB::select("SELECT ge.nombre_corto, ge.id_grupo_empresa, ege.periodo_grupoempresa
            FROM grupo_empresa ge
            JOIN estudiante_grupoempresa ege ON ge.id_grupo_empresa = ege.id_grupo_empresa
            JOIN proyecto pr ON pr.id_grupo_empresa = ge.id_grupo_empresa
            JOIN grupo gr ON pr.id_grupo = gr.id_grupo
            JOIN grupo_materia gm ON gr.id_grupo = gm.id_grupo
            JOIN docente doc ON gm.id_usuario = doc.id_usuario
            WHERE doc.id_usuario = ?
            AND ege.periodo_grupoempresa = '2-2024'
            AND NOT EXISTS (
                    SELECT 1
                    FROM evaluacion eva
                    WHERE eva.id_proyecto = pr.id_proyecto
                    AND eva.id_tipo_evaluacion = ?
            )
            GROUP BY ge.nombre_corto, ge.id_grupo_empresa, ege.periodo_grupoempresa
            ORDER BY ge.id_grupo_empresa ASC
        ", [$id_docente, $id_tipo_evaluacion]);

        return response()->json(['empresas' =>$grupoEmpresas]);
    }


   
    public function store(Request $request)
    {
        // Confirmación de datos de entrada en el log
        //Log::info("Datos recibidos en store:", $request->all());
        //dd($request->all());
        

        $request->validate([
            'docente_id' => 'required|integer',
            'tipo_evaluacion' => 'required|integer',
            'grupoEmpresas' => 'required|array',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'evaluaciones' => 'required|array',
        ]);

        
        $id_docente = $request->input('docente_id');
        $tipo_evaluacion = $request->input('tipo_evaluacion');
        $grupo_empresas = $request->input('grupoEmpresas', []);
        $fecha_inicio = $request->input('fecha_inicio');
        $fecha_fin = $request->input('fecha_fin');
        $evaluaciones = $request->input('evaluaciones', []);

       
        $numGrupoEmpresas = count($grupo_empresas);
        $proyectos = $this->getproyectos($grupo_empresas);

        if (empty($proyectos) || empty($evaluaciones)) {
            return redirect()->back()->with('error', 'Datos insuficientes para realizar la operación.');
        }

        
        $addEvaluacion = $this->add_evalucion($tipo_evaluacion, $id_docente, $proyectos, $fecha_inicio, $fecha_fin);
        if (!$addEvaluacion) {
            return redirect()->back()->with('error', 'Error al registrar la evaluación.');
        }

        
        $evaluacion_added = $this->get_evaluacion($numGrupoEmpresas);

       
        $criterio_parametro = $this->add_criterio_parametro_evaluacion($evaluacion_added, $evaluaciones);
        
        if (!$criterio_parametro) {
            return redirect()->back()->with('error', 'Error al registrar los criterios y parámetros.');
        }

        return redirect()->back()->with('success', 'Registro de planilla de evaluación exitoso');
    }
    private function getproyectos($grupo_empresas){
        if (empty($grupo_empresas)) {
            return [];
        }
    
        return DB::table('proyecto')
            ->whereIn('id_grupo_empresa', $grupo_empresas)
            ->pluck('id_proyecto')
            ->toArray();
    }

    private function add_evalucion($tipo_evaluacion, $id_docente, $proyectos, $fecha_inicio, $fecha_fin){

        $fecha_creada = now();
        try{    
            foreach ($proyectos as $id_proyecto) {
                DB::table('evaluacion')->insert([
                    'id_tipo_evaluacion' => $tipo_evaluacion,
                    'id_docente' => $id_docente,
                    'id_proyecto' => $id_proyecto,
                    'fecha_creada' => $fecha_creada,
                    'fecha_evaluacion_ini' => $fecha_inicio,
                    'fecha_evaluacion_fin' => $fecha_fin,
                ]);
            }
            return true; // Registro exitoso
        } catch (\Exception $e) {
            Log::error("Error al insertar en evaluacion: " . $e->getMessage());
            // Manejar el error si ocurre
            return false; // Registro fallido
        }

    }

    private function get_evaluacion($numGrupoEmpresas){
        return DB::table('evaluacion')
        ->orderBy('id_evaluacion', 'desc')
        ->limit($numGrupoEmpresas)
        ->pluck('id_evaluacion')
        ->toArray();

    }
    private function add_criterio_parametro_evaluacion($evaluacion_added, $evaluaciones)
    {
        try {
            foreach ($evaluacion_added as $id_evaluacion_added) {    
                foreach ($evaluaciones as $criterio_parametro) {
                    $id_criterio = $criterio_parametro['id_criterio'] ?? null;
                    $id_parametro = $criterio_parametro['id_parametro'] ?? null;
                    $score = $criterio_parametro['score'] ?? null;
                    
                    // Validar que todos los datos requeridos estén presentes
                    if ($id_criterio && $id_parametro && $score) {
                        $insertado = DB::table('criterio_parametro_evaluacion')->insert([
                            'id_parametro' => $id_parametro,
                            'id_criterio_evaluacion' => $id_criterio,
                            'id_evaluacion' => $id_evaluacion_added,
                            'puntaje_evaluacion' => $score,
                        ]);
                        
                        if (!$insertado) {
                            return false;
                        }
                    } else {
                        Log::warning("Datos faltantes para insertar en criterio_parametro_evaluacion", $criterio_parametro);
                        return false;
                    }
                }
            }
            return true; // Registro exitoso
        } catch (\Exception $e) {
            Log::error("Error al insertar en evaluacion: " . $e->getMessage());
            return false; // Registro fallido
        }
    }

   
}
