<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HitoController extends Controller
{
    public function registroHitos($id_proyecto)
    {
         // Validar que el proyecto exista
        $proyecto = DB::table('proyecto')->where('id_proyecto', $id_proyecto)->first();
        if (!$proyecto) {
            return redirect()->back()->withErrors('El proyecto no existe.');
        }
 
         // Obtener los hitos asociados al proyecto
        $hitos = DB::select("
            SELECT h.id_hito, h.numero_hito, h.fecha_inicio_hito, h.fecha_fin_hito 
            FROM hito h
            WHERE h.id_proyecto = ?", [$id_proyecto]);
            
        return view('registro_hitos', compact('id_proyecto','hitos'));
    }
}
