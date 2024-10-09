<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Estudiante</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body{
            background-color: #D2D6DE;
        }
        .toggle-password {
            cursor: pointer;
        }
        .form-check-label {
            margin-left: 0.5rem;
        }
        .custom-container {
            background-color: white;
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
        .text-danger {
            font-size: 0.875rem;
             margin-top: 5px;
            margin-left: 2px;
            margin-bottom: 1px;
            min-height: 20px; 
        }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center mt-5">
    <div class="custom-container">
        <h4 class="text-center mb-4">Registro Docente</h4>
        <form action="{{ route('registro_estudiante.store') }}"  method="POST">
            @csrf
            <div class="row">
                <!-- Columna 1 -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="nombre_estudiante" class="form-label">Nombre:</label>
                        <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" 
                        value="{{ old('nombre_usuario') }}" required placeholder="Nombre">
                    </div>
                    @if ($errors->has('nombre_usuario'))
                                    <div class="text-danger">{{ $errors->first('nombre_usuario') }}</div>
                            @endif
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono:</label>
                        <input type="number" class="form-control" id="telefono_usuario" name="telefono_usuario" 
                        value="{{ old('telefono_usuario') }}" placeholder="Teléfono" required>
                        @if ($errors->has('telefono_usuario'))
                                    <div class="text-danger">{{ $errors->first('telefono_usuario') }}</div>
                                @endif
                    </div>

                    <div class="mb-3">
                        <label for="contrasena" class="form-label">Contraseña:</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="contrasena" name="contrasena" 
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

                <!-- Columna 2 -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="apellido_estudiante" class="form-label">Apellidos:</label>
                        <input type="text" class="form-control" id="apellido_estudiante" name="apellido_estudiante" 
                        value="{{ old('apellido_estudiante') }}" required placeholder="Apellidos">
                    </div>
                    @if ($errors->has('apellido_estudiante'))
                                    <div class="text-danger">{{ $errors->first('apellido_estudiante') }}</div>
                            @endif
                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo electronico:</label>
                        <input type="email" class="form-control" id="correo_electronico_user"
                        value="{{ old('correo_electronico_user') }}" name="correo_electronico_user" required placeholder="Correo electronico">
                        @if ($errors->has('correo_electronico_user'))
                                    <div class="text-danger">{{ $errors->first('correo_electronico_user') }}</div>
                                @endif
                    </div>

                    <div class="mb-3">
                        <label for="confirmar_contrasena" class="form-label">Confirmar Contraseña:</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="contrasena_confirmation" name="contrasena_confirmation" 
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

            <!-- Checkboxes -->
            <div class="form-check mb-3">
                <input class="form-check-input" value="1" type="checkbox" value="" id="privacy_policy" 
                {{ old('privacy_policy') ? 'checked' : '' }} name="privacy_policy" required>
                <label class="form-check-label" for="privacy_policy">
                    He leído y acepto el aviso legal y la política de privacidad. *
                </label>
            </div>
            <div class="form-check mb-4">
                <input class="form-check-input" value="1" type="checkbox" value="" id="terms_conditions"
                {{ old('terms_conditions') ? 'checked' : '' }} name="terms_conditions" required>
                <label class="form-check-label" for="terms_conditions">
                    Acepto los términos y condiciones. *
                </label>
            </div>

            <!-- Botón de registro -->
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-custom">Registrarse</button>
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
@if(session('success2'))
    <script>
        Swal.fire({
            title: '¡Registro Éxitoso!',
            text: "{{ session('success') }}",
            icon: 'success',
            confirmButtonText: 'Aceptar'
        });
    </script>
@endif


<script src="grupo_empresa/Re"></script>

<script src="{{ asset('js/RegistroEstudiante.js') }}"></script>

</body>
</html>