<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\GrupoEmpresa;
use Illuminate\Support\Str; // Importar Str para generar cadenas aleatorias


class GrupoEmpresaController extends Controller
{
    public function create()
    {
        return view('grupo_empresa.registroGE');
    }


    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'nombre_largo' => 'required|string|max:60',
            'nombre_corto' => 'required|string|max:30',
            'direccion' => 'required|string|max:70',
            'telefono' => 'nullable|string|max:15',
            'correo' => 'required|string|email|max:70',
            'acepto_politica' => 'accepted',
            'acepto_terminos' => 'accepted',
        ]);

        $codigoAcceso = Str::random(8);

        // Guardar la nueva grupo empresa
        GrupoEmpresa::create([
            'codigo_acceso' => $codigoAcceso,
            'nombre_largo' => $validated['nombre_largo'],
            'nombre_corto' => $validated['nombre_corto'],
            'direccion' => $validated['direccion'],
            'telefono_ge' => $validated['telefono'],
            'correo_electronico_ge' => $validated['correo'],
            'acepto_politica' => $request->has('acepto_politica'),
            'acepto_terminos' => $request->has('acepto_terminos'),
        ]);
        

        return redirect()->route('grupo_empresa.success')->with('codigo_acceso', $codigoAcceso);
    }

    public function success(Request $request)
    {
        $codigoAcceso = $request->session()->get('codigo_acceso');
        return view('grupo_empresa.success', ['codigoAcceso' => $codigoAcceso]);
    }
}
