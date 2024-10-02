<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Evaluaciones Semanales</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #e0e0e0;
        }

        .container {
            width: 80%;
            margin: 50px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header h1 {
            text-align: center;
            color: white;
            background-color: #4682b4;
            padding: 20px;
            border-top-left-radius: 2px;
            border-top-right-radius: 2px;
        }
        .header h2{
            text-align: left;
            color: white;
            background-color: #4682b4;
            padding: 20px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .header_2 {
            background-color: #4682b4;
            padding: 3px;
            border-top-left-radius: 2px;
            border-top-right-radius: 2px;
        }
        .h3{
            padding: 50px;
        }
        .tabs {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
        }

        .tab-button {
            background-color: #4682b4;
            color: white;
            border: none;
            font-size: 16px;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .table {
            width: 80%;
            border-collapse: collapse;
            margin-top: 20px;
            margin: 0 auto; /* Centra la tabla horizontalmente */
        }

        .table th, .table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }

        .table th {
            background-color: #f2f2f2;
        }

        /* Estilos específicos para los inputs */
        input[type="text"], input[type="date"] {
            background-color: rgba(150, 150, 150, 0.3); /* Color plomo más suave */
            /*background-color: white;*/
            color:black;
            border: 1px solid rgba(100, 100, 100, 0.5);
            border-radius: 4px;
            padding: 5px;
            font-size: 16px;
            margin-bottom: 10px;
            width: calc(60%); /* Ajusta el ancho considerando el padding */
            box-sizing: border-box; /* Asegura que el padding no se agregue al tamaño total del input */
            border-left: 5px solid #4682b4; /* Borde izquierdo más grueso */       

        }
        /* Estilo para los campos de fecha */
        .date-group {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px; 
        }
                
        input[type="date"] {
            color:rgba(80,80,80);
            width: calc(75% - 8px); /* Ajusta el ancho de los campos de fecha */
            margin-right: 2%;
        }
        .submit-btn:hover {
            background-color: #5a9bd4;
        }
        input[type="text"]:focus {
            border: 2px solid #3F9BBF; /* Cambia el color y grosor del borde */
            outline: none; /* Elimina el borde azul por defecto */
        } 
        input[type="date"]:focus{
            border: 2px solid #3F9BBF; /* Cambia el color y grosor del borde */
            outline: none; 
        }     
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h2>Proyecto: {{ $proyecto->nombre_proyecto }}</h2>
        <h1>Registro de Hitos </h1>
    </div>
    @if($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ $errors->first() }}',
            });
        </script>
    @endif

    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: "{{ session('success') }}",
            });
        </script>
    @endif
    <br>        
    <form action="{{ route('hitos.store',['id_proyecto' => $id_proyecto]) }}" method="POST" id="hitoForm">
        @csrf
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre Hito</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>(%) Cobro</th>
                </tr>
            </thead>
            <tbody id="hitoTable">
                @foreach($hitos as $hito)
                <tr>
                    <td>{{ 'Hito ' . $hito->numero_hito }}</td>
                    <td>{{ \Carbon\Carbon::parse($hito->fecha_inicio_hito)->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($hito->fecha_fin_hito)->format('d/m/Y') }}</td>
                    <td>{{ $hito->porcentaje_cobro . '%' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Mensaje de alerta -->
        <div id="mensaje" style="color: red; display: none; text-align: center;">
            Ya no se puede añadir hito, la suma de los porcentajes de cobro llegó a 100%.
        </div>
        <br>
            <h3>Añadir nuevo Hito</h3>
            <div class="header_2">
            </div>
            <br>
        <div class="date-group">
            <div>
                <label for="fecha_inicio_hito">Fecha Inicio:</label>
                <input type="date" name="fecha_inicio_hito" id="fecha_inicio_hito" required>
            </div>
            <div>
                <label for="fecha_fin_hito">Fecha Fin:</label>
                <input type="date" name="fecha_fin_hito" id="fecha_fin_hito" required>
            </div>
            <div>
                <label for="porcentaje_cobro">Porcentaje de Cobro (%):</label>
                <input type="text" name="porcentaje_cobro" id="porcentaje_cobro" placeholder="Porcentaje de cobro %" required>
            </div>
        </div>   
        <button type="submit" id="addHitoBtn" class="tab-button">Añadir Hito <i class="bi bi-rocket-takeoff-fill"></i> </button>
    </form>
</div>

<script>
     // Función que calcula la suma de los porcentajes de cobro
     function calcularSumaPorcentajes() {
        const rows = document.querySelectorAll('#hitoTable tr');
        let suma = 0;

        rows.forEach(row => {
            const porcentaje = parseFloat(row.cells[3].innerText); // Suponiendo que el porcentaje está en la cuarta columna
            suma += isNaN(porcentaje) ? 0 : porcentaje; // Sumar solo si es un número
        });

        return suma;
    }

    // Función para manejar la visibilidad del botón y el mensaje
    function actualizarEstadoBoton() {
        const sumaPorcentajes = calcularSumaPorcentajes();
        const addHitoBtn = document.getElementById('addHitoBtn');
        const mensaje = document.getElementById('mensaje');

        if (sumaPorcentajes >= 100) {
            addHitoBtn.style.display = 'none'; // Ocultar el botón
            mensaje.style.display = 'block'; // Mostrar el mensaje
        } else {
            addHitoBtn.style.display = 'inline-block'; // Mostrar el botón
            mensaje.style.display = 'none'; // Ocultar el mensaje
        }
    }

    // Ejecutar al cargar la página y cada vez que se agrega un nuevo hito
    document.addEventListener('DOMContentLoaded', actualizarEstadoBoton);

    document.getElementById('hitoForm').addEventListener('submit', function(e) {
        var porcentajeCobro = document.getElementById('porcentaje_cobro').value;
        var fechaInicio = new Date(document.getElementById('fecha_inicio_hito').value);
        var fechaFin = new Date(document.getElementById('fecha_fin_hito').value);
        /*var ultimoHitoFechaFin = new Date('{{ $hitos->last()->fecha_fin_hito ?? "null" }}');
        var fechaFinProyecto = new Date('{{ $proyecto->fecha_fin_proyecto }}');*/
         // Usar el último hito si existe
        var ultimoHitoFechaFin = '{{ end($hitos)->fecha_fin_hito ?? "null" }}';
        if (ultimoHitoFechaFin !== "null") {
            ultimoHitoFechaFin = new Date(ultimoHitoFechaFin);
        } else {
            ultimoHitoFechaFin = null;
        }

        var fechaFinProyecto = new Date('{{ $proyecto->fecha_fin_proyecto }}');


        if (isNaN(porcentajeCobro) || porcentajeCobro < 0 || porcentajeCobro > 100) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'El campo porcentaje de cobro debe ser un número entre 0 y 100.',
            });
        } else if (fechaInicio <= ultimoHitoFechaFin) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'La fecha de inicio debe ser después del ' + ultimoHitoFechaFin.toLocaleDateString(),
            });
        } else if (fechaFin < fechaInicio || fechaFin > fechaFinProyecto) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'La fecha de fin debe estar entre la fecha de inicio y la fecha de fin del proyecto (' + fechaFinProyecto.toLocaleDateString() + ').',
            });
        }
    });
      // Llama a la función al cargar la página para establecer el estado inicial
    window.onload = actualizarEstadoBoton;
</script>


</body>
</html>
