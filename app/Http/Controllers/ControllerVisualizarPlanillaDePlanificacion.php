<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ControllerVisualizarPlanillaDePlanificacion extends Controller
{
    public function visualizarPlanilla($idPlanillaProyecto)
    {

        try {
            //Todo funciona unicamente teniendo el id de la entidad proyecto
            $idProyecto = $idPlanillaProyecto;

            $planilla = self::getDetalleDePlanilla($idProyecto);
            $objetivos = self::getObjetivos($planilla);
            $planillaCompleta = self::getPlanillaCompleta($planilla, $objetivos);
            $nombreCorto = self::getNombreCortoGE($idProyecto);
            return view('visualizarPlanillaDePlanificacion', ['planillaCompleta' => $planillaCompleta, 'nombreCorto' => $nombreCorto]);
        } catch (\Exception $e) {
            return "ERROR 404";
        }
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
}
