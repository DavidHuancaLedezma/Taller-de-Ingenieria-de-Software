<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;  // Para consultas SQL
use Illuminate\Support\Facades\Hash;  // Para hashear la contraseña

class RegistroDocenteController extends Controller
{
    public function create()
    {
        return view('docente.registroDocente');  // Vista blade con el formulario
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'nombre_docente' => 'required|string|min:3|max:40|regex:/^[a-zA-Z\s]+$/',
            'apellido_docente' => 'required|string|min:3|max:60|regex:/^[a-zA-Z\s]+$/',
            'correo_docente' => 'required|string|email|max:70|unique:usuario,correo_electronico_user',
            'contrasena' => 'required|string|confirmed|min:8',  // Basado en la longitud de la DB
            'privacy_policy' => 'accepted',
            'terms_conditions' => 'accepted',
        ]);

        // Iniciar una transacción para asegurarnos de que ambas tablas se actualicen correctamente
        DB::beginTransaction();

        try {
            // Insertar datos en la tabla USUARIO usando SQL puro
            $id_usuario = DB::table('usuario')->insertGetId([
                'nombre_usuario' => $validated['nombre_docente'],
                'contrasena' => Hash::make($validated['contrasena']),  // Hasheamos la contraseña
                'correo_electronico_user' => $validated['correo_docente'],
                'usuario_activo' => true,  // Puedes cambiar según las reglas del negocio
            ], 'id_usuario');
            
            // Insertar datos en la tabla DOCENTE usando SQL puro
            DB::table('docente')->insert([
                'id_usuario' => $id_usuario,  // Llave foránea del usuario recién creado
                'nombre_docente' => $validated['nombre_docente'],
                'apellido_docente' => $validated['apellido_docente'],
                
            ]);

            // Confirmar la transacción si ambas inserciones se realizan correctamente
            DB::commit();

            // Redirigir o mostrar un mensaje de éxito
            return redirect()->route('registro_docente.create')->with('success', 'Registro de docente completado exitosamente');
        } catch (\Exception $e) {
            // Si ocurre algún error, revertimos la transacción
            DB::rollback();

            // Mostrar el error para debugging o manejarlo de la forma que prefieras
            return redirect()->back()->withErrors(['error' => 'Ocurrió un error al procesar el registro: ' . $e->getMessage()]);
        }
     }
}