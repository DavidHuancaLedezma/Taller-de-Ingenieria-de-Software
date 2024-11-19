<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateTime;

class ControllerHome extends Controller
{
    public function openHome($idEstudiante)
    {
        $autoevaluacion = self::autoevaluacionRealizada($idEstudiante);
        $idGrupoEmpresa = self::getIdGrupoEmpresaDelEstudiante($idEstudiante);

        $idProyecto = self::getIdProyecto($idEstudiante);
        $parametrosDeEvaluacion = self::getParametrosDeEvaluacion($idProyecto);

        $fechasDeAutoevaluacion = [];
        $conParametros = "no";
        if (count($parametrosDeEvaluacion) > 0) {
            //cuando esta registrado
            $id = $parametrosDeEvaluacion[0][0]->id_evaluacion;
            $fechasDeAutoevaluacion = self::rangoFechasAutoevaluacion($id);
            $conParametros = "si";
        }

        return view("home", ['idEstudinte' => $idEstudiante, 'autoevaluacion' => $autoevaluacion, 'idGrupoEmpresa' => $idGrupoEmpresa, 'conParametros' => $conParametros, 'fechasDeAutoevaluacion' => $fechasDeAutoevaluacion]);
    }

    private static function autoevaluacionRealizada($idEstudiante)
    {
        $evaluado = 0;
        $consulta = DB::select("SELECT ev.id_tipo_evaluacion, re.id_estudiante FROM respuesta re, evaluacion ev
        WHERE re.id_evaluacion = ev.id_evaluacion
        AND ev.id_tipo_evaluacion = 1
        AND re.id_estudiante = ?", array($idEstudiante));

        if (count($consulta) > 0) {
            $evaluado = 1;
        }
        return $evaluado;
    }

    private static function getIdGrupoEmpresaDelEstudiante($idEstudiante)
    {
        $consulta = DB::select("SELECT ge.id_grupo_empresa, ge.nombre_corto 
        FROM estudiante_grupoempresa ege, grupo_empresa ge
        WHERE ege.id_grupo_empresa = ge.id_grupo_empresa
        AND ege.id_usuario = ?", array($idEstudiante));
        return $consulta[0]->id_grupo_empresa;
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


    private static function getParametrosDeEvaluacion($idProyecto)
    {
        $tipoEvaluacion = 1; // AUTOEVALUACIÓN
        $parametrosDeEvaluacion = DB::select("SELECT ce.evaluacion, e.id_evaluacion, ce.descripcion_evaluacion, pe.nombre_parametro, pe.id_parametro, cpe.puntaje_evaluacion
        FROM evaluacion e, criterio_parametro_evaluacion cpe, parametro_evaluacion pe, criterio_evaluacion ce
        WHERE e.id_evaluacion = cpe.id_evaluacion
        AND ce.id_criterio_evaluacion = cpe.id_criterio_evaluacion
        AND pe.id_parametro = cpe.id_parametro
        AND e.id_tipo_evaluacion = ?
        AND e.id_proyecto = ?", array($tipoEvaluacion, $idProyecto));

        $parametrosYescalaMedicion = self::getParametrosYescalaMedicion($parametrosDeEvaluacion);
        return $parametrosYescalaMedicion;
    }


    private static function getParametrosYescalaMedicion($parametrosDeEvaluacion)
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

    private static function rangoFechasAutoevaluacion($idEvalucion)
    {
        // Obtener la fecha actual
        date_default_timezone_set('America/La_Paz');
        $fechaActual = date('Y-m-d');

        $fechaActual = new DateTime($fechaActual);

        $antesDeFecha = 0;
        $despuesDeFecha = 0;

        $consulta = DB::select("SELECT fecha_evaluacion_ini, fecha_evaluacion_fin FROM evaluacion
        WHERE id_evaluacion = ?", array($idEvalucion));

        $fechaIniEvaluacion = new DateTime($consulta[0]->fecha_evaluacion_ini);
        $fechaFinEvaluacion = new DateTime($consulta[0]->fecha_evaluacion_fin);

        if ($fechaActual < $fechaIniEvaluacion) {
            $antesDeFecha = 1;
        }
        if ($fechaActual > $fechaFinEvaluacion) {
            $despuesDeFecha = 1;
        }

        return array(array($antesDeFecha, $fechaActual->format('Y-m-d'), $fechaIniEvaluacion->format('Y-m-d')), array($despuesDeFecha, $fechaActual->format('Y-m-d'), $fechaFinEvaluacion->format('Y-m-d')));
    }
}