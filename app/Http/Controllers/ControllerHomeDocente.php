<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ControllerHomeDocente extends Controller
{
    public function openHomeDocente($idDocente)
    {
        $nombre_docente = self::getnombreDocente($idDocente);
        $fechaActual = Carbon::now()->format('M j, Y');
        $grupoEmpresas = self::getGrupoEmpresas($idDocente);

        return view("home_docente", ['idDocente' => $idDocente,'nombre_docente'=>$nombre_docente,'fechaActual'=>$fechaActual,
                    'grupoEmpresas'=> $grupoEmpresas]);
    }
    private function getnombreDocente($idDocente)
    {
        $consulta = DB::select("
            SELECT nombre_docente, apellido_docente
            FROM docente
            WHERE id_usuario = ?", [$idDocente]
        );

        // Verificamos si se obtuvo un resultado
        if ($consulta && count($consulta) > 0) {
            return $consulta[0]->nombre_docente . ' ' . $consulta[0]->apellido_docente;
        }
        
        return null;  // Retornamos null si no se encuentra el estudiante
    }
    private function getGrupoEmpresas($idDocente){
        $grupoEmpresas=DB:: select('
        select gre.id_grupo_empresa,gre.nombre_corto,  coalesce(pr.nombre_proyecto, \'Proyecto no asignado\') as nombre_proyecto
        from grupo_empresa gre, proyecto pr, grupo gr,grupo_materia gm
        where pr.id_grupo_empresa = gre.id_grupo_empresa and pr.id_grupo = gr.id_grupo and
        gr.id_grupo = gm.id_grupo and gm.id_usuario = ?
        ', [$idDocente]);

        return !empty($grupoEmpresas) ? $grupoEmpresas : null;
    } 

}
