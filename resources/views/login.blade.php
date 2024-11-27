<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
            margin-top: 70px; /* Espacio para la navbar fija */
        }

        .login-container {
            background-color: #ffffff;
            padding: 4rem 3rem;
            width: 600px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .login-container h2 {
            margin-bottom: 1.5rem;
            font-size: 24px;
            color: #333;
        }

        .login-container input {
            width: 100%;
            padding: 0.8rem;
            margin: 0.5rem 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            background-color: #e9e9e9;
        }

        .login-container button {
            width: 100%;
            padding: 0.8rem;
            margin-top: 3rem;
            background-color: #367FA9;
            border: none;
            border-radius: 4px;
            color: #ffffff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .login-container button:hover {
            background-color: #118cd9;
        }

        /* Navbar */
        .navbar {
            background-color: #367FA9;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
            color: white;
            text-decoration: none;
        }

        .nav-item {
            display: inline-block;
            margin-left: 20px;
        }

        .nav-link {
            color: white;
            font-weight: 500;
            text-decoration: none;
            padding: 5px 20px;
            border-radius: 25px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .btn-login {
            border: 1px solid white;
        }

        .btn-login:hover,
        .btn-register:hover {
            background-color: white;
            color: #367FA9;
        }

        .btn-register {
            background-color: white;
            color: #367FA9;
        }

        /* Footer */
        footer {
            background-color: #367FA9;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        footer a {
            color: white;
            font-weight: bold;
            text-decoration: none;
        }

        footer a:hover {
            color: #cfcfcf;
        }

        /* General Animation */
        .fade-in {
            opacity: 0;
            animation: fadeIn 1s forwards;
        }

        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                padding: 10px;
            }

            .nav-item {
                margin-left: 0;
                margin-top: 10px;
            }
        }

        @media (max-width: 480px) {
            .navbar-brand {
                text-decoration: none;
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
    <a class="navbar-brand no-underline" href="{{ route('inicio') }}">
            <div class="navbar-brand">GESTIÓN DE PROYECTOS</div>
        </a>  
        <div>
            <a class="nav-link btn-login nav-item" href="{{route('login')}}">Iniciar Sesión</a>
            <a class="nav-link btn-register nav-item" href="{{route('registro_estudiante.create')}}">Registrarse</a>
            <a class="nav-link btn-register nav-item" href="{{route('registro_docente.create')}}">Registrar Docente</a>
        </div>
    </nav>

    <div class="login-container">
        <h2>Inicio de Sesión</h2>

        <!-- Formulario de inicio de sesión -->
        <form action="{{ route('login.post') }}" method="POST">
            @csrf

            <input type="email" name="email" placeholder="Correo Electrónico" value="{{ old('email') }}" required>
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror

            <input type="password" name="password" placeholder="Contraseña" required>
            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror

            <button type="submit">Ingresar</button>
        </form>
    </div>

    <footer>
        <p>&copy; 2024 - Todos los derechos reservados | <a href="#">Política de Privacidad</a></p>
    </footer>
</body>
</html>
