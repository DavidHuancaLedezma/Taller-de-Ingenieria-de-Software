<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControllerEvaluacionPares extends Controller
{
    public function evaluacionPares($idEvaluacionPares)
    {
        return view("tipos_evaluaciones/evaluacion_pares");
    }
}
