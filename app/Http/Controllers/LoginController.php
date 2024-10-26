<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Muestra la vista de inicio.
     *
     * @return \Illuminate\View\View
     */
    public function iniciarSesion()
    {
        return view('login'); // Asegúrate de que este nombrecoincida con el archivo 'Inicio.blade.php'
    }
  
}
