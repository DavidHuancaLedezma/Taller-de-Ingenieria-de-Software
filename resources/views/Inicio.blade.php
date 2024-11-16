<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Proyectos Académicos</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        /* Navbar */
        .navbar {
            background-color: #367FA9;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
            color: white;
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
        .btn-login:hover, .btn-register:hover {
            background-color: white;
            color: #367FA9;
        }
        .btn-register {
            background-color: white;
            color: #367FA9;
        }

        /* Hero Section */
        .hero-section {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 80px 50px;
            background-color: #f5faff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin: 30px auto;
            max-width: 1200px;
        }
        .hero-text {
            max-width: 50%;
            padding-right: 20px;
        }
        .hero-text h1 {
            font-size: 3rem;
            color: #333;
            margin-bottom: 20px;
            line-height: 1.2;
        }
        .hero-text p {
            font-size: 1.2rem;
            color: #666;
            margin-bottom: 30px;
        }
        .hero-image img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
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
            /* Navbar */
            .navbar {
                flex-direction: column;
                padding: 10px;
            }
            .nav-item {
                margin-left: 0;
                margin-top: 10px;
            }

            /* Hero Section */
            .hero-section {
                flex-direction: column;
                padding: 20px;
                text-align: center;
            }
            .hero-text {
                max-width: 100%;
                padding-right: 0;
                margin-bottom: 20px;
            }
            .hero-text h1 {
                font-size: 2rem;
            }
            .hero-text p {
                font-size: 1rem;
            }
            .hero-image {
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            .navbar-brand {
                font-size: 1.2rem;
            }
            .hero-text h1 {
                font-size: 1.5rem;
            }
            .hero-text p {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-brand">GESTIÓN DE PROYECTOS</div>
        <div>
            <a class="nav-link btn-login nav-item" href="{{route('login')}}">Iniciar Sesión</a>
            <a class="nav-link btn-register nav-item" href="{{route('registro_estudiante.create')}}">Registrarse</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-section fade-in">
        <div class="hero-text">
            <h1>Mejora la gestión  <br>de tus proyectos académicos</h1>
            <p>
                Registra, planifica y evalúa el progreso de tus estudiantes en tiempo real con nuestro sistema integral de seguimiento.
            </p>
        </div>
        <div class="hero-image">
            <img src="https://cdn.goconqr.com/uploads/media/image/39527641/desktop_c5f73411-2b39-424e-bb41-8893fb7b9506.jpg" alt="Online Courses Illustration">
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 - Todos los derechos reservados | <a href="#">Política de Privacidad</a></p>
    </footer>

</body>
</html>