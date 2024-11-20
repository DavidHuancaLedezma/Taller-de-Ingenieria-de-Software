<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;

class LoginController extends Controller
{
    /**
     * Mostrar la vista de login.
     */
    public function showLoginForm()
    {
        return view('login');
    }

    /**
     * Manejar la solicitud de inicio de sesión.
     */
    public function login(Request $request)
    {
        // Validar los datos ingresados
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'El correo es obligatorio.',
            'email.email' => 'Debe ser un correo válido.',
            'password.required' => 'La contraseña es obligatoria.',
        ]);

        // Verificar si el usuario existe en la base de datos
        $usuario = Usuario::where('correo_electronico_user', $credentials['email'])->first();

        if (!$usuario) {
            return back()->withErrors(['email' => 'El correo ingresado no existe.']);
        }

        // Validar la contraseña
        if (!password_verify($credentials['password'], $usuario->contrasena)) {
            return back()->withErrors(['password' => 'La contraseña es incorrecta.']);
        }

        // Iniciar sesión manualmente
        Auth::login($usuario);

        // Redirigir según el tipo de usuario
        if ($usuario->estudiante) {
            return redirect()->route('estudiante_home', ['idEstudiante' => $usuario->id_usuario]);
        } elseif ($usuario->docente) {
            return redirect()->route('docente_home', ['idDocente' => $usuario->id_usuario]);
        }

        // Si no es estudiante ni docente, cerrar sesión y mostrar un error
        Auth::logout();
        return back()->withErrors(['email' => 'El usuario no tiene permisos asignados.']);
    }

    /**
     * Cerrar sesión.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}