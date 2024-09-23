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

    public function editarActividadesRealizadas(Request $request)
    {
        $actividades_realizadas = $request->input('idActividadRealizada', []);
        $actividades_no_realizadas = $request->input('idActividadNoRealizado', []);
        self::editarActividades($actividades_realizadas, $actividades_no_realizadas);
    }

    private static function editarActividades($actividades_realizadas, $actividades_no_realizadas)
    {
        if (count($actividades_realizadas) > 0) {
            foreach ($actividades_realizadas as $id_realizado) {
                DB::update("UPDATE actividad set realizado = TRUE WHERE id_actividad = ?", array($id_realizado));
            }
        }
        if (count($actividades_no_realizadas) > 0) {
            foreach ($actividades_no_realizadas as $id_no_realizado) {
                DB::update("UPDATE actividad set realizado = FALSE WHERE id_actividad = ?", array($id_no_realizado));
            }
        }
    }

    private static function filasActividades($id)
    {
        $consulta = DB::select("SELECT ac.id_actividad, ac.descripcion_actividad, ac.realizado, ac.resultado,
                    (SELECT concat(nombre_estudiante, ' ',apellido_estudiante) AS responsable FROM estudiante WHERE id_estudiante = ac.id_estudiante)
                    FROM actividad ac
                    WHERE ac.id_objetivo = ?
                    ORDER BY ac.id_actividad ASC", array($id));
        return $consulta;
    }
}
