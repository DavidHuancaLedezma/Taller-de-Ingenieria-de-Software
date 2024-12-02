<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateTime;
use Carbon\Carbon;

class ControllerHome extends Controller
{
    public function openHome($idEstudiante)
    {
        $autoevaluacion = self::autoevaluacionRealizada($idEstudiante);
        $idGrupoEmpresa = self::getIdGrupoEmpresaDelEstudiante($idEstudiante);
        $nombre_estudiante = self::getnombreEstudiante($idEstudiante);
        $idProyecto = self::getIdProyecto($idEstudiante);
        $parametrosDeEvaluacion = self::getParametrosDeEvaluacion($idProyecto);
        $nombre_grupoEmpresa = self::get_nombre_grupoEmpresa($idProyecto);
        $fechasDeAutoevaluacion = [];
        $conParametros = "no";
        if (count($parametrosDeEvaluacion) > 0) {
            //cuando esta registrado
            $id = $parametrosDeEvaluacion[0][0]->id_evaluacion;
            $fechasDeAutoevaluacion = self::rangoFechasAutoevaluacion($id);
            $conParametros = "si";
        }
        $proyecto=self::getProyecto($idProyecto);
        if (!empty($proyecto)) {
            $nombreProyecto = $proyecto[0]->nombre_proyecto;
            $descripcionProyecto = $proyecto[0]->descripcion_proyecto;
            $fechaInicio = $proyecto[0]->fecha_ini_proyecto;
            $fechaFin = $proyecto[0]->fecha_fin_proyecto;
            $nombreEtapa = $proyecto[0]->nombre_etapa;
        } else {
            $nombreProyecto = "Proyecto no encontrado";
            $descripcionProyecto = "";
            $fechaInicio = "N/A";
            $fechaFin = "N/A";
            $nombreEtapa = "No disponible";
        }
        $miembros = $this->getMiembroEquipo($idGrupoEmpresa);
        $equipo = array_map(function ($miembro) {
            return $miembro->nombre_estudiante . ' ' . $miembro->apellido_estudiante;
        }, $miembros);
        $fechaActual = Carbon::now()->format('M j, Y');
        return view("home", ['idEstudinte' => $idEstudiante, 'autoevaluacion' => $autoevaluacion, 'idGrupoEmpresa' => $idGrupoEmpresa, 'conParametros' => $conParametros, 'fechasDeAutoevaluacion' => $fechasDeAutoevaluacion,
                     'nombre_estudiante' => $nombre_estudiante,'nombre_grupoEmpresa' => $nombre_grupoEmpresa,
                     'nombreProyecto'=>$nombreProyecto, 'descripcionProyecto'=>$descripcionProyecto, 'fechaInicio'=>$fechaInicio, 'fechaFin'=>$fechaFin,'nombreEtapa'=> $nombreEtapa,
                     'equipo'=>$equipo,'fechaActual'=> $fechaActual]);
    }
    private function getnombreEstudiante($idEstudiante)
    {
        $consulta = DB::select("
            SELECT nombre_estudiante, apellido_estudiante
            FROM estudiante
            WHERE id_usuario = ?", [$idEstudiante]
        );

        // Verificamos si se obtuvo un resultado
        if ($consulta && count($consulta) > 0) {
            return $consulta[0]->nombre_estudiante . ' ' . $consulta[0]->apellido_estudiante;
        }
        
        return null;  // Retornamos null si no se encuentra el estudiante
    }

    private function get_nombre_grupoEmpresa($idProyecto)
    {
        $consulta = DB::select("
            SELECT ge.nombre_corto
            FROM grupo_empresa ge
            JOIN proyecto pr ON ge.id_grupo_empresa = pr.id_grupo_empresa
            WHERE pr.id_proyecto = ?", [$idProyecto]
        );

        // Verificamos si se obtuvo un resultado
        if ($consulta && count($consulta) > 0) {
            return $consulta[0]->nombre_corto;
        }

        return null;  // Retornamos null si no se encuentra el grupo empresa
    }
    private function getProyecto($idProyecto){
        $consulta= DB::select("
        select pr.nombre_proyecto, pr.descripcion_proyecto,pr.fecha_ini_proyecto,fecha_fin_proyecto,et.nombre_etapa
        from proyecto pr, etapa et
        where pr.id_proyecto = et.id_proyecto and et.etapa_activa = 'true' and et.id_proyecto =?
        ", [$idProyecto]);
        return $consulta;
    }
    private function getmiembroEquipo($idGrupoEmpresa){
        $consulta=DB:: select("
        select es.nombre_estudiante, es.apellido_estudiante
        from estudiante es, estudiante_grupoempresa ege
        where es.id_usuario = ege.id_usuario and ege.id_grupo_empresa = ?
        ", [$idGrupoEmpresa]);
        return $consulta;
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
        if (count($consulta) > 0) {
            return $consulta[0]->id_grupo_empresa;
        } else {
            return 0;
        }
    }

    private static function getIdProyecto($idEstudiante)
    {
        $idProyecto = DB::select("SELECT pr.id_proyecto 
        FROM estudiante e, estudiante_grupoempresa eg, grupo_empresa ge, proyecto pr
        WHERE e.id_usuario = eg.id_usuario
        AND eg.id_grupo_empresa = ge.id_grupo_empresa
        AND ge.id_grupo_empresa = pr.id_grupo_empresa
        AND e.id_usuario = ?", array($idEstudiante));

        if (count($idProyecto) > 0) {
            return $idProyecto[0]->id_proyecto;
        } else {
            return 0;
        }
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
