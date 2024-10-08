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

        $idDocenteDeGrupoEmpresa = self::getIdDocenteDeGrupoEmpresa($idGrupoEmpresa);
        $fechasDeFinal = self::etapaFinal($idDocenteDeGrupoEmpresa);

        if (count($parametrosDeEvaluacion) > 0) {
            //cuando esta registrado
            $id = $parametrosDeEvaluacion[0][0]->id_evaluacion;
            $fechasDeAutoevaluacion = self::rangoFechasAutoevaluacion($id);
            $conParametros = "si";
        }
        $proyecto = self::getProyecto($idProyecto);
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
        $hito = $this->getHitoEnRango($idProyecto);

        if ($hito) {
            $entregables = $this->getEntregablesYActividades($hito->id_hito, $idEstudiante);
        } else {
            $entregables = null;  // O puedes asignar un valor predeterminado si lo prefieres
        }


        return view("home", [
            'idEstudinte' => $idEstudiante,
            'autoevaluacion' => $autoevaluacion,
            'idGrupoEmpresa' => $idGrupoEmpresa,
            'conParametros' => $conParametros,
            'fechasDeAutoevaluacion' => $fechasDeAutoevaluacion,
            'nombre_estudiante' => $nombre_estudiante,
            'nombre_grupoEmpresa' => $nombre_grupoEmpresa,
            'nombreProyecto' => $nombreProyecto,
            'descripcionProyecto' => $descripcionProyecto,
            'fechaInicio' => $fechaInicio,
            'fechaFin' => $fechaFin,
            'nombreEtapa' => $nombreEtapa,
            'equipo' => $equipo,
            'fechaActual' => $fechaActual,
            'hito' => $hito,
            'entregables' => $entregables,
            'fechasDeFinal' => $fechasDeFinal,
            'fechasSemestre'=>$fechasSemestre, 
            'fecha_ini_semestre'=>$fecha_ini_semestre,
            'fecha_fin_semestre'=>$fecha_fin_semestre]);
    }
    private function getnombreEstudiante($idEstudiante)
    {
        $consulta = DB::select(
            "
            SELECT nombre_estudiante, apellido_estudiante
            FROM estudiante
            WHERE id_usuario = ?",
            [$idEstudiante]
        );

        // Verificamos si se obtuvo un resultado
        if ($consulta && count($consulta) > 0) {
            return $consulta[0]->nombre_estudiante . ' ' . $consulta[0]->apellido_estudiante;
        }

        return null;  // Retornamos null si no se encuentra el estudiante
    }

    private function get_nombre_grupoEmpresa($idProyecto)
    {
        $consulta = DB::select(
            "
            SELECT ge.nombre_corto
            FROM grupo_empresa ge
            JOIN proyecto pr ON ge.id_grupo_empresa = pr.id_grupo_empresa
            WHERE pr.id_proyecto = ?",
            [$idProyecto]
        );

        // Verificamos si se obtuvo un resultado
        if ($consulta && count($consulta) > 0) {
            return $consulta[0]->nombre_corto;
        }

        return null;  // Retornamos null si no se encuentra el grupo empresa
    }


    private static function getIdDocenteDeGrupoEmpresa($idGrupoEmpresa)
    {
        $res = 0;
        $consulta = DB::select("SELECT d.id_usuario
        FROM docente d, grupo_materia gm, grupo gr, proyecto pr, grupo_empresa ge
        WHERE d.id_usuario = gm.id_usuario
        AND gm.id_grupo = gr.id_grupo
        AND pr.id_grupo = gr.id_grupo
        AND ge.id_grupo_empresa = pr.id_grupo_empresa
        AND ge.id_grupo_empresa = ?", array($idGrupoEmpresa));
        if (count($consulta) > 0) {
            $res = $consulta[0]->id_usuario;
        }
        return $res;
    }

    private static function etapaFinal($idDocente)
    {
        // Obtener la fecha actual
        date_default_timezone_set('America/La_Paz');
        $fechaActual = date('Y-m-d');
        $fechaActual = new DateTime($fechaActual);

        $consulta = DB::select("SELECT e.fecha_inicio_etapa as inicio_etapa , e.fecha_fin_etapa as fin_etapa
            FROM grupo_materia gm, grupo gr, proyecto pr, etapa e
            WHERE gm.id_grupo = gr.id_grupo
            AND pr.id_proyecto = e.id_proyecto
            AND gr.id_grupo = pr.id_grupo
            AND gm.id_usuario = ?
            AND e.nombre_etapa = 'Final'
            LIMIT 1", array($idDocente));

        $fecha_ini = new DateTime($consulta[0]->inicio_etapa);
        $fecha_fin = new DateTime($consulta[0]->fin_etapa);

        if ($fechaActual < $fecha_ini) {
            $res = array($consulta[0], 1);
        } else if ($fechaActual > $fecha_fin) {
            $res = array($consulta[0], 2);
        } else {
            $res = array($consulta[0], 0);
        }
        return $res;
    }

    private function getProyecto($idProyecto)
    {
        $consulta = DB::select("
        select pr.nombre_proyecto, pr.descripcion_proyecto,pr.fecha_ini_proyecto,fecha_fin_proyecto,et.nombre_etapa
        from proyecto pr, etapa et
        where pr.id_proyecto = et.id_proyecto and et.etapa_activa = 'true' and et.id_proyecto =?
        ", [$idProyecto]);
        return $consulta;
    }
    private function getHitoEnRango($idProyecto)
    {
        $fechaActual = date('Y-m-d'); // Obtén la fecha actual

        $hito = DB::table('hito')
            ->where('fecha_inicio_hito', '<=', $fechaActual)
            ->where('fecha_fin_hito', '>=', $fechaActual)
            ->where('id_proyecto', $idProyecto)
            ->select('id_hito', 'numero_hito')
            ->first(); // Devuelve el primer registro encontrado

        return $hito; // Retorna el id_hito o null si no hay coincidencia
    }
    private function getEntregablesYActividades($idHito, $idUsuario)
    {
        if (is_null($idHito)) {
            return null;
        }
        $query = "
            SELECT ob.id_objetivo, ob.descrip_objetivo, ac.descripcion_actividad
            FROM objetivo ob
            LEFT JOIN actividad ac ON ob.id_objetivo = ac.id_objetivo
            WHERE ob.id_hito = ? AND (ac.id_usuario = ? OR ac.id_usuario IS NULL)
            ORDER BY ob.id_objetivo, ac.id_actividad
        ";

        $resultados = DB::select($query, [$idHito, $idUsuario]);

        // Agrupa los datos por entregables
        $entregables = [];
        foreach ($resultados as $fila) {
            if (!isset($entregables[$fila->id_objetivo])) {
                $entregables[$fila->id_objetivo] = [
                    'descripcion' => $fila->descrip_objetivo,
                    'actividades' => [],
                ];
            }
            if ($fila->descripcion_actividad) {
                $entregables[$fila->id_objetivo]['actividades'][] = $fila->descripcion_actividad;
            }
        }

        return $entregables;
    }
    private function getFechaSemestre($idEstudiante){
        $semestre= DB:: select('
        select se.fecha_inicio_semestre, se.fecha_fin_semestre
        from semestre se, grupo_materia grm, matricula mtr
        where se.id_semestre = grm.id_semestre and grm.id_grupo = mtr.id_grupo and mtr.id_usuario = ?
        ',[$idEstudiante]);
        return !empty($semestre) ? $semestre[0] : null;
    }

    private function getmiembroEquipo($idGrupoEmpresa)
    {
        $consulta = DB::select("
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
