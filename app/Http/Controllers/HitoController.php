<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HitoController extends Controller
{
    public function registroHitos($id_estudiante)
    {
         // Validar que el proyecto exista
         $id_proyecto = $this->get_idProyecto ($id_estudiante);
         $proyecto = DB::table('proyecto')->where('id_proyecto', $id_proyecto)->first();
         if (!$id_proyecto) {
             return redirect()->back()->withErrors('El proyecto no existe.');
         }
        
         // Obtener los hitos asociados al proyecto
       /* $hitos = DB::select("
            SELECT h.id_hito, h.numero_hito, h.fecha_inicio_hito, h.fecha_fin_hito, h.porcentaje_cobro 
            FROM hito h
            WHERE h.id_proyecto = ?", [$id_proyecto]);*/
        $hitos = collect(DB::select("
            SELECT h.id_hito, h.numero_hito, h.fecha_inicio_hito, h.fecha_fin_hito, h.porcentaje_cobro 
            FROM hito h
            WHERE h.id_proyecto = ?", [$id_proyecto]));
           

        return view('registro_hitos', compact('id_proyecto','hitos','proyecto','id_estudiante'));
    }
    private function get_idProyecto($id_estudiante){
        $respuesta = DB::select(
            "SELECT pr.id_proyecto
             FROM proyecto pr, estudiante es, estudiante_grupoempresa egr, grupo_empresa ge
             WHERE es.id_usuario = egr.id_usuario 
             AND egr.id_grupo_empresa = ge.id_grupo_empresa 
             AND ge.id_grupo_empresa = pr.id_grupo_empresa 
             AND es.id_usuario = ?", [$id_estudiante]
        );
        
        // Verifica si la consulta devolvió resultados
        if (!empty($respuesta)) {
            // Extraer `id_proyecto` del primer resultado
            return $respuesta[0]->id_proyecto;
        } else {
            return null; // Retorna null si no hay resultados
        }
        
    }
    public function store(Request $request, $id_proyecto)
    {
        // Validar que el proyecto exista
        $proyecto = DB::table('proyecto')->where('id_proyecto', $id_proyecto)->first();
        if (!$proyecto) {
            return redirect()->back()->withErrors('El proyecto no existe.');
        }

        // Obtener el último hito registrado (si existe)
        $ultimo_hito = DB::table('hito')
            ->where('id_proyecto', $id_proyecto)
            ->orderBy('fecha_fin_hito', 'desc')
            ->first();

         // Calcular el número del nuevo hito
        $nuevo_numero_hito = $ultimo_hito ? $ultimo_hito->numero_hito + 1 : 1;

            // Validaciones
        $request->validate([
            'fecha_inicio_hito' => 'required|date',
            'fecha_fin_hito' => 'required|date|after:fecha_inicio_hito|before_or_equal:' . $proyecto->fecha_fin_proyecto,
            'porcentaje_cobro' => 'required|integer|min:0|max:100',
        ]);

        // Validar que la fecha de inicio sea después de la fecha de fin del último hito
        if ($ultimo_hito && Carbon::parse($request->fecha_inicio_hito)->lte(Carbon::parse($ultimo_hito->fecha_fin_hito))) {
            return redirect()->back()->withErrors([
                'fecha_inicio_hito' => 'La fecha de inicio debe ser después de la última fecha de fin del hito: ' . Carbon::parse($ultimo_hito->fecha_fin_hito)->format('d/m/Y')
            ]);
        }

        // Validar que la suma del porcentaje de cobro no exceda el 100%
        $suma_cobros = DB::table('hito')
            ->where('id_proyecto', $id_proyecto)
            ->sum('porcentaje_cobro');

        if (($suma_cobros + $request->porcentaje_cobro) > 100) {
            return redirect()->back()->withErrors([
                'porcentaje_cobro' => 'El porcentaje total de cobro no debe exceder el 100%. El total actual es: ' . $suma_cobros . '%.'
            ]);
        }

        // Guardar el nuevo hito
        DB::table('hito')->insert([
            'id_proyecto' => $id_proyecto,
            'numero_hito' => $nuevo_numero_hito,
            'fecha_inicio_hito' => $request->fecha_inicio_hito,
            'fecha_fin_hito' => $request->fecha_fin_hito,
            'porcentaje_cobro' => $request->porcentaje_cobro,
        ]);

        return redirect()->back()->with('success', 'Hito registrado correctamente.');
    }
}
