<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EvaluacionParesController extends Controller
{
    public function evaluacionPares($idEstudiante)
    {
        // Obtenemos los estudiantes del grupo empresa al que pertenece el estudiante
    $estudiantes = self::getEstudiantes($idEstudiante);
    
    // También podemos obtener estudiantes calificados utilizando el mismo grupo
    $idGrupoEmpresa = self::getGrupoEmpresaByEstudiante($idEstudiante);
    $estudiantesCalificados = self::getEstudiantesCalificados($idGrupoEmpresa);
    
    return view("evaluacion_pares", [
        'estudiantes' => $estudiantes,
        "estudiantesCalificados" => $estudiantesCalificados]);

    }
    private static function getEstudiantes($idEstudiante)
{
    // Obtener el id_grupo_empresa del estudiante proporcionado
    $idGrupoEmpresa = self::getGrupoEmpresaByEstudiante($idEstudiante);
    
    if (!$idGrupoEmpresa) {
        return []; // Retornar un arreglo vacío si no se encuentra el grupo
    }

    // Devuelve los estudiantes del grupo empresa correspondiente
    $estudiantes = DB::select("SELECT e.id_usuario, concat(e.nombre_estudiante, ' ', e.apellido_estudiante) as nombre_estudiante 
        FROM estudiante e
        JOIN estudiante_grupoempresa ege ON e.id_usuario = ege.id_usuario
        WHERE ege.id_grupo_empresa = ?", array($idGrupoEmpresa));

    return $estudiantes;
}

private static function getGrupoEmpresaByEstudiante($idEstudiante)
{
    // Obtener el id_grupo_empresa para el estudiante proporcionado
    $resultado = DB::select("SELECT ege.id_grupo_empresa 
                              FROM estudiante_grupoempresa ege 
                              WHERE ege.id_usuario = ?", array($idEstudiante));

    return $resultado ? $resultado[0]->id_grupo_empresa : null; // Retorna el grupo o null si no se encuentra
}
      public function guardarNotaEstudiantes(Request $request)
    {
        $nota = $request->input('nota');
        $idEvaluacion = $request->input('idEvaluacion');
        $idEstudianteEvaluado = $request->input('idEstudianteEvaluado');
        $idEstudiante = $request->input('idEstudiante');

        DB::insert("INSERT INTO respuesta (id_evaluacion, id_estudiante, otro_id_estudiante, puntaje) VALUES (?,?,?,?)", array($idEvaluacion, $idEstudiante, $idEstudianteEvaluado, $nota));
    }

    public function getCriteriosParametros(Request $request)
    {
        $idGrupoEmpresa = $request->input("idEstudiante");
        
        $consulta = DB::select("SELECT ge.nombre_corto, ce.id_criterio_evaluacion, ce.evaluacion, ce.descripcion_evaluacion, pe.nombre_parametro, pe.escala_variable, ge.id_grupo_empresa, e.id_evaluacion 
        FROM grupo_empresa ge, proyecto pr, evaluacion e, tipo_evaluacion te, 
        criterio_parametro_evaluacion cpe, parametro_evaluacion pe, criterio_evaluacion ce,
        estudiante_grupoempresa ege
        WHERE ge.id_grupo_empresa = pr.id_grupo_empresa
        AND pr.id_proyecto = e.id_proyecto
        AND e.id_tipo_evaluacion = te.id_tipo_evaluacion
        AND e.id_evaluacion = cpe.id_evaluacion
        AND cpe.id_parametro = pe.id_parametro
        AND cpe.id_criterio_evaluacion = ce.id_criterio_evaluacion
        AND ege.id_grupo_empresa = ge.id_grupo_empresa
        AND ge.id_grupo_empresa = ?
        AND te.id_tipo_evaluacion = 2
        AND e.id_docente = 61
        AND ege.periodo_grupoempresa = '2-2024'
        GROUP BY ge.nombre_corto, ce.id_criterio_evaluacion, ce.evaluacion, ce.descripcion_evaluacion, pe.nombre_parametro, pe.escala_variable, ge.id_grupo_empresa, e.id_evaluacion
        ORDER BY ce.id_criterio_evaluacion", array($idGrupoEmpresa));

        return response(json_encode($consulta), 200)->header('Content-type', 'text/plain');
    }

    private static function getEstudiantes2($idGrupoEmpresa)
    {
        // Devuelve los estudiantes de una grupo empresa específica
        $estudiantes = DB::select("SELECT e.id_usuario, concat(e.nombre_estudiante, ' ', e.apellido_estudiante) as nombre_estudiante 
        FROM estudiante e, estudiante_grupoempresa ege
        WHERE e.id_usuario = ege.id_usuario
        AND ege.id_grupo_empresa = ?", array($idGrupoEmpresa));
        return $estudiantes;
    }

   /* private static function getDatosEvaluador($idGrupoEmpresa)
    {
        // Datos que retorna ---> id_usuario y nombre_estudiante(representante)
        $consulta = DB::select("SELECT e.id_usuario, concat(e.nombre_estudiante, ' ', e.apellido_estudiante) as nombre_estudiante 
        FROM estudiante e, estudiante_grupoempresa ege, grupo_empresa ge
        WHERE e.id_usuario = ege.id_usuario
        AND ege.id_grupo_empresa = ge.id_grupo_empresa
        AND ge.id_grupo_empresa = ?
        ", array($idGrupoEmpresa));
        return $consulta;
    }*/

    private static function getEstudiantesCalificados($idGrupoEmpresa)
    {
        $consulta = DB::select("SELECT re.puntaje, e.id_usuario as id_estudiante, re.otro_id_estudiante 
FROM respuesta re
JOIN evaluacion ev ON re.id_evaluacion = ev.id_evaluacion
JOIN estudiante e ON re.otro_id_estudiante = e.id_usuario
WHERE ev.id_tipo_evaluacion = 2
AND re.id_estudiante IN (SELECT id_usuario 
                         FROM estudiante 
                         WHERE id_usuario IN (SELECT id_usuario 
                                              FROM estudiante_grupoempresa 
                                              WHERE id_grupo_empresa = ?))", array($idGrupoEmpresa));
        return $consulta;
    }
    
}