<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Muestra la vista de inicio.
     *
     * @return \Illuminate\View\View
     */
    public function VeriniciarSesion()
    {
        return view('login'); // Asegúrate de que este nombrecoincida con el archivo 'Inicio.blade.php'
    }
    // Método para procesar el inicio de sesión
    public function iniciarSesion(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Intento de autenticación usando las credenciales proporcionadas
        if (Auth::attempt([
            'correo_electronico_user' => $request->email,
            'contrasena' => $request->password // Laravel automáticamente usará bcrypt
        ])) {
            // Redirigir al dashboard si la autenticación es exitosa
            return redirect()->intended('dashboard');
        }

        // Si las credenciales no son válidas, regresar con un mensaje de error
        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ])->onlyInput('email'); // Mantener el valor de email en el formulario
    }

    // Método para cerrar sesión
    public function cerrarSesion()
    {
        Auth::logout();
        return redirect('/');
    }

}
