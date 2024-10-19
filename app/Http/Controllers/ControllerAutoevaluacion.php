<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ControllerAutoevaluacion extends Controller
{
    public function autoevaluacion($idEstudiante)
    {
        $idProyecto = self::getIdProyecto($idEstudiante);
        $parametrosDeEvaluacion = self::getParametrosDeEvaluacion($idProyecto);
        return view("tipos_evaluaciones/autoevaluacion", ['parametrosDeEvaluacion' => $parametrosDeEvaluacion, 'idProyecto' => $idProyecto, 'idEstudiante' => $idEstudiante]);
    }
    public function registroNota(Request $request)
    {

        $nota = $request->input('nota');
        $idEstudiante = $request->input('idEstudiante');
        $idProyecto = $request->input('idProyecto');
        $idEvaluacion = DB::select("SELECT id_evaluacion FROM evaluacion WHERE id_tipo_evaluacion = ? AND id_proyecto = ?", array(1, $idProyecto));
        $idEvaluacion = $idEvaluacion[0]->id_evaluacion;
        DB::insert("INSERT INTO respuesta (id_evaluacion, id_estudiante, otro_id_estudiante, puntaje) VALUES (?,?,?,?)", array($idEvaluacion, $idEstudiante, $idEstudiante, $nota));
    }

    private static function getParametrosDeEvaluacion($idProyecto)
    {
        $tipoEvaluacion = 1; // AUTOEVALUACIÓN
        $parametrosDeEvaluacion = DB::select("SELECT ce.evaluacion, ce.descripcion_evaluacion, pe.nombre_parametro, pe.escala_variable  
        FROM evaluacion e, criterio_parametro_evaluacion cpe, parametro_evaluacion pe, criterio_evaluacion ce
        WHERE e.id_evaluacion = cpe.id_evaluacion
        AND ce.id_criterio_evaluacion = cpe.id_criterio_evaluacion
        AND pe.id_parametro = cpe.id_parametro
        AND e.id_tipo_evaluacion = ?
        AND e.id_proyecto = ?", array($tipoEvaluacion, $idProyecto));
        return $parametrosDeEvaluacion;
    }

    private static function getIdProyecto($idEstudiante)
    {
        $idProyecto = DB::select("SELECT pr.id_proyecto 
        FROM estudiante e, estudiante_grupoempresa eg, grupo_empresa ge, proyecto pr
        WHERE e.id_usuario = eg.id_usuario
        AND eg.id_grupo_empresa = ge.id_grupo_empresa
        AND ge.id_grupo_empresa = pr.id_grupo_empresa
        AND e.id_usuario = ?", array($idEstudiante));
        return $idProyecto[0]->id_proyecto;
    }
}
