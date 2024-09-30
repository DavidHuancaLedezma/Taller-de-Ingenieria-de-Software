<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro Exitoso</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-success text-center">Registro Exitoso</h2>
        <p class="text-center">Su registro ha sido exitoso. Su código de acceso es:</p>
        <h3 class="text-primary text-center">{{ session('codigo_acceso') }}</h3>
        <div class="text-center">
            <a href="{{ route('grupo_empresa.create') }}" class="btn btn-primary">Registrar otro grupo empresa</a>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>


</html>

</html>
