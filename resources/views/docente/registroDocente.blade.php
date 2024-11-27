<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Docente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background-color: #D2D6DE;
            padding-top: 80px;
            padding-bottom: 60px;
        }

        .toggle-password {
            cursor: pointer;
        }

        .form-check-label {
            margin-left: 0.5rem;
        }

        .custom-container {
            width: 90%;
            max-width: 1000px;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            margin: 20px auto;
        }

        .form-control {
            border-radius: 8px;
            border-color: #c0c0c0;
        }

        .btn-custom {
            background-color: #4d7ca7;
            border-color: #4d7ca7;
            border-radius: 8px;
            padding: 10px 30px;
            font-weight: bold;
            color: white;
            width: auto;
            min-width: 200px;
        }

        .btn-custom:hover {
            background-color: #3a5f82;
            border-color: #3a5f82;
        }

        .text-danger {
            font-size: 0.875rem;
            margin-top: 5px;
            margin-left: 2px;
            margin-bottom: 1px;
            min-height: 20px;
        }

        .navbar {
            background-color: #367FA9;
            padding: 15px;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }

        .navbar-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
            color: white;
            text-decoration: none;
            margin-right: 20px;
        }

        .nav-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .nav-link {
            color: white;
            font-weight: 500;
            text-decoration: none;
            padding: 8px 20px;
            border-radius: 25px;
            white-space: nowrap;
        }

        .btn-login {
            border: 1px solid white;
        }

        .btn-register {
            background-color: white;
            color: #367FA9;
        }

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
            text-decoration: none;
        }

        footer a:hover {
            color: #cfcfcf;
        }

        @media (max-width: 768px) {
            .custom-container {
                width: 95%;
                padding: 20px;
            }

            .navbar-content {
                flex-direction: column;
                text-align: center;
            }

            .nav-buttons {
                width: 100%;
                justify-content: center;
            }

            .navbar-brand {
                margin-right: 0;
                margin-bottom: 10px;
            }

            .row {
                margin: 0;
            }

            .col-md-6 {
                padding: 0 10px;
            }

            .btn-custom {
                width: 100%;
                max-width: 300px;
            }

            body {
                padding-top: 120px;
            }
        }

        @media (max-width: 480px) {
            .custom-container {
                padding: 15px;
            }

            .navbar {
                padding: 10px;
            }

            .navbar-brand {
                font-size: 1.2rem;
            }

            .nav-link {
                padding: 6px 15px;
                font-size: 0.9rem;
            }

            .form-check-label {
                font-size: 0.9rem;
            }

            h4 {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>
<nav class="navbar">
    <div class="navbar-content">
        <a class="navbar-brand" href="{{ route('inicio') }}">GESTIÓN DE PROYECTOS</a>
        <div class="nav-buttons">
            <a class="nav-link btn-login" href="{{route('login')}}">Iniciar Sesión</a>
            <a class="nav-link btn-register" href="{{route('registro_estudiante.create')}}">Registrar Estudiante</a>
        </div>
    </div>
</nav>

<div class="container">
    <div class="custom-container">
        <h4 class="text-center mb-4">Registro Docente</h4>
        <form action="{{ route('registro_docente.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label for="nombre_docente" class="form-label">Nombre:</label>
                        <input type="text" class="form-control" id="nombre_docente" name="nombre_docente" tabindex="1"
                               value="{{ old('nombre_docente') }}" required placeholder="Nombre">
                        @if ($errors->has('nombre_docente'))
                            <div class="text-danger">{{ $errors->first('nombre_docente') }}</div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="telefono_docente" class="form-label">Teléfono:</label>
                        <input type="number" class="form-control" id="telefono_docente" name="telefono_docente" tabindex="3"
                               value="{{ old('telefono_docente') }}" placeholder="Teléfono" required>
                        @if ($errors->has('telefono_docente'))
                            <div class="text-danger">{{ $errors->first('telefono_docente') }}</div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="contrasena" class="form-label">Contraseña:</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="contrasena" name="contrasena" tabindex="5"
                                   value="{{ old('contrasena') }}" required minlength="8" placeholder="Contraseña">
                            <span class="input-group-text">
                                <i class="fas fa-eye toggle-password" onclick="togglePassword('contrasena')"></i>
                            </span>
                        </div>
                        @if ($errors->has('contrasena'))
                            <div class="text-danger">{{ $errors->first('contrasena') }}</div>
                        @endif
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label for="apellido_docente" class="form-label">Apellidos:</label>
                        <input type="text" class="form-control" id="apellido_docente" name="apellido_docente" tabindex="2"
                               value="{{ old('apellido_docente') }}" required placeholder="Apellidos">
                        @if ($errors->has('apellido_docente'))
                            <div class="text-danger">{{ $errors->first('apellido_docente') }}</div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="correo_docente" class="form-label">Correo electrónico:</label>
                        <input type="email" class="form-control" id="correo_docente" tabindex="4"
                               value="{{ old('correo_docente') }}" name="correo_docente" required placeholder="Correo electrónico">
                        @if ($errors->has('correo_docente'))
                            <div class="text-danger">{{ $errors->first('correo_docente') }}</div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="confirmar_contrasena" class="form-label">Confirmar Contraseña:</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="contrasena_confirmation" name="contrasena_confirmation" tabindex="6"
                                   value="{{ old('contrasena_confirmation') }}" required placeholder="Confirmar contraseña">
                            <span class="input-group-text">
                                <i class="fas fa-eye toggle-password" onclick="togglePassword('confirmar_contrasena')"></i>
                            </span>
                        </div>
                        @if ($errors->has('contrasena_confirmation'))
                            <div class="text-danger">{{ $errors->first('contrasena_confirmation') }}</div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12">
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="privacy_policy" name="privacy_policy" required 
                               {{ old('privacy_policy') ? 'checked' : '' }} value="1">
                        <label class="form-check-label" for="privacy_policy">
                            He leído y acepto el aviso legal y la política de privacidad. *
                        </label>
                    </div>

                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" id="terms_conditions" name="terms_conditions" required
                               {{ old('terms_conditions') ? 'checked' : '' }} value="1">
                        <label class="form-check-label" for="terms_conditions">
                            Acepto los términos y condiciones. *
                        </label>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-custom">Registrarse</button>
            </div>
        </form>
    </div>
</div>

<footer>
    <p>&copy; 2024 - Todos los derechos reservados | <a href="#">Política de Privacidad</a></p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<script>
    function togglePassword(fieldId) {
        const field = document.getElementById(fieldId);
        const icon = field.nextElementSibling.querySelector('i');

        if (field.type === 'password') {
            field.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            field.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>

@if(session('success'))
    <script>
        Swal.fire({
            title: '¡Registro Exitoso!',
            text: "{{ session('success') }}",
            icon: 'success',
            confirmButtonText: 'Aceptar'
        });
    </script>
@endif
</body>
</html>