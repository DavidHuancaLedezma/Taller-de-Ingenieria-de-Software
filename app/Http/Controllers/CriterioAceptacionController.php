<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CriterioAceptacion;

use Illuminate\Support\Facades\DB;


class CriterioAceptacionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'id_objetivo' => 'required',
            'descripcion_ca' => 'required',
            'cumplido' => 'required|boolean',
        ]);

        CriterioAceptacion::create([
            'id_objetivo' => $request->input('id_objetivo'),
            'descripcion_ca' => $request->input('descripcion_ca'),
            'cumplido' => $request->input('cumplido'),
        ]);

        return redirect()->back()->with('success', 'Criterio de aceptación añadido correctamente.');
    }
}
