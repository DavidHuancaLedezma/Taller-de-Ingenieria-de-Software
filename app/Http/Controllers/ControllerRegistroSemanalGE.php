<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use DateTime;
use DateInterval;
use Exception;

class ControllerRegistroSemanalGE extends Controller
{
    public function cargarRegistroSemanal($parametroHito, $idDocente)
    {
        // 6 y 7 test
        try {

            if ($parametroHito != 0) {
                //Ventana que estaba por defecto(Venata con informacion del control semanal)
                //Todo funciona unicamente con el id de un hito
                $idHito = $parametroHito; // Reemplazar con hito que nos mandaran
                $objetivos = self::getObjetivos($idHito);
                $nombreEstudiante = self::getEstudiantes($idHito);
                $estudianteEnAlerta = self::getEstudiantesConFaltas($nombreEstudiante);
                $semanas = self::getSemanasDivididas($idHito);

                $enProgreso = self::getSemanaActual($semanas, $idHito);
                $numeroColor = self::numeroColoreado($semanas, $idHito);
                $nombreCorto = self::getNombreEmpresa($idHito);
                $numeroDeHito = self::getNumeroDeHito($idHito);

                $mostrarMensaje = self::verificarSemanaCalificadaMensaje($idHito, $enProgreso);
                // Verificar si es la última semana del hito
                $semanaActual = self::getSemanaActual($semanas, $idHito);
                $ultimaSemana = end($semanas); // Obtener la última semana del hito
                $criteriosDeAceptacion = self::getCriteriosDeAceptacion($idHito);
                $historiaUsuario = self::getHistoriaUsuario($idHito);

                if ($semanaActual[0] === $ultimaSemana['inicio'] && $semanaActual[1] === $ultimaSemana['fin']) {
                    // Redirigir a la vista de evaluación final del hito
                    //return redirect()->route('evaluacion_final_hito', ['idHito' => $idHito]);
                    $grupoEmpresas = self::getGrupoEmpresas($idDocente);
                    return view('evaluacion_final_hito', compact(
                        'idHito',
                        'objetivos',
                        'nombreEstudiante',
                        'estudianteEnAlerta',
                        'semanas',
                        'enProgreso',
                        'semanaActual',
                        'numeroColor',
                        'numeroDeHito',
                        'nombreCorto',
                        'criteriosDeAceptacion',
                        'historiaUsuario',
                        'mostrarMensaje',
                        'grupoEmpresas',
                        'idDocente'
                    ));
                }

                $grupoEmpresas = self::getGrupoEmpresas($idDocente);
                return view('registroSemanalGE', ['idHito' => $idHito, 'objetivos' => $objetivos, 'estudianteEnAlerta' => $estudianteEnAlerta, 'semanas' => $semanas, 'enProgreso' => $enProgreso, 'numeroColor' => $numeroColor, 'nombreCorto' => $nombreCorto, 'numeroDeHito' => $numeroDeHito, 'mostrarMensaje' => $mostrarMensaje, 'grupoEmpresas' => $grupoEmpresas, 'idDocente' => $idDocente]);
            } else {
                //otra ventana de inicio
                $grupoEmpresas = self::getGrupoEmpresas($idDocente);
                return view("registro_semanal_inicio", ['grupoEmpresas' => $grupoEmpresas, 'idDocente' => $idDocente]);
            }
        } catch (\Exception $e) {
            return "ERROR 404";
        }
    }
    public function registrarSeguimiento(Request $request)
    {
        $descripcion = $request->input('descripcion');
        $asistencias = $request->input('asistencias', []);
        $faltas = $request->input('faltas', []);
        $idHito = $request->input('idHito');
        $verificarSemana = $request->input('verificarSemana');

        $respuesta = "";

        // inicio del codigo para restringir un solo registro por semana del hito
        if (count($verificarSemana) == 2) {
            $registrado = self::verificarSemanaRegistrada($idHito, $verificarSemana);
            if ($registrado == false) {
                self::registrarSeguimientoDB($idHito, $descripcion, $asistencias, $faltas, $verificarSemana[0], $verificarSemana[1]);
                $respuesta = "Registro semanal guardado en fecha: " . $verificarSemana[0] . " al " . $verificarSemana[1] . "1";
            } else {
                $respuesta = "La semana en fecha: " . $verificarSemana[0] . " al " . $verificarSemana[1] . " ya fue registrada2";
            }
        } else {
            if ($verificarSemana[0] == "Hito no iniciado") {
                $respuesta = "El hito no inicio, por lo cual no puede registrar el seguimiento2";
            } else {
                $respuesta = "El hito finalizo, no es posible hacer el registro del seguimiento2";
            }
        }
        //fin del codigo

        return response(json_encode($respuesta), 200)->header('Content-type', 'text/plain');

        //self::registrarSeguimientoDB($idHito, $descripcion, $asistencias, $faltas);
    }

    public function getIdHitoComboxSeleccionado(Request $request)
    {
        $idGrupoEmpresa = $request->input("idGrupoEmpresa");
        date_default_timezone_set('America/La_Paz');
        $fechaActual = date('Y-m-d');

        $consulta = DB::select("SELECT ge.id_grupo_empresa, ge.nombre_corto, pr.id_proyecto, h.id_hito, h.fecha_inicio_hito, h.fecha_fin_hito
        FROM grupo_empresa ge, proyecto pr, hito h
        WHERE ge.id_grupo_empresa = pr.id_grupo_empresa
        AND pr.id_proyecto = h.id_proyecto
        AND ge.id_grupo_empresa = ?
        AND ? >= h.fecha_inicio_hito
        AND ? <= h.fecha_fin_hito", array($idGrupoEmpresa, $fechaActual, $fechaActual));
        if (count($consulta) > 0) {
            $idHito = $consulta[0]->id_hito;
        } else {
            //Primera fecha de hito(hito que no inicio)
            $consulta = DB::select("SELECT pr.id_proyecto, h.id_hito, h.numero_hito, h.fecha_inicio_hito, h.fecha_fin_hito, ge.nombre_corto 
            FROM hito h, grupo_empresa ge, proyecto pr
            WHERE ge.id_grupo_empresa = pr.id_grupo_empresa
            AND pr.id_proyecto = h.id_proyecto
            AND ge.id_grupo_empresa = ?
            ORDER BY h.id_hito ASC", array($idGrupoEmpresa));

            $primeraFechaInicioGE = $consulta[0]->fecha_inicio_hito;
            $primeraFechaInicioGE = new DateTime($primeraFechaInicioGE);
            $fechaActualBolivia = new DateTime($fechaActual);
            if ($fechaActualBolivia >= $primeraFechaInicioGE) {
                //ultima fecha de hito(hito que finalizo)
                $consulta = DB::select("SELECT max(h.id_hito) as id_hito
                FROM hito h, grupo_empresa ge, proyecto pr
                WHERE ge.id_grupo_empresa = pr.id_grupo_empresa
                AND pr.id_proyecto = h.id_proyecto
                AND ge.id_grupo_empresa = ?", array($idGrupoEmpresa));
            }
        }
        $idHito = $consulta[0]->id_hito;
        return response(json_encode($idHito), 200)->header('Content-type', 'text/plain');
    }

    private static function verificarSemanaCalificadaMensaje($idHito, $verificarSemana)
    {
        //Determina si mostrar el mensaje para una semana que ya fue calificada
        $registrado = false;
        if (count($verificarSemana) == 2) {
            $registrado = self::verificarSemanaRegistrada($idHito, $verificarSemana);
        }
        return $registrado;
    }

    private static function getNumeroDeHito($idHito)
    {
        $consulta = DB::select("SELECT numero_hito FROM hito WHERE id_hito = ?", array($idHito));
        return $consulta[0]->numero_hito;
    }


    private static function getNombreEmpresa($idHito)
    {
        $consulta = DB::select("SELECT ge.nombre_corto FROM hito h, proyecto pr, grupo_empresa ge
        WHERE h.id_proyecto = pr.id_proyecto
        AND pr.id_grupo_empresa = ge.id_grupo_empresa
        AND h.id_hito = ?", array($idHito));
        return $consulta[0]->nombre_corto;
    }

    private static function verificarSemanaRegistrada($idHito, $verificarSemana)
    {
        $registrado = false;
        $consulta = DB::select("SELECT * FROM control_semanal WHERE id_hito = ? AND fecha_ini_semana = ? AND fecha_fin_semana = ?", array($idHito, $verificarSemana[0], $verificarSemana[1]));
        if (count($consulta) > 0) {
            $registrado = true;
        }
        return $registrado;
    }


    private static function numeroColoreado($semanasExistentes, $idHito)
    {
        // Obtener la fecha actual
        date_default_timezone_set('America/La_Paz');
        $fechaActual = date('Y-m-d');
        $fechaActual = new DateTime($fechaActual);

        //$fechaActual = new DateTime('2024-01-27');


        $fechasLimites = self::fechaIniYfinHito($idHito);
        $numero = 0;

        $fechaInicio = new DateTime($fechasLimites[0]->fecha_inicio_hito);
        $fechaFin = new DateTime($fechasLimites[0]->fecha_fin_hito);

        if ($fechaActual >= $fechaInicio && $fechaActual <= $fechaFin) {
            for ($i = 0; $i < $semanasExistentes; $i++) {
                $inicio = new DateTime($semanasExistentes[$i]['inicio']);
                $fin = new DateTime($semanasExistentes[$i]['fin']);

                if ($fechaActual >= $inicio && $fechaActual <= $fin) {
                    $numero = $i + 1;
                    break;
                }
            }
        } else {
            if ($fechaActual > $fechaFin) {
                $numero = count($semanasExistentes);
            }
        }

        return $numero;
    }

    private static function getSemanaActual($semanasExistentes, $idHito)
    {
        // Obtener la fecha actual
        date_default_timezone_set('America/La_Paz');
        $fechaActual = date('Y-m-d');
        $fechaComparar = new DateTime($fechaActual);

        $fechasValidas = self::fechaIniYfinHito($idHito);
        $rangoInicio = new DateTime($fechasValidas[0]->fecha_inicio_hito);
        $rangoFin = new DateTime($fechasValidas[0]->fecha_fin_hito);

        if ($fechaComparar >= $rangoInicio && $fechaComparar <= $rangoFin) {
            for ($i = 0; $i < count($semanasExistentes); $i++) {
                $inicio = new DateTime($semanasExistentes[$i]['inicio']);
                $fin = new DateTime($semanasExistentes[$i]['fin']);


                if ($fechaComparar >= $inicio && $fechaComparar <= $fin) {
                    $intervaloActual = array($semanasExistentes[$i]['inicio'], $semanasExistentes[$i]['fin']);
                    break;
                }
            }
        } else {
            if ($fechaComparar < $rangoInicio) {
                $intervaloActual = array('Hito no iniciado');
            } else {
                $intervaloActual = array('Hito finalizado');
            }
        }
        return $intervaloActual;
    }



    private static function getSemanasDivididas($idHito)
    {

        $fechas = self::fechaIniYfinHito($idHito);
        $fechaIni = $fechas[0]->fecha_inicio_hito;
        $fechaFin = $fechas[0]->fecha_fin_hito;
        $semanasDivididas = self::dividirFechas($fechaIni, $fechaFin);
        return $semanasDivididas;
    }


    private static function fechaIniYfinHito($idHito)
    {
        $consulta = DB::select("SELECT fecha_inicio_hito, fecha_fin_hito FROM hito WHERE id_hito = ?", array($idHito));
        return $consulta;
    }

    private static function dividirFechas($fechaInicio, $fechaFin)
    {

        // Fechas de inicio y fin
        $fechaInicio = new DateTime($fechaInicio);
        $fechaFin = new DateTime($fechaFin);

        // Crear un intervalo de 7 días (una semana)
        $intervalo = new DateInterval('P7D');

        // Inicializar un arreglo para almacenar las semanas
        $semanas = [];

        // Mientras la fecha de inicio sea menor o igual a la fecha de fin
        while ($fechaInicio <= $fechaFin) {
            // Calcular la fecha de fin de la semana (7 días después de la fecha de inicio)
            $fechaFinSemana = clone $fechaInicio;
            $fechaFinSemana->add($intervalo);
            $fechaFinSemana->modify('-1 day'); // Restar 1 día para que el intervalo no se solape

            // Si la fecha fin de semana es mayor que la fecha fin real, ajustarla
            if ($fechaFinSemana > $fechaFin) {
                $fechaFinSemana = $fechaFin;
            }

            // Añadir la semana al arreglo
            $semanas[] = [
                'inicio' => $fechaInicio->format('Y-m-d'),
                'fin' => $fechaFinSemana->format('Y-m-d')
            ];

            // Avanzar la fecha de inicio al día siguiente del final de la semana
            $fechaInicio = clone $fechaFinSemana;
            $fechaInicio->modify('+1 day');
        }
        return $semanas;
    }

    private static function registrarSeguimientoDB($idHito, $descripcion, $asistencias, $faltas, $fechaInicio, $fechaFin)
    {
        //Colocar fechas reales en control semanal ahora estan con estaticos
        // Obtener la fecha actual
        date_default_timezone_set('America/La_Paz');
        $fechaActual = date('Y-m-d');



        $idProyecto = DB::select("SELECT id_proyecto FROM hito WHERE id_hito = ?", array($idHito));
        $idProyecto = $idProyecto[0]->id_proyecto;
        //---------------------------------------------------------------------------------------------------------
        DB::insert("INSERT INTO control_semanal (id_proyecto, id_hito, control_semanal, fecha_ini_semana, fecha_fin_semana, fecha_registro_semanal)
        VALUES (?,?,?,?,?,?)", array($idProyecto, $idHito, $descripcion, $fechaInicio, $fechaFin, $fechaActual));
        //----------------------------------------------------------------------------------------------------------

        $idControlSemanal = DB::select("SELECT max(id_control_semanal) as id_control_semanal FROM control_semanal");
        $idControlSemanal = $idControlSemanal[0]->id_control_semanal;


        if (count($asistencias) > 0) {
            foreach ($asistencias as $idEstudiante) {
                DB::insert("INSERT INTO asistencia (id_usuario, asistio, id_control_semanal) VALUES (?,?,?)", array($idEstudiante, TRUE, $idControlSemanal));
            }
        }

        if (count($faltas) > 0) {
            foreach ($faltas as $idEstudianteFalta) {
                DB::insert("INSERT INTO asistencia (id_usuario, asistio, id_control_semanal) VALUES (?,?,?)", array($idEstudianteFalta, FALSE, $idControlSemanal));
            }
        }
    }

    private static function getObjetivos($idHito)
    {
        $consulta = DB::select('SELECT descrip_objetivo, id_objetivo, entregado_ob FROM objetivo WHERE id_hito = ?', array($idHito));
        return $consulta;
    }

    private static function getEstudiantes($idHito)
    {
        $consulta = DB::select("SELECT concat(e.nombre_estudiante, ' ', e.apellido_estudiante) AS nombre_completo, e.id_usuario  
        FROM estudiante e, estudiante_grupoempresa ege, grupo_empresa ge, proyecto pr, hito h
        WHERE e.id_usuario = ege.id_usuario
        AND ege.id_grupo_empresa = ge.id_grupo_empresa
        AND pr.id_grupo_empresa = ge.id_grupo_empresa
        AND pr.id_proyecto = h.id_proyecto
        AND h.id_hito = ?", array($idHito));
        return $consulta;
    }

    private static function getEstudiantesConFaltas($estudiante)
    {
        $estudianteAsistencias = [];
        foreach ($estudiante as $est) {
            $consulta = DB::select("SELECT count(asistio) as numero_de_faltas, asistio FROM asistencia 
            WHERE id_usuario = ?
            AND asistio = FALSE
            GROUP BY asistio", array($est->id_usuario));


            if (count($consulta) > 0) {
                $estudianteAsistencias[] = array($est->nombre_completo, $consulta[0]->numero_de_faltas, $est->id_usuario);
            } else {
                $estudianteAsistencias[] = array($est->nombre_completo, 0, $est->id_usuario);
            }
        }
        return $estudianteAsistencias;
    }
    private static function getCriteriosDeAceptacion($idHito)
    {
        return DB::select("
            SELECT o.descrip_objetivo, ca.descripcion_ca, ca.id_criterio_aceptacion
            FROM objetivo o
            JOIN criterio_aceptacion ca ON o.id_objetivo = ca.id_objetivo
            WHERE o.id_hito = ?
        ", [$idHito]);
    }
    private static function getHistoriaUsuario($idHito)
    {
        return DB::select("
            select * 
                from historia_usuario,(
                    select id_proyecto
                    from hito
                    where id_hito = ?
                )a
                where historia_usuario.id_proyecto = a.id_proyecto and done = 'False'
        ", [$idHito]);
    }

    private static function getGrupoEmpresas($idDocente)
    {
        $consulta = DB::select("SELECT ge.nombre_corto, ge.id_grupo_empresa, ege.periodo_grupoempresa
        FROM grupo_empresa ge, estudiante_grupoempresa ege, proyecto pr, grupo gr, grupo_materia gm, docente doc
        WHERE ge.id_grupo_empresa = ege.id_grupo_empresa
        AND pr.id_grupo_empresa = ge.id_grupo_empresa
        AND pr.id_grupo = gr.id_grupo
		AND gr.id_grupo = gm.id_grupo
		AND gm.id_usuario = doc.id_usuario
		AND doc.id_usuario = ?
        AND ege.periodo_grupoempresa = '2-2024'
        GROUP BY ge.nombre_corto, ge.id_grupo_empresa, ege.periodo_grupoempresa
        ORDER BY ge.id_grupo_empresa ASC", array($idDocente));
        return $consulta;
    }
}
