<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\GrupoEmpresa;
use Illuminate\Support\Str; // Importar Str para generar cadenas aleatorias
use App\Rules\GmailDomain;


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
            'nombre_largo' => 'required|string|max:60|unique:grupo_empresa,nombre_largo',
            'nombre_corto' => 'required|string|max:30|unique:grupo_empresa,nombre_corto',
            'direccion' => 'required|string|max:70',
            'telefono' => 'nullable|digits:8|regex:/[0-9]+$/',
            'correo' => 'required|string|email|max:70|unique:grupo_empresa,correo_electronico_ge',
            'acepto_politica' => 'accepted',
            'acepto_terminos' => 'accepted',

        ]);
        if (strlen($validated['nombre_largo']) <= strlen($validated['nombre_corto'])) {
            return back()->withErrors(['nombre_largo' => 'El nombre largo debe tener más caracteres que el nombre corto.'])
                         ->withInput();
        }
        $codigoAcceso = Str::random(8);
        
        // Guardar la nueva grupo empresa
        try{GrupoEmpresa::create([
            'codigo_acceso' => $codigoAcceso,
            'nombre_largo' => $validated['nombre_largo'],
            'nombre_corto' => $validated['nombre_corto'],
            'direccion' => $validated['direccion'],
            'telefono_ge' => $validated['telefono'],
            'correo_electronico_ge' => $validated['correo'],
            
        ]);
    }catch (\Exception $e) {
        return redirect()->back()->withErrors($e->getMessage());
    }

        return redirect()->route('grupo_empresa.success')->with('codigo_acceso', $codigoAcceso);
    }
    
    public function success(Request $request)
    {
        $codigoAcceso = $request->session()->get('codigo_acceso');
        return view('grupo_empresa.success', ['codigoAcceso' => $codigoAcceso]);
    }
}
