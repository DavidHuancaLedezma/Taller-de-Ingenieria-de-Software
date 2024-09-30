<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Estudiante</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .toggle-password {
            cursor: pointer;
        }
        .form-check-label {
            margin-left: 0.5rem;
        }
        .custom-container {
            background-color: #edf0f5;
            padding: 50px;
            border-radius: 10px;
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
        }
        .btn-custom:hover {
            background-color: #3a5f82;
            border-color: #3a5f82;
        }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center mt-5">
    <div class="custom-container">
        <h4 class="text-center mb-4">Registro Estudiante</h4>
        <form action="{{ route('registro_estudiante.store') }}"  method="POST">
            @csrf
            <div class="row">
                <!-- Columna 1 -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="nombre_estudiante" class="form-label">Nombre:</label>
                        <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" required placeholder="Nombre">
                    </div>

                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono:</label>
                        <input type="number" class="form-control" id="telefono_usuario" name="telefono_usuario" placeholder="Teléfono">
                    </div>

                    <div class="mb-3">
                        <label for="contrasena" class="form-label">Contraseña:</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="contrasena" name="contrasena" required minlength="8" placeholder="Contraseña">
                            <span class="input-group-text">
                                <i class="fas fa-eye toggle-password" onclick="togglePassword('contrasena')"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Columna 2 -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="apellido_estudiante" class="form-label">Apellidos:</label>
                        <input type="text" class="form-control" id="apellido_estudiante" name="apellido_estudiante" required placeholder="Apellidos">
                    </div>

                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo Institucional:</label>
                        <input type="email" class="form-control" id="correo_electronico_user" name="correo_electronico_user" required placeholder="Correo Institucional">
                    </div>

                    <div class="mb-3">
                        <label for="confirmar_contrasena" class="form-label">Confirmar Contraseña:</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="contrasena_confirmation" name="contrasena_confirmation" required placeholder="Confirmar contraseña">
                            <span class="input-group-text">
                                <i class="fas fa-eye toggle-password" onclick="togglePassword('confirmar_contrasena')"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Checkboxes -->
            <div class="form-check mb-3">
                <input class="form-check-input" value="1" type="checkbox" value="" id="privacy_policy" name="privacy_policy" required>
                <label class="form-check-label" for="privacy_policy">
                    He leído y acepto el aviso legal y la Política de privacidad. *
                </label>
            </div>
            <div class="form-check mb-4">
                <input class="form-check-input" value="1" type="checkbox" value="" id="terms_conditions" name="terms_conditions" required>
                <label class="form-check-label" for="terms_conditions">
                    Acepto los términos y condiciones. *
                </label>
            </div>

            <!-- Botón de registro -->
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-custom">REGISTRARSE</button>
            </div>
        </form>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<!-- FontAwesome para el icono del ojo -->
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
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

</body>
</html>