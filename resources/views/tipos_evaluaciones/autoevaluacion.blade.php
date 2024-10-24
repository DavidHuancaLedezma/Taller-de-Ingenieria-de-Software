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

        .radio-group {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .radio-group label {
            margin-bottom: 5px;
            font-size: 14px;
            color: black;
        }

        /* Estilo del botón circular */
        .info-button {
            width: 25px;
            height: 25px;
            background-color: #00BFFF; /* Celeste */
            border: none;
            border-radius: 50%;
            font-size: 14px;
            color: white;
            cursor: pointer;
            position: relative;
        }

        /* Estilo del mensaje emergente */
        .info-message {
            display: none;
            background-color: #f9f9f9;
            color: #333;
            border: 1px solid #ccc;
            padding: 8px;
            font-size: 12px;
            border-radius: 4px;
            position: absolute;
            top: 35px; /* Debajo del botón */
            left: 0px;
            max-width: 200px; /* Ancho aceptable */
            min-width: 150px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            z-index: 10;
            word-wrap: break-word;
        }

        table.likert td {
            border: none;
            position: relative; /* Asegura que el mensaje emergente esté posicionado respecto al td */
        }
        .rango-numeros {
            width: 50px;
        }
        .columnas {
            display: flex;
        }
        .criterios {
            margin-left: 40px;
            margin-right: 150px;
        }
    </style>
</head>
<body>
    <input id="id-proyecto" type="hidden" value="{{$idProyecto}}">
    <input id="id-estudiante" type="hidden" value="{{$idEstudiante}}">
    <div class="container">
        <h1>Autoevaluación</h1>

        <div class="columnas">
            <h3 class="criterios">Criterios</h3>
            <h3 class="parametros">Parametros de evaluación</h3>
        </div>
        <table class="likert">
            <thead>
                
            </thead>
            <tbody>
                @foreach ($parametrosDeEvaluacion as $item)
                    @if ($item->nombre_parametro == "Escala Likert")
                        <tr>
                            <td>
                                {{$item->evaluacion}}
                            </td>
                            <td>
                                <button class="info-button">?</button>
                                <div class="info-message">
                                    {{$item->descripcion_evaluacion}}
                                </div>
                            </td>
                            <td>
                                <div class="radio-group">
                                    <label for="muy-mal">Deficiente</label>
                                    <input type="radio" name="question1" value="10">
                                </div>
                            </td>
                            <td>
                                <div class="radio-group">
                                    <label for="mal">Malo</label>
                                    <input type="radio" name="question1" value="30">
                                </div>
                            </td>
                            <td>
                                <div class="radio-group">
                                    <label for="regular">Regular</label>
                                    <input type="radio" name="question1" value="50">
                                </div>
                            </td>
                            <td>
                                <div class="radio-group">
                                    <label for="bien">Bueno</label>
                                    <input type="radio" name="question1" value="75">
                                </div>
                            </td>
                            <td>
                                <div class="radio-group">
                                    <label for="muy-bien">Excelente</label>
                                    <input type="radio" name="question1" value="100">
                                </div>
                            </td>
                        </tr>
                    @endif
                    
                    @if ($item->nombre_parametro == "Elección binaria")
                        <tr>
                            <td>{{$item->evaluacion}}</td>
                            <td>
                                <button class="info-button">?</button>
                                <div class="info-message">
                                    {{$item->descripcion_evaluacion}}
                                </div>

                            </td>

                            <td>
                                <div class="radio-group">
                                    <label for="falso">Falso</label>
                                    <input type="radio" name="question2" value="15">
                                </div>
                                <td>
                                    <div class="radio-group">
                                        <label for="verdadero">Verdadero</label>
                                        <input type="radio" name="question2" value="100">
                                    </div>
                                </td>
                            </td>
                        </tr>
                    @endif
                    
                    @if ($item->nombre_parametro == "Numeral entero")
                        <tr>
                            <td>{{$item->evaluacion}}</td>
                            <td>
                                <button class="info-button">?</button>
                                <div class="info-message">
                                    {{$item->descripcion_evaluacion}}
                                </div>
                            </td>
                            <td>
                                <div class="radio-group">
                                    <label for="verdadero">Rango [0 - 100]</label>
                                    <input class="rango-numeros" type="text" id="numero" value="0" oninput="validarEntrada(event)" onpaste="prevenirPegar(event)" maxlength="3" />
                                </div>
                            </td>
                        </tr>
                    @endif

                    @if ($item->nombre_parametro == "Categoria")
                        <tr>
                            <td>{{$item->evaluacion}}</td>
                            <td>
                                <button class="info-button">?</button>
                                <div class="info-message">
                                    {{$item->descripcion_evaluacion}}
                                </div>
                            </td>
                            <td>
                                <div class="radio-group">
                                    <label for="baja">Baja</label>
                                    <input type="radio" name="question3" value="10">
                                </div>
                            </td>
                            <td>
                                <div class="radio-group">
                                    <label for="media">Media</label>
                                    <input type="radio" name="question3" value="50">
                                </div>
                            </td>
                            <td>
                                <div class="radio-group">
                                    <label for="alta">Alta</label>
                                    <input type="radio" name="question3" value="100">
                                </div>
                            </td>

                        </tr>
                    @endif    
                    
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
        // Obtener todos los botones de información y todos los mensajes de información
        const infoButtons = document.querySelectorAll('.info-button');
        const infoMessages = document.querySelectorAll('.info-message');
        let activeMessage = null;
    
        // Agregar evento a cada botón
        infoButtons.forEach((button, index) => {
            button.addEventListener('click', (event) => {
                event.stopPropagation(); // Evitar que el clic fuera del botón cierre el mensaje
    
                // Si ya hay un mensaje visible, ocultarlo
                if (activeMessage && activeMessage !== infoMessages[index]) {
                    activeMessage.style.display = 'none';
                }

                // Alternar el mensaje correspondiente al botón actual
                const infoMessage = infoMessages[index];
                if (infoMessage.style.display === 'block') {
                    infoMessage.style.display = 'none';
                    activeMessage = null;
                } else {
                    infoMessage.style.display = 'block';
                    activeMessage = infoMessage;
                }
            });
        });
    
        // Ocultar el mensaje activo al hacer clic fuera
        document.addEventListener('click', () => {
            if (activeMessage) {
                activeMessage.style.display = 'none';
                activeMessage = null;
            }
        });
 
        // Evitar que el clic en el mensaje lo oculte
        infoMessages.forEach((message) => {
            message.addEventListener('click', (event) => {
                event.stopPropagation();
            });
        });
    </script>

    <script>
        function validarEntrada(event) {
            const input = event.target;
            let valor = input.value;

            // Elimina cualquier carácter que no sea un número
            valor = valor.replace(/[^0-9]/g, '');

            // Elimina ceros al principio excepto si el valor es "0"
            if (valor.length > 1 && valor.startsWith('0')) {
                valor = "0";
            }

            // Limita el valor a 100
            if (parseInt(valor) > 100) {
                valor = valor.slice(0, -1);
            }

            // Actualiza el valor del input
            input.value = valor;
        }

        function prevenirPegar(event) {
            // Prevenir que el usuario pegue texto en el campo
            event.preventDefault();
        }
    </script>
    <script>
        $(document).ready(function(){
            // Configurar el token CSRF para todas las solicitudes AJAX
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }

            });
            
            $('#calificarBtn').on('click', function() {
                let notas = [];
                const errorMessage = document.getElementById('error-message');
                let allQuestionsAnswered = true;
                const rangoNumerosInputs = document.querySelectorAll('.rango-numeros');

                let valid = true;

                // Itera sobre todos los inputs con la clase 'rango-numeros'
                rangoNumerosInputs.forEach(input => {
                    const valor = input.value.trim();

                    // Verifica si el campo está vacío o no contiene un número válido
                    if (valor === '' || isNaN(valor) || parseInt(valor) < 0 || parseInt(valor) > 100) {
                        valid = false;
                    }else{
                        notas.push(parseInt(valor));
                    }
                });

                // Recorre todas las preguntas para verificar si se seleccionó una opción en cada una
                // Obtener todos los grupos de radio buttons (agrupados por el atributo 'name')
                let grupos = new Set(); // Utilizar un Set para almacenar los diferentes nombres de grupos
                document.querySelectorAll('input[type="radio"]').forEach((input) => {
                    grupos.add(input.name); // Almacena los nombres de los grupos únicos
                });

                // Recorrer los grupos únicos de radio buttons
                grupos.forEach((groupName) => {
                    const radios = document.querySelectorAll(`input[name="${groupName}"]`); // Obtener los radios del grupo
                    const checkedRadio = Array.from(radios).find(radio => radio.checked); // Encuentra el radio button que está seleccionado

                    if (checkedRadio) {
                        // Si hay un radio button seleccionado, almacenar su valor en el array
                        notas.push(parseInt(checkedRadio.value));
                    } else {
                        allQuestionsAnswered = false; // Si falta alguna selección, cambia a false
                    }
                });

                console.log(notas);

                // Si no están todas las opciones seleccionadas, muestra el mensaje de error
                if (!allQuestionsAnswered || !valid ) {
                    errorMessage.style.display = 'block'; // Muestra el mensaje en rojo

                } else {
                    errorMessage.style.display = 'none'; // Si todo está bien, oculta el mensaje
                    // Aquí puedes añadir el código para enviar la evaluación o lo que quieras hacer al completar correctamente
                    Swal.fire({
                        icon: 'success',
                        title: 'Evaluación completada',
                        text: 'Has calificado correctamente.',
                        allowOutsideClick: false,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Aquí puedes agregar la acción que desees realizar
                            let idEstudiante = $("#id-estudiante").val();
                            window.location.href = `{{ url('/estudiante_home/${idEstudiante}') }}`;

                            // Recarga la página después de presionar "OK"
                            
                        }
                    });

                    let sumatoriaNota = 0;
                    for(let i=0;i<notas.length;i++){
                        sumatoriaNota = sumatoriaNota + notas[i];
                    }

                    sumatoriaNota = sumatoriaNota / notas.length;
                    sumatoriaNota = Math.round(sumatoriaNota);
                    console.log(sumatoriaNota);

                    
                    console.log("id del proyecto" + $("#id-proyecto").val());
                    console.log("id del estudiante" + $("#id-estudiante").val());



                    
                    $.ajax({
                    url: '{{ url('/guardar_nota_autoevaluacion') }}', //nueva url para la comunicación con AJAX
                    method: 'POST',
                    data: {
                        nota: sumatoriaNota,
                        idEstudiante: $("#id-estudiante").val(),
                        idProyecto: $("#id-proyecto").val()
                    }

                    }).fail(function(jqXHR, textStatus, errorThrown) {
                        console.error('Error en la solicitud:', textStatus, errorThrown);
                        console.error('Detalles del error:', jqXHR.responseText);
                    });
                    
                    
                }
    
            });
        });
    </script>
</body>
</html>