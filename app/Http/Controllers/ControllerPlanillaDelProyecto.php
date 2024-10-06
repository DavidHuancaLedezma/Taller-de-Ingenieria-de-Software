<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControllerPlanillaDelProyecto extends Controller
{
    public function datosDePlanillaDeProyecto($idGrupoEmpresa)
    {
        return view('planillaDelProyecto');
    }
}
