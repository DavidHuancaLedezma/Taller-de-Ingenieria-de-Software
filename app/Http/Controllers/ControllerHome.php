<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControllerHome extends Controller
{
    public function openHome($idEstudiante)
    {
        return view("home", ['idEstudinte' => $idEstudiante]);
    }
}
