<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Autoevaluación Escala Likert</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #D2D6DE ; 
            margin: 0 ; 
        }

        .container {
            background-color: white;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position : relative ;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            width: 100%;
            color: #ffffff;
            background-color: #367FA9;
        }

        table.likert {
            width: 100%;
            border-collapse: collapse;
        }

        table.likert th, 
        table.likert td {
            padding: 10px;
            text-align: left;
        }

        table.likert th {
            font-size: 18px;
        }

        table.likert td {
            border: none;
        }

        table.likert input[type="radio"] {
            transform: scale(1.5);
            margin: 0 10px;
        }

        img {
            width: 40px;

            height: 55px;
        }

        .btn-calificar{
            border: none ; 
            background-color: #367FA9;
            color: #ffffff;
            padding: 10px ;
            border-radius: 10px ;
        }

        .container .footer-autoevaluacion{
            width: 100% ;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
                /* Estilo para el mensaje de error */
        .error-message {
            color: red;
            display: none; /* Oculto por defecto */
            margin-bottom: 10px;
            text-align: center;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <input id="id-proyecto" type="hidden" value="{{$idProyecto}}">
    <input id="id-estudiante" type="hidden" value="{{$idEstudiante}}">
    <div class="container">
        <h1>Autoevaluación</h1>
        <table class="likert">
            <thead>
                <tr>
                    <th>Parametros de calificación</th>
                    <th><img src="{{ asset('img/emoji_muy_mal.png') }}" alt="Muy Mal"></th>
                    <th><img src="{{ asset('img/emoji_mal.png') }}" alt="Mal"></th>
                    <th><img src="{{ asset('img/emoji_regular.png') }}" alt="Regular"></th>
                    <th><img src="{{ asset('img/emoji_bien.png') }}" alt="Bien"></th>
                    <th><img src="{{ asset('img/emoji_muy_bien2.png') }}" alt="Muy Bien"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($parametrosDeEvaluacion as $item)
                    <tr>
                        <td>{{$item->pregunta}}</td>
                        <td><input type="radio" name="question{{ $loop->iteration }}" value="1"></td>
                        <td><input type="radio" name="question{{ $loop->iteration }}" value="2"></td>
                        <td><input type="radio" name="question{{ $loop->iteration }}" value="3"></td>
                        <td><input type="radio" name="question{{ $loop->iteration }}" value="4"></td>
                        <td><input type="radio" name="question{{ $loop->iteration }}" value="5"></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <footer class="footer-autoevaluacion">
            <p id="error-message" class="error-message">Por favor, selecciona una opción en cada parámetro de calificación.</p>
            <button id="calificarBtn" class="btn-calificar">Calificar</button>
        </footer>
    </div>

    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    
    $(document).ready(function(){
        // Configurar el token CSRF para todas las solicitudes AJAX
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });

        //aqui!!!!!
        $('#calificarBtn').on('click', function() {
            // Ocultar el mensaje de error al comenzar la validación
            const errorMessage = document.getElementById('error-message');
            errorMessage.style.display = 'none';

            // Verificar si todos los radio buttons están seleccionados
            const totalPreguntas = document.querySelectorAll('tbody tr').length ;
            let todasRespuestasSeleccionadas = true;

            let sumaTotal = 0;

            for (let i = 1; i <= totalPreguntas; i++) {
                const radios = document.getElementsByName('question' + i);
                let preguntaSeleccionada = false;

                // Verificar si alguno de los radio buttons de la pregunta está seleccionado
                for (let radio of radios) {
                    if (radio.checked) {
                        preguntaSeleccionada = true;
                        sumaTotal += parseInt(radio.value);
                        break;
                    }
                }

                // Si no se seleccionó ninguno, marcamos error
                if (!preguntaSeleccionada) {
                    todasRespuestasSeleccionadas = false;
                    break;
                }
            }

            // Si falta seleccionar alguno, mostramos el mensaje de error
            if (!todasRespuestasSeleccionadas) {
                errorMessage.style.display = 'block';
            } else {
                // Aquí puedes agregar tu lógica si todo está seleccionado
                
                sumaTotal = Math.round(sumaTotal / totalPreguntas ); 
                
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: 'Todas las respuestas han sido seleccionadas correctamente.',
                }); 

                $.ajax({
                url: '{{ url('/guardar_nota_autoevaluacion') }}', //nueva url para la comunicación con AJAX
                method: 'POST',
                data: {
                    nota: sumaTotal,
                    idEstudiante: $('#id-estudiante').val(),
                    idProyecto: $('#id-proyecto').val()
                }
                });
       
            }
            
        });
    });
    </script>
</body>
</html>