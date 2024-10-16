<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;  // Necesario para las consultas SQL
use Illuminate\Support\Facades\Hash;  // Para hashear la contraseña

class RegistroEstudianteController extends Controller
{
    public function create()
    {
        return view('grupo_empresa.registroEstudiante');  // Tu formulario blade
    }

    public function store(Request $request)
    {
        
        // Validar los datos del formulario
        $validated = $request->validate([
            'nombre_usuario' => 'required|string|min:3|max:50|regex:/^[a-zA-Z]+$/',
            'apellido_estudiante' => 'required|string|min:3|max:60|regex:/^[a-zA-Z]+$/',
            'telefono_usuario' => 'required|digits:8',
            'correo_electronico_user' => 'required|string|email|max:70|unique:usuario,correo_electronico_user|ends_with:@gmail.com',
            'contrasena' => 'required|string|confirmed|min:8',  // Mínimo y máximo de 8 caracteres por tu definición de DB
            'programa_academico' => 'nullable|string|max:50',
            'privacy_policy' => 'accepted',
            'terms_conditions' => 'accepted',
        ]);

        // Iniciar una transacción para asegurarnos de que ambas tablas se actualizan correctamente
        DB::beginTransaction();

        try {
            // Insertar datos en la tabla USUARIO usando SQL puro
            $id_usuario = DB::table('usuario')->insertGetId([
                'nombre_usuario' => $validated['nombre_usuario'],
                'contrasena' => Hash::make($validated['contrasena']),  // Hasheamos la contraseña
                'telefono_usuario' => $validated['telefono_usuario'],
                'correo_electronico_user' => $validated['correo_electronico_user'],
                'usuario_activo' => true,  // Puedes cambiar este valor según sea necesario
            ], 'id_usuario');
            

            // Insertar datos en la tabla ESTUDIANTE usando SQL puro
            DB::table('estudiante')->insert([
                'id_usuario' => $id_usuario,  // Llave foránea del usuario recién creado
                'nombre_estudiante' => $validated['nombre_usuario'],  // Nombre del estudiante
                'apellido_estudiante' => $validated['apellido_estudiante']
                
            ]);

            // Confirmar la transacción si ambas inserciones se realizan correctamente
            DB::commit();

            // Redirigir o mostrar un mensaje de éxito
            return redirect()->route('registro_estudiante.create')->with('success2', 'Registro completado exitosamente');
        } catch (\Exception $e) {
            // Si ocurre algún error, revertimos la transacción
            DB::rollback();

            // Mostrar el error para debugging o manejarlo de la forma que prefieras
            return redirect()->back()->withErrors(['error' => 'Ocurrió un error al procesar el registro: ' . $e->getMessage()]);
        }
    }
}
