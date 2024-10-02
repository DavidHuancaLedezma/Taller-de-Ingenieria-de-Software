<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ControllerTablaPlanificacion extends Controller
{
    public function getTabla()
    {
        //cambiar el id del proyecto, esta estico ahora y no dinamico para hacer la consulta
        $datos = DB::select("SELECT h.id_hito, h.numero_hito, h.fecha_inicio_hito, h.fecha_fin_hito FROM hito h, proyecto pr WHERE h.id_proyecto = pr.id_proyecto AND pr.id_proyecto = 1");
        return view('tablaPlanificacion', ['hitos' => $datos]);
    }
}
