<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateTime;

class ControllerEvaluacionCruzada extends Controller
{
    public function evaluacionCruzada($idGrupoEmpresa, $idEstudiante)
    {
        //por parametro se pasa el id de la grupo empresa
        $grupoEmpresas = self::getGrupoEmpresas($idGrupoEmpresa);
        try {
            $idEvaluador = self::getDatosEvaluador($idGrupoEmpresa);
            $idEvaluador = $idEvaluador[0]->id_usuario;
        } catch (Exception $e) {
            $idEvaluador = NULL;
        }

        $grupoEmpresasCalificadas = self::getGrupoEmpresasCalificadas($idGrupoEmpresa);
        return view("tipos_evaluaciones/evaluacion_cruzada", ['grupoEmpresas' => $grupoEmpresas, "idEvaluador" => $idEvaluador, "grupoEmpresasCalificadas" => $grupoEmpresasCalificadas, "idEstudiante" => $idEstudiante]);
    }

    public function guardarNotaGrupoEmpresas(Request $request)
    {
        $nota = $request->input('nota');
        $idEvaluacion = $request->input('idEvaluacion');
        $idEvaluador = $request->input('idEvaluador');
        $idGrupoEmpresaEvaluada = $request->input('idGrupoEmpresaEvaluada');

        $idRepresentanteGrupoEmpresaEvaluada = self::getDatosEvaluador($idGrupoEmpresaEvaluada);
        $idRepresentanteGrupoEmpresaEvaluada = $idRepresentanteGrupoEmpresaEvaluada[0]->id_usuario;

        DB::insert("INSERT INTO respuesta (id_evaluacion, id_estudiante, otro_id_estudiante, puntaje) VALUES (?,?,?,?)", array($idEvaluacion, $idEvaluador, $idRepresentanteGrupoEmpresaEvaluada, $nota));
    }

    public function getCriteriosParametros(Request $request)
    {
        $idGrupoEmpresa = $request->input("idGrupoEmpresa");
        $consulta = DB::select("SELECT ge.nombre_corto, ce.id_criterio_evaluacion, ce.evaluacion, ce.descripcion_evaluacion, pe.nombre_parametro, ge.id_grupo_empresa, e.id_evaluacion, pe.id_parametro, cpe.puntaje_evaluacion
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
        AND te.id_tipo_evaluacion = 3
        AND e.id_docente = 61
        AND ege.periodo_grupoempresa = '2-2024'
        GROUP BY ge.nombre_corto, ce.id_criterio_evaluacion, ce.evaluacion, ce.descripcion_evaluacion, pe.nombre_parametro, ge.id_grupo_empresa, e.id_evaluacion, pe.id_parametro, cpe.puntaje_evaluacion
        ORDER BY ce.id_criterio_evaluacion", array($idGrupoEmpresa));

        $escalaMedicionConParametros = self::getEscalaMedicionConParametros($consulta);

        return response(json_encode($escalaMedicionConParametros), 200)->header('Content-type', 'text/plain');
    }


    private static function getEscalaMedicionConParametros($parametrosDeEvaluacion)
    {

        $res = [];
        foreach ($parametrosDeEvaluacion as $item) {
            if ($item->nombre_parametro != "Numeral entero") {
                $idParametro = $item->id_parametro;
                $escalaMedicion = DB::select("SELECT escala_cualitativa, escala_cuantitativa 
                FROM escala_medicion
                WHERE id_parametro = ?", array($idParametro));

                $descripcionPuntaje = "";

                foreach ($escalaMedicion as $puntajes) {
                    $descripcionPuntaje = $descripcionPuntaje . $puntajes->escala_cualitativa . "=" . $puntajes->escala_cuantitativa . ", ";
                }
                $descripcionPuntaje = substr($descripcionPuntaje, 0, -2);
                $descripcionPuntaje = "Valores de los parametros de evaluación: " . $descripcionPuntaje;

                $res[] = array($item, $escalaMedicion, $descripcionPuntaje);
            } else {
                $res[] = array($item, NULL, "Valores de los parametros de evaluación: El rango admite valores del 0 al 100"); //El Numeral entero no tiene escalaMedicion en DB
            }
        }

        return $res;
    }

    private static function getGrupoEmpresas($idGrupoEmpresa)
    {
        $grupoEmpresas = DB::select("SELECT ge.id_grupo_empresa, ge.nombre_corto
        FROM grupo_empresa ge, estudiante_grupoempresa ege, proyecto pr, grupo gr 
        WHERE ge.id_grupo_empresa = ege.id_grupo_empresa
		AND ge.id_grupo_empresa = pr.id_grupo_empresa
		AND pr.id_grupo = gr.id_grupo
		AND gr.id_grupo = (SELECT gr.id_grupo FROM proyecto pr, grupo gr
		WHERE pr.id_grupo = gr.id_grupo
		AND pr.id_grupo_empresa = ?) 
        AND ege.periodo_grupoempresa = 
        (SELECT periodo_grupoEmpresa
        FROM estudiante_grupoEmpresa
        WHERE id_grupo_empresa = ?
        GROUP BY periodo_grupoempresa )
        AND ge.id_grupo_empresa != ?
        GROUP BY ge.id_grupo_empresa, ge.nombre_corto", array($idGrupoEmpresa, $idGrupoEmpresa, $idGrupoEmpresa));
        return $grupoEmpresas;
    }

    private static function getDatosEvaluador($idGrupoEmpresa)
    {
        //Datos que retorna ---> id_usuario y nombre_estudiante(representante)  ----> [{id_usuario:valor, nombre_estudiante:valor}]
        $consulta = DB::select("SELECT * FROM 
        (SELECT e.id_usuario, concat(e.nombre_estudiante, ' ', e.apellido_estudiante) as nombre_estudiante 
        FROM estudiante e, estudiante_grupoempresa ege, grupo_empresa ge
        WHERE e.id_usuario = ege.id_usuario
        AND ege.id_grupo_empresa = ge.id_grupo_empresa
        AND ge.id_grupo_empresa = ?) as representante
        WHERE representante.nombre_estudiante = (SELECT representante_legal 
                                        FROM grupo_empresa 
                                        WHERE id_grupo_empresa = ?)
        ", array($idGrupoEmpresa, $idGrupoEmpresa));
        return $consulta;
    }

    private static function getGrupoEmpresasCalificadas($idGrupoEmpresa)
    {
        $consulta = DB::select("SELECT tabla_notas.puntaje, tabla_empresa.id_grupo_empresa, tabla_notas.id_estudiante, tabla_notas.otro_id_estudiante FROM 
        (SELECT e.nombre_estudiante , ge.nombre_corto, e.id_usuario, ge.id_grupo_empresa FROM estudiante e, estudiante_grupoempresa ege, grupo_empresa ge
        WHERE e.id_usuario = ege.id_usuario
        AND ege.id_grupo_empresa = ge.id_grupo_empresa) as tabla_empresa, (SELECT re.id_estudiante, re.otro_id_estudiante, re.puntaje, e.id_evaluacion FROM respuesta re, evaluacion e
                                                                            WHERE e.id_evaluacion = re.id_evaluacion
                                                                            AND e.id_tipo_evaluacion = 3
                                                                            AND re.id_estudiante = (SELECT id_usuario FROM 
                                                                                                    (SELECT e.id_usuario, concat(e.nombre_estudiante, ' ', e.apellido_estudiante) as nombre_estudiante 
                                                                                                    FROM estudiante e, estudiante_grupoempresa ege, grupo_empresa ge
                                                                                                    WHERE e.id_usuario = ege.id_usuario
                                                                                                    AND ege.id_grupo_empresa = ge.id_grupo_empresa
                                                                                                    AND ge.id_grupo_empresa = ?) as representante
                                                                                                    WHERE representante.nombre_estudiante = (SELECT representante_legal 
                                                                                                                                                FROM grupo_empresa 
                                                                                                                                                WHERE id_grupo_empresa = ?))) as tabla_notas
                                                                                                                                                WHERE tabla_empresa.id_usuario = tabla_notas.otro_id_estudiante", array($idGrupoEmpresa, $idGrupoEmpresa));
        return $consulta;
    }


    public function rangoFechasEvaluacionCruzada(Request $request)
    {

        $idEvaluacion = $request->input("idEvaluacion");

        // Obtener la fecha actual
        date_default_timezone_set('America/La_Paz');
        $fechaActual = date('Y-m-d');

        $fechaActual = new DateTime($fechaActual);

        $antesDeFecha = 0;
        $despuesDeFecha = 0;

        $consulta = DB::select("SELECT fecha_evaluacion_ini, fecha_evaluacion_fin FROM evaluacion
        WHERE id_evaluacion = ?", array($idEvaluacion));

        $fechaIniEvaluacion = new DateTime($consulta[0]->fecha_evaluacion_ini);
        $fechaFinEvaluacion = new DateTime($consulta[0]->fecha_evaluacion_fin);

        if ($fechaActual < $fechaIniEvaluacion) {
            $antesDeFecha = 1;
        }
        if ($fechaActual > $fechaFinEvaluacion) {
            $despuesDeFecha = 1;
        }

        $respuesta = array(array($antesDeFecha, $fechaActual->format('Y-m-d'), $fechaIniEvaluacion->format('Y-m-d')), array($despuesDeFecha, $fechaActual->format('Y-m-d'), $fechaFinEvaluacion->format('Y-m-d')));
        return response(json_encode($respuesta), 200)->header('Content-type', 'text/plain');
    }
}
