<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ControllerHome extends Controller
{
    public function openHome($idEstudiante)
    {
        $autoevaluacion = self::autoevaluacionRealizada($idEstudiante);
        return view("home", ['idEstudinte' => $idEstudiante, 'autoevaluacion' => $autoevaluacion]);
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
}
