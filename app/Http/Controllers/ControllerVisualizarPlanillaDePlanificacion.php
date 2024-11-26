<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ControllerVisualizarPlanillaDePlanificacion extends Controller
{
    public function visualizarPlanilla($idPlanillaProyecto, $idDocente)
    {

        try {
            //Todo funciona unicamente teniendo el id de la entidad proyecto
            if ($idPlanillaProyecto != 0) {
                $idProyecto = $idPlanillaProyecto;

                $planilla = self::getDetalleDePlanilla($idProyecto);


                $porcentaje = self::getPorcentajePlanilla($planilla);

                if ($porcentaje == 100) {
                    $objetivos = self::getObjetivos($planilla);
                    $planillaCompleta = self::getPlanillaCompleta($planilla, $objetivos);
                    $nombreCorto = self::getNombreCortoGE($idProyecto);
                    $grupoEmpresas = self::getGrupoEmpresas($idDocente);
                    return view('visualizarPlanillaDePlanificacion', ['planillaCompleta' => $planillaCompleta, 'nombreCorto' => $nombreCorto, 'grupoEmpresas' => $grupoEmpresas, 'idDocente' => $idDocente]);
                } else {
                    $grupoEmpresas = self::getGrupoEmpresas($idDocente);
                    $nombreCorto = self::getNombreCortoGE($idProyecto);
                    return view('visualizarPlanillaDePlanificacionIncompleta', ['grupoEmpresas' => $grupoEmpresas, 'idDocente' => $idDocente, 'nombreCorto' => $nombreCorto]);
                }
            } else {
                //otra ventana de inicio
                $grupoEmpresas = self::getGrupoEmpresas($idDocente);
                return view('visualizarPlanillaDePlanificacionInicio', ['grupoEmpresas' => $grupoEmpresas, 'idDocente' => $idDocente]);
            }
        } catch (\Exception $e) {
            return "ERROR 404";
        }
    }

    public function getIdProyectoDeGrupoEmpresa(Request $request)
    {
        $idGrupoEmpresa = $request->input("idGrupoEmpresa");
        $consulta = DB::select("SELECT ge.id_grupo_empresa, ge.nombre_corto, pr.id_proyecto 
        FROM grupo_empresa ge, proyecto pr
        WHERE ge.id_grupo_empresa = pr.id_grupo_empresa
        AND ge.id_grupo_empresa = ?", array($idGrupoEmpresa));

        return response(json_encode($consulta[0]->id_proyecto), 200)->header('Content-type', 'text/plain');
    }

    private static function getPorcentajePlanilla($planilla)
    {
        $porcentaje = 0;
        foreach ($planilla as $item) {
            $porcentaje = $porcentaje + $item->porcentaje_cobro;
        }
        return $porcentaje;
    }

    private static function getNombreCortoGE($idProyecto)
    {
        $consulta = DB::select("SELECT ge.nombre_corto FROM grupo_empresa ge, proyecto pr 
        WHERE ge.id_grupo_empresa = pr.id_grupo_empresa
        AND pr.id_proyecto = ?", array($idProyecto));
        return $consulta[0]->nombre_corto;
    }

    private static function getPlanillaCompleta($planilla, $objetivos)
    {
        $planillaCompleta = [];
        for ($i = 0; $i < count($planilla); $i++) {
            $planillaCompleta[] = array($planilla[$i], $objetivos[$i]);
        }

        return $planillaCompleta;
    }

    private static function getDetalleDePlanilla($idProyecto)
    {
        //capturar el porcentaje de cobro de la base de datos
        $consulta = DB::select("SELECT h.id_hito, h.numero_hito, h.fecha_inicio_hito, h.fecha_fin_hito, h.porcentaje_cobro  
        FROM proyecto pr, hito h
        WHERE pr.id_proyecto = h.id_proyecto
        AND h.id_proyecto = ?", array($idProyecto));
        return $consulta;
    }

    private static function getObjetivos($planilla)
    {
        $lista = [];
        foreach ($planilla as $fila) {
            $consulta = DB::select("SELECT descrip_objetivo FROM objetivo WHERE id_hito = ?", array($fila->id_hito));
            $lista[] = $consulta;
        }
        return $lista;
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
