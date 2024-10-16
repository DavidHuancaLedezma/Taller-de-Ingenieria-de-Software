<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ControllerEvaluacionCruzada extends Controller
{
    public function evaluacionCruzada($idEvaluacionCruzada)
    {
        $grupoEmpresas = self::getGrupoEmpresas($idEvaluacionCruzada);
        return view("tipos_evaluaciones/evaluacion_cruzada", ['grupoEmpresas' => $grupoEmpresas]);
    }

    public function guardarNotaGrupoEmpresas(Request $request)
    {
        $notas = $request->input('notas');

        
        if (is_array($notas)) {
            
            foreach ($notas as $nota) {
                $idEmpresa = $nota['id'];
                $valorNota = $nota['nota'];

                $idEstudianteEvaluado = DB::select("SELECT e.id_usuario FROM estudiante e, estudiante_grupoempresa ege, grupo_empresa ge
                WHERE e.id_usuario = ege.id_usuario
                AND ge.id_grupo_empresa = ege.id_grupo_empresa
                AND ge.id_grupo_empresa = ?
                LIMIT 1", array($idEmpresa)); //Estudiante evaluado (su grupo empresa)

                $idEstudianteEvaluado = $idEstudianteEvaluado[0]->id_usuario;
            }
            return response(json_encode($valorNota . "---" . $idEmpresa), 200)->header('Content-type', 'text/plain');
        }
    }

    private static function getGrupoEmpresas($idGrupoEmpresa)
    {
        $grupoEmpresas = DB::select("SELECT ge.id_grupo_empresa, ge.nombre_corto 
        FROM grupo_empresa ge, estudiante_grupoempresa ege
        WHERE ge.id_grupo_empresa = ege.id_grupo_empresa 
        AND ege.periodo_grupoempresa = 
        (SELECT periodo_grupoEmpresa
        FROM estudiante_grupoEmpresa
        WHERE id_grupo_empresa = ?
        GROUP BY periodo_grupoempresa )
        AND ge.id_grupo_empresa != ?
        GROUP BY ge.id_grupo_empresa, ge.nombre_corto", array($idGrupoEmpresa, $idGrupoEmpresa));
        return $grupoEmpresas;
    }
}
