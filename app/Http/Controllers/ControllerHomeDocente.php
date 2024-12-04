<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DateTime;


class ControllerHomeDocente extends Controller
{
    public function openHomeDocente($idDocente)
    {
        $nombre_docente = self::getnombreDocente($idDocente);
        $fechaActual = Carbon::now()->format('M j, Y');
        $grupoEmpresas = self::getGrupoEmpresas($idDocente);

        $fechasDesarrollo = self::etapaDeDesarrollo($idDocente);

        return view("home_docente", [
            'idDocente' => $idDocente,
            'nombre_docente' => $nombre_docente,
            'fechaActual' => $fechaActual,
            'grupoEmpresas' => $grupoEmpresas,
            'fechasDesarrollo' => $fechasDesarrollo
        ]);
    }
    private function getnombreDocente($idDocente)
    {
        $consulta = DB::select(
            "
            SELECT nombre_docente, apellido_docente
            FROM docente
            WHERE id_usuario = ?",
            [$idDocente]
        );

        // Verificamos si se obtuvo un resultado
        if ($consulta && count($consulta) > 0) {
            return $consulta[0]->nombre_docente . ' ' . $consulta[0]->apellido_docente;
        }

        return null;  // Retornamos null si no se encuentra el estudiante
    }
    private function getGrupoEmpresas($idDocente)
    {
        $grupoEmpresas = DB::select('
        select gre.id_grupo_empresa,gre.nombre_corto,  coalesce(pr.nombre_proyecto, \'Proyecto no asignado\') as nombre_proyecto
        from grupo_empresa gre, proyecto pr, grupo gr,grupo_materia gm
        where pr.id_grupo_empresa = gre.id_grupo_empresa and pr.id_grupo = gr.id_grupo and
        gr.id_grupo = gm.id_grupo and gm.id_usuario = ?
        ', [$idDocente]);

        return !empty($grupoEmpresas) ? $grupoEmpresas : null;
    }

    private static function etapaDeDesarrollo($idDocente)
    {
        // Obtener la fecha actual
        date_default_timezone_set('America/La_Paz');
        $fechaActual = date('Y-m-d');
        $fechaActual = new DateTime($fechaActual);

        $consulta = DB::select("SELECT min(e.fecha_inicio_etapa) as inicio_etapa, max(e.fecha_fin_etapa) as fin_etapa
        FROM docente d, grupo_materia gm, semestre se, grupo gr, proyecto pr, etapa e
        WHERE d.id_usuario = gm.id_usuario
        AND gm.id_semestre = se.id_semestre
        AND gr.id_grupo = pr.id_grupo
        AND pr.id_proyecto = e.id_proyecto
        AND d.id_usuario = ?
        AND CURRENT_DATE >= se.fecha_inicio_semestre 
        AND CURRENT_DATE <= se.fecha_fin_semestre
        AND e.nombre_etapa = 'Desarrollo'", array($idDocente));

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
}
