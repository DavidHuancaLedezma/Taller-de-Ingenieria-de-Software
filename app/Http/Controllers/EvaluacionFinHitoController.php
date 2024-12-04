<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EvaluacionFinHitoController extends Controller
{
    public function store(Request $request, $id_hito)
    {   //dd($request->all());
        $request->validate([
            'asistencia' => 'array',
            'faltas' => 'array',
            'descripcion_control_semanal' => 'required|string',
            'fechaInicio' => 'required|date',
            'fechaFin' => 'required|date',
            'evaluar' => 'array',
            'historias'=> 'array',
            'nuevas_historias' => 'array',
            
        ]);
           // Obtener los datos del formulario
        $asistencias = $request->input('asistencia', []); 
        $faltas = $request->input('faltas', []);
        $descripcion = $request->input('descripcion_control_semanal');
        $fechaInicio = $request->input('fechaInicio');
        $fechaFin = $request->input('fechaFin');
        $evaluar = $request ->input('evaluar',[]);
        $historias = $request -> input('historias', []);
        $nuevas_historias = $request -> input ('nuevas_historias',[]);
        
        if (!$descripcion) {
            $respuesta = "Por favor añada una observación al registro de final de hito.";
          
            return redirect()->back()->with('error', $respuesta);
        }

         // Obtener el id del proyecto
        $idProyecto = DB::select("SELECT id_proyecto FROM hito WHERE id_hito = ?", array($id_hito));
        $idProyecto = $idProyecto[0]->id_proyecto;
 
        // Llamar a la función para registrar el control semanal
        $controlRegistrado = $this->registrarControlSemanal($id_hito,$idProyecto, $descripcion, $fechaInicio, $fechaFin);
        if (!$controlRegistrado) {
            $respuesta = "Error al registrar el control semanal.";
          
            return redirect()->back()->with('error', $respuesta);
        }
            // Obtener el id del control_semanal registrado
            $idControlSemanal = DB::select("SELECT max(id_control_semanal) as id_control_semanal FROM control_semanal");
            $idControlSemanal = $idControlSemanal[0]->id_control_semanal;
        
                // Llamar a la función para registrar las asistencias
            $asistenciaRegistrada = $this->registrarAsistencia($idControlSemanal, $asistencias,$faltas);
        
            if (!$asistenciaRegistrada) {
                $respuesta = "Error al registrar la asistencia.";
                return redirect()->back()->with('error', $respuesta);
            } 
            // Actualizar objetivos
            if (!$this->actualizarObjetivos($evaluar)) {
                DB::rollBack();
                return redirect()->back()->with('error', 'Error al actualizar los entregables.');
            }
            // Actualizar historias de usuario
            if ($request->has('historias') && !$this->actualizarHistoriasUsuario($request->input('historias'))) {
                DB::rollBack();
                return redirect()->back()->with('error', 'Error al actualizar historias de usuario.');
            }

            $hu_duplicado = $this->verificar_duplicado($idProyecto,$nuevas_historias);
            if ($hu_duplicado) {
                $respuesta = "La historia de usuario añadida ya esxiste en el proyecto";
                return redirect()->back()->with('error', $respuesta);
            } 
            // Insertar nuevas historias de usuario
            if ($request->has('nuevas_historias') && !$this->guardarNuevasHistoriasUsuario($idProyecto, $id_hito, $request->input('nuevas_historias'))) {
                DB::rollBack();
                return redirect()->back()->with('error', 'Error al guardar nuevas historias de usuario.');
            }
            
            
        return redirect()->back()->with('success', 'Registro exitoso');
        
    }
    private function registrarControlSemanal($idHito ,$idProyecto, $descripcion, $fechaInicio, $fechaFin)
    {
        try {

            if (strlen($descripcion) > 500 || empty($descripcion)) {
                return false;
            }
            // Obtener la fecha actual
            date_default_timezone_set('America/La_Paz');
            $fechaActual = date('Y-m-d');
    
            // Insertar en control_semanal
            DB::insert("INSERT INTO control_semanal (id_proyecto, id_hito, control_semanal, fecha_ini_semana, fecha_fin_semana, fecha_registro_semanal)
            VALUES (?,?,?,?,?,?)", array($idProyecto, $idHito, $descripcion, $fechaInicio, $fechaFin, $fechaActual));
    
            return true; // Registro exitoso
        } catch (\Exception $e) {
            // Manejar el error si ocurre
            return false; // Registro fallido
        }
    }
    private function registrarAsistencia($idControlSemanal, $asistencias, $faltas)
    {
        
        try {

                // Luego, insertar las faltas (FALSE) solo si no están ya en asistencias
            if (count($faltas) > 0 and count($asistencias) > 0) {
                foreach ($faltas as $idEstudianteFalta) {
                    if (!in_array($idEstudianteFalta, $asistencias)) {
                        // Si no está en las asistencias, se inserta el registro de falta
                        DB::insert("INSERT INTO asistencia (id_usuario, asistio, id_control_semanal) VALUES (?,?,?)", 
                        [$idEstudianteFalta, FALSE, $idControlSemanal]);
                    }
                }
                foreach ($asistencias as $idEstudiante) {
                    DB::insert("INSERT INTO asistencia (id_usuario, asistio, id_control_semanal) VALUES (?,?,?)", 
                    [$idEstudiante, TRUE, $idControlSemanal]);
                }
            }
        
                return true; // Registro exitoso
        } catch (\Exception $e) {
            // Manejar el error si ocurre
            return false; // Registro fallido
        }
    }
    private function actualizarObjetivos($evaluar)
    {
        foreach ($evaluar as $id_objetivo) {
            $actualizado = DB::table('objetivo')
            ->where('id_objetivo', $id_objetivo)
            ->update(['entregado_ob' => true]);

            if (!$actualizado) {
                return false;
            }
        }
        return true;
    }
    private function actualizarHistoriasUsuario($historias)
    {
        foreach ($historias as $historia) {
            $idHU =$historia['idHU'];
            $descripcion_hu = $historia['descripcion'] ?? '';
            $done = isset($historia['done']) ? 1 : 0;

            $actualizado = DB::table('historia_usuario')
                ->where('id_hu', $idHU)
                ->update([
                    'descripcion_eva_hu' => $descripcion_hu,
                    'done' => $done,
                ]);

            if (!$actualizado) {
                return false;
            }
        }
        return true;
    }
    private function verificar_duplicado($idProyecto,$nuevas_historias){
        //$historias_proyecto = DB::select('SELECT titulo_hu FROM historia_usuario WHERE id_proyecto = ?', [$idProyecto]);
        $historias_proyecto = DB::table('historia_usuario')
        ->where('id_proyecto', $idProyecto)
        ->pluck('titulo_hu') 
        ->toArray();

        // Iterar sobre las nuevas historias de usuario
        foreach ($nuevas_historias as $historia) {
            $titulo_hu = $historia['titulo'] ?? '';
            if (in_array($titulo_hu, $historias_proyecto)) {
               
                return true;
            }
        }
        return false;
    }
    private function guardarNuevasHistoriasUsuario($idProyecto, $idHito, $nuevasHistorias)
    {
        foreach ($nuevasHistorias as $nuevaHistoria) {
            $titulo = $nuevaHistoria['titulo'] ?? '';
            $estimacion = $nuevaHistoria['estimacion'] ?? '';
            $descripcion_hu = $nuevaHistoria['descripcion'] ?? '';
            $done = isset($nuevaHistoria['done']) ? 1 : 0;


            // Validar que el título no sea nulo, vacío y que no exceda los 100 caracteres
            if (empty($titulo) || strlen($titulo) > 100) {
                return false; // Título inválido
            }

            // Validar que la estimación sea un valor numérico
            if (!is_numeric($estimacion)) {
                return false; // Estimación inválida
            }
            $insertado = DB::table('historia_usuario')->insert([
                'id_proyecto' => $idProyecto,
                'id_hito' => $idHito,
                'titulo_hu' => $titulo,
                'estimacion_hu' => $estimacion,
                'descripcion_eva_hu' => $descripcion_hu,
                'done' => $done,
            ]);

            if (!$insertado) {
                return false;
            }
        }
        return true;
    }

}
