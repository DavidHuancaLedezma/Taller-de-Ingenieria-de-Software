<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ControllerObjetivos extends Controller
{
    public function cargarObjetivos(Request $request)
    {
        $datos = request()->except('_token');
        $id_hito = $datos['id_hito'];
        $objetivos = DB::select("SELECT id_objetivo, descrip_objetivo FROM objetivo WHERE id_hito = ?", array($id_hito));

        return view('objetivos', ['objetivos' => $objetivos]);
    }

    public function getActividades(Request $request)
    {
        $id_actividad = $request->input('id');
        $actividades = self::filasActividades($id_actividad);
        return response(json_encode($actividades), 200)->header('Content-type', 'text/plain');
    }
    private static function filasActividades($id)
    {
        $consulta = DB::select("SELECT ac.id_actividad, ac.descripcion_actividad,
                    (SELECT concat(nombre_estudiante, ' ',apellido_estudiante) AS responsable FROM estudiante WHERE id_estudiante = ac.id_estudiante)
                    FROM actividad ac
                    WHERE ac.id_objetivo = ?", array($id));
        return $consulta;
    }
}
