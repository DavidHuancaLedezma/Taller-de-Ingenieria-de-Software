<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControllerHomeDocente extends Controller
{
    public function openHomeDocente($idDocente)
    {
        return view("home_docente");
    }
}
