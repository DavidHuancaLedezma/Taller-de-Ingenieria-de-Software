<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlanillaEvaluacionController extends Controller
{
    public function create($idDocente)
    {
        $tipos_evaluacion = DB:: select(
            "select * from tipo_evaluacion"
        );
        $grupoEmpresas = self::getGrupoEmpresas($idDocente);
        $criterios_evaluacion= DB:: select(
            "select * from criterio_evaluacion"
        );
        $parametros=DB:: select(
            "select * from parametro_evaluacion"
        );
        $escalas=DB:: select(
            "select * from escala_medicion"
        );
        return view('planilla_evaluacion.planilla_evaluacion', compact('tipos_evaluacion','grupoEmpresas','criterios_evaluacion', 'parametros', 'escalas'));
    }

    private static function getGrupoEmpresas($idDocente)
    {
        $consulta = DB::select("SELECT ge.nombre_corto, ge.id_grupo_empresa, ege.periodo_grupoempresa
        FROM grupo_empresa ge, estudiante_grupoempresa ege, proyecto pr, grupo gr, grupo_materia gm, docente doc
        WHERE ge.id_grupo_empresa = ege.id_grupo_empresa
        AND pr.id_grupo_empresa = ge.id_grupo_empresa
        AND pr.id_grupo = gr.id_grupo
		AND gr.id_grupo = gm.id_grupo
		AND gm.id_usuario = doc.id_usuario
		AND doc.id_usuario = ?
        AND ege.periodo_grupoempresa = '2-2024'
        GROUP BY ge.nombre_corto, ge.id_grupo_empresa, ege.periodo_grupoempresa
        ORDER BY ge.id_grupo_empresa ASC", array($idDocente));
        return $consulta;
    }
}
