<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>REGISTRO GRUPO EMPRESA</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body, html {
            height: 100%;
        }
        .card {
            width: 50%;
            margin: auto;
            margin-top: 5cm;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            background-color: white;
        }

        .my-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: #D2D6DE;
        }

        .btn-custom {
            background-color: #367FA9;
            color: white;
        }

        .btn-custom:hover {
            background-color: #2b6483;
            color: white;
        }
    </style>
</head>

<body>

    <div class="my-container">
        <div class="card">
            <h2 class="mb-4 text-center text-primary">Registrar Grupo Empresa</h2>

            <form method="POST" action="{{ route('grupo_empresa.store') }}">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nombreLargo">Nombre Largo: </label>
                            <input type="text" id="nombre_largo" name="nombre_largo" class="form-control"
                                placeholder="Nombre largo" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nombreCorto">Nombre Corto: </label>
                            <input type="text" id="nombre_corto" name="nombre_corto" class="form-control"
                                placeholder="Nombre corto" required>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="direccion">Dirección grupo empresa:</label>
                            <input type="text" id="direccion" name="direccion" class="form-control"
                                placeholder="Dirección de grupo empresa" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="telefono">Teléfono: </label>
                            <input type="tel" id="telefono" name="telefono" class="form-control"
                                placeholder="Teléfono" required>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="form-group">
                        <label for="correo">Correo electrónico: </label>
                        <input type="email" id="correo_electronico" name="correo" class="form-control"
                            placeholder="Correo electrónico" required>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <input type="checkbox" id="aviso-legal" name="acepto_politica" class="form-check-input" required>
                        <label class="form-check-label" for="aviso-legal">
                            He leído y acepto el <a href="{% url 'politicas' %}" target="_blank">aviso legal y la Política
                                de privacidad</a>
                        </label>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <input type="checkbox" id="terminos" name="acepto_terminos" class="form-check-input" required>
                        <label class="form-check-label" for="terminos">
                            Acepto los <a href="#" target="_blank">términos y condiciones</a>
                        </label>
                    </div>
                </div>

                <div class="text-center">
                    <button class="btn btn-custom" type="submit">Registrarse</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
