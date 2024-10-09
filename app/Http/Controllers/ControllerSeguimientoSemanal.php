<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ControllerSeguimientoSemanal extends Controller
{
    public function cargarSS(Request $request)
    {
        $datos = request()->except('_token');
        $id_hito = $datos['id_hito'];
        //logica
        $objetivos = DB::select("SELECT descrip_objetivo FROM objetivo WHERE id_hito = ?", array($id_hito));
        $integrantes = self::getEstudiantes($id_hito);

        $semanas_registradas = self::getSemanasRegistradas($id_hito);

        return view('seguimientoSemanal', ['objetivos' => $objetivos, 'integrantes' => $integrantes, 'id_hito' => $id_hito, 'semanas_registradas' => $semanas_registradas]);
    }

    public function registroSemana(Request $request)
    {
        //TODO ESTE METODO SU CODIGO ES TRABAJANDO CON AJAX
        //Modificar que fechas se guardaran ahora esta solo con fechas por defecto
        $id_hito = $request->input('id_hito');
        $descripcion = $request->input('descripcion');

        $estudiantes_con_asistencias = $request->input('asistencias', []);
        $estudiantes_con_faltas = $request->input('faltas', []);

        $semana_insertada = DB::insert("INSERT INTO control_semanal (control_semanal, fecha_ini_semana, fecha_fin_semana,fecha_registro_semanal, id_hito) VALUES (?,?,?,?,?)", array($descripcion, '01-01-2000', '02-01-2000', '01-01-2024', $id_hito));
        if ($semana_insertada) {
            $id_semana_actual_insertada = DB::select("SELECT max(id_control_semanal) as id_control_semanal FROM control_semanal");
            self::registroDeAsistencias($estudiantes_con_asistencias, $estudiantes_con_faltas, $id_semana_actual_insertada);

            $nuevas_filas_de_tabla_semanas = self::getSemanasRegistradas($id_hito);
            return response(json_encode($nuevas_filas_de_tabla_semanas), 200)->header('Content-type', 'text/plain');
        } else {
            return false;
        }
    }

    private static function getEstudiantes($id_hito)
    {
        $consulta = DB::select("SELECT e.id_estudiante, e.nombre_estudiante, e.apellido_estudiante FROM estudiante e, estudiante_grupoempresa ege, grupo_empresa ge, proyecto pr, hito h 
        WHERE e.id_estudiante = ege.id_estudiante
        AND ege.id_grupo_empresa = ge.id_grupo_empresa
        AND ge.id_grupo_empresa = pr.id_grupo_empresa
        AND pr.id_proyecto = h.id_proyecto
        AND h.id_hito = ?", array($id_hito));

        return $consulta;
    }

    private static function getSemanasRegistradas($id_hito)
    {
        //esto puede ir cambiando depende los datos que necesitemos en la tabla de semanas
        $semanas = DB::select("SELECT row_number() OVER (ORDER BY cs.id_control_semanal) AS numero_semana, cs.control_semanal, h.id_hito, cs.id_control_semanal
        FROM control_semanal cs, hito h 
        WHERE cs.id_hito = h.id_hito
        AND h.id_hito = ?", array($id_hito));
        return $semanas;
    }

    private static function registroDeAsistencias($estudiantes_con_asistencias, $estudiantes_con_faltas, $id_control_semanal)
    {
        $id_control_semanal = $id_control_semanal[0]->id_control_semanal;
        if (count($estudiantes_con_asistencias) > 0) {
            foreach ($estudiantes_con_asistencias as $id_estudiante) {
                DB::insert("INSERT INTO asistencia (id_estudiante, id_control_semanal, asistio) VALUES (?,?,?)", array($id_estudiante, $id_control_semanal, TRUE));
            }
        }
        if (count($estudiantes_con_faltas) > 0) {
            foreach ($estudiantes_con_faltas as $id_estudiante) {
                DB::insert("INSERT INTO asistencia (id_estudiante, id_control_semanal, asistio) VALUES (?,?,?)", array($id_estudiante, $id_control_semanal, FALSE));
            }
        }
    }
}
