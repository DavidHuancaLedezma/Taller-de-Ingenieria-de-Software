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
        $estudiantesCalificados = self::getEstudiantesCalificados($idGrupoEmpresa,$idEstudiante);


        return view("evaluacion_pares", [
            'estudiantes' => $estudiantes,
            "estudiantesCalificados" => $estudiantesCalificados,
            'idEvaluador' => $idEstudiante
        ]);
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
        try {
            $nota = $request->input('nota');
            $idEvaluacion = $request->input('idEvaluacion');
            $idEstudianteEvaluado = $request->input('idEstudianteEvaluado');
            $idEstudiante = $request->input('idEstudiante'); // Evaluador

            // Guardar la nota en la base de datos
            DB::insert(
                "INSERT INTO respuesta (id_evaluacion, id_estudiante, otro_id_estudiante, puntaje) VALUES (?,?,?,?)",
                [$idEvaluacion, $idEstudiante, $idEstudianteEvaluado, $nota]
            );

            // Retorna una respuesta de éxito
            return response()->json(['success' => true, 'message' => 'Calificación guardada exitosamente.']);
        } catch (Exception $e) {
            // En caso de error, retorna una respuesta de error
            return response()->json(['success' => false, 'message' => 'Error al guardar la calificación.'], 500);
        }
    }

    public function getCriteriosParametros(Request $request)
    {
        $idEstudiante = $request->input("idEstudiante");

        // Primero obtener el id_grupo_empresa
        $grupoEmpresa = DB::select("SELECT id_grupo_empresa 
                               FROM estudiante_grupoempresa 
                               WHERE id_usuario = ?", [$idEstudiante]);

        if (empty($grupoEmpresa)) {
            return response()->json(['error' => 'No se encontró el grupo empresa'], 404);
        }

        $idGrupoEmpresa = $grupoEmpresa[0]->id_grupo_empresa;

        $criteriosParametros = DB::select(
            "SELECT ge.nombre_corto, ce.id_criterio_evaluacion,
    MAX(ce.evaluacion) AS evaluacion, MAX(ce.descripcion_evaluacion) AS descripcion_evaluacion,
    MAX(pe.nombre_parametro) AS nombre_parametro, 
    MAX(em.escala_cualitativa) AS escala_cualitativa, MAX(em.escala_cuantitativa) AS escala_cuantitativa,
    ge.id_grupo_empresa, e.id_evaluacion
FROM grupo_empresa ge
JOIN proyecto pr ON ge.id_grupo_empresa = pr.id_grupo_empresa
JOIN evaluacion e ON pr.id_proyecto = e.id_proyecto
JOIN tipo_evaluacion te ON e.id_tipo_evaluacion = te.id_tipo_evaluacion
JOIN criterio_parametro_evaluacion cpe ON e.id_evaluacion = cpe.id_evaluacion
JOIN parametro_evaluacion pe ON cpe.id_parametro = pe.id_parametro
JOIN escala_medicion em ON pe.id_parametro = em.id_parametro
JOIN criterio_evaluacion ce ON cpe.id_criterio_evaluacion = ce.id_criterio_evaluacion
WHERE ge.id_grupo_empresa = ?
    AND te.id_tipo_evaluacion = 2
    AND e.id_docente = 61
    AND EXISTS (
        SELECT 1 FROM estudiante_grupoempresa 
        WHERE id_grupo_empresa = ge.id_grupo_empresa 
        AND periodo_grupoempresa = '2-2024'
    )
GROUP BY ge.nombre_corto, ce.id_criterio_evaluacion, ge.id_grupo_empresa, e.id_evaluacion
ORDER BY ce.id_criterio_evaluacion

        ",
            [$idGrupoEmpresa]
        );

        if (empty($criteriosParametros)) {
            return response()->json(['error' => 'No se encontraron criterios de evaluación'], 404);
        }

        return response()->json($criteriosParametros);
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

    private static function getEstudiantesCalificados($idGrupoEmpresa, $idEvaluador)
    {
        $consulta = DB::select("
            SELECT re.puntaje, 
                   e.id_usuario as id_estudiante, 
                   re.otro_id_estudiante, 
                   re.id_estudiante as id_evaluador
            FROM respuesta re
            JOIN evaluacion ev ON re.id_evaluacion = ev.id_evaluacion
            JOIN estudiante e ON re.otro_id_estudiante = e.id_usuario
            WHERE ev.id_tipo_evaluacion = 2
              AND re.id_estudiante = ? -- Filtra por el evaluador actual
              AND re.id_estudiante IN (
                  SELECT id_usuario 
                  FROM estudiante 
                  WHERE id_usuario IN (
                      SELECT id_usuario 
                      FROM estudiante_grupoempresa 
                      WHERE id_grupo_empresa = ?
                  )
              )
        ", [$idEvaluador, $idGrupoEmpresa]); // Pasar el ID del evaluador actual y el grupo empresa
        return $consulta;
    }
}