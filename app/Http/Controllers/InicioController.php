<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InicioController extends Controller
{
    /**
     * Muestra la vista de inicio.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('Inicio'); // Asegúrate de que este nombrecoincida con el archivo 'Inicio.blade.php'
    }
}
