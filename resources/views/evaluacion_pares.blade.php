<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Evaluacion de pares</title>
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
            background-color: #D2D6DE;
        }

        .container {
            background-color: white;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 750px;
        }

        h1 {
            text-align: center;
            min-height: 100px;
            width: 100%;
            color: #ffffff;
            background-color: #367FA9;
            display: flex;
            align-items: center;
            justify-content: center;
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

        table.likert input[type="radio"][name="rating"] {
            transform: scale(1.5);
            margin: 0 10px;
        }

        img {
            width: 40px;

            height: 55px;
        }

        .btn-calificar {
            border: none;
            background-color: #367FA9;
            color: #ffffff;
            padding: 10px;
            border-radius: 10px;
        }

        .container .footer-autoevaluacion {
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        /* Centrar los números de calificación */
        table.likert .calificacion {
            text-align: center;
        }
    </style>

    <style>
        .ventana-emergente-calificacion {
            display: none;
            /* Oculto inicialmente */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 500;
        }

        .ventana-emergente-calificacion .container {
            /*background-color: white;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 750px;*/
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border: 2px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            z-index: 1000;
        }

        .ventana-emergente-calificacion h1 {
            text-align: center;
            margin-bottom: 20px;
            width: 100%;
            color: #ffffff;
            background-color: #367FA9;
        }

        .ventana-emergente-calificacion table.likert {
            width: 100%;
            border-collapse: collapse;
        }

        .ventana-emergente-calificacion table.likert th,
        .ventana-emergente-calificacion table.likert td {
            padding: 10px;
            text-align: left;
        }

        .ventana-emergente-calificacion table.likert th {
            font-size: 18px;
        }

        .ventana-emergente-calificacion table.likert td {
            border: none;
        }

        .ventana-emergente-calificacion table.likert input[type="radio"][name="rating"] {
            transform: scale(1.5);
            margin: 0 10px;
        }

        .ventana-emergente-calificacion img {
            width: 40px;
            height: 55px;
        }

        .ventana-emergente-calificacion .btn-calificar {
            border: none;
            background-color: #367FA9;
            color: #ffffff;
            padding: 10px;
            border-radius: 10px;
        }

        .ventana-emergente-calificacion .btn-cancelar {
            border: none;
            background-color: #a93636;
            color: #ffffff;
            padding: 10px;
            border-radius: 10px;
        }

        .ventana-emergente-calificacion .container .footer-autoevaluacion {
            width: 100%;
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            gap: 20px;
        }
    </style>

    <style>
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
            background-color: #00BFFF;
            /* Celeste */
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
            top: 35px;
            /* Debajo del botón */
            left: 0px;
            max-width: 200px;
            /* Ancho aceptable */
            min-width: 150px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            z-index: 10;
            word-wrap: break-word;
        }

        table.likert td {
            border: none;
            position: relative;
            /* Asegura que el mensaje emergente esté posicionado respecto al td */
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

        .error-message {
            color: red;
            display: none;
            margin-bottom: 10px;
            text-align: center;
            font-size: 16px;
        }

        #calificarBtnForm {
            border: none;
            background-color: #367FA9;
            color: #ffffff;
            padding: 10px;
            border-radius: 10px;
        }

        .null {
            border: none;
            background-color: #b8b8b8;
            color: #ffffff;
            padding: 10px;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <input id="id-evaluacion" type="hidden" value="">
    <input id="id-evaluador" type="hidden" value="{{ $idEvaluador ?? '' }}">
    <input id="id-estudiante-a-evaluar" type="hidden" value="">
    <div class="container">
        <h1>Registro de evaluación de pares</h1>
        <table class="likert">
            <thead>
                <tr>
                    <th>Integrantes de GE</th>
                    <th>
                        Acción
                    </th>
                    <th>
                        Calificacion
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($estudiantes ?? [] as $item)
                    @if ($item->id_usuario != $idEvaluador)
                        <tr>
                            <td>{{ $item->nombre_estudiante }}</td>

                            @php
                                $valorCambiado = 0; // Inicializas la variable fuera del bucle
                            @endphp

                            @foreach ($estudiantesCalificados ?? [] as $eCalificados)
                                @if ($eCalificados->otro_id_estudiante == $item->id_usuario)
                                    <td><button class="null" data-id="{{ $item->id_usuario }}"
                                            disabled>Evaluar</button></td>
                                    <td>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; {{ $eCalificados->puntaje }}/100 </td>
                                    @php
                                        $valorCambiado = 1; // Cambias el valor indicando que ya fue calificado
                                    @endphp
                                @endif
                            @endforeach

                            @if ($valorCambiado != 1)
                                <td><button class="btn-calificar" data-id="{{ $item->id_usuario }}"
                                        data-nombre="{{ $item->nombre_estudiante }}">Evaluar</button></td>
                                <td>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; No calificado</td>
                            @endif
                        </tr>
                    @endif
                @endforeach

            </tbody>
        </table>
    </div>


    <div class="ventana-emergente-calificacion">
        <div class="container">
            <h1 id="nombre-estudiante-evaluado">Evaluando a <span></span></h1>

            <div class="columnas">
                <h3 class="criterios">Criterios</h3>
                <h3 class="parametros">Parametros de evaluación</h3>
            </div>
            <table class="likert">
                <thead>
                </thead>
                <tbody id="contenido-tabla">
                </tbody>
            </table>
            <footer class="footer-autoevaluacion">
                <div>
                    <p id="error-message" class="error-message">Por favor, selecciona una opción en cada parámetro de
                        calificación.</p>
                </div>
                <div>
                    <button id="calificarBtnForm" class="btn-calificar-form">Calificar</button>
                    <button id="btn-cancelar" class="btn-cancelar">Cancelar</button>
                </div>
            </footer>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Modificación del script de evaluación de pares
        $(document).on('click', '.btn-calificar', function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let idEstudiante = $(this).data('id');
            let nombreEstudiante = $(this).data('nombre');
            $('#id-estudiante-a-evaluar').val(idEstudiante);

            if (typeof idEstudiante === 'undefined' || idEstudiante === '') {
                console.error('ID del estudiante no válido:', idEstudiante);
                return;
            }

            $('.ventana-emergente-calificacion h1').text('Evaluando a ' + nombreEstudiante);

            $.ajax({
                url: "/obtener_criterios_y_parametros",
                method: 'POST',
                data: {
                    idEstudiante: idEstudiante
                },
                success: function(response) {
                    // Asegurarse de que no necesitamos parsear si ya es JSON
                    let criteriosParametros = typeof response === 'string' ? JSON.parse(response) :
                        response;

                    try {
                        $("#id-evaluacion").val(criteriosParametros[0].id_evaluacion);
                    } catch (error) {
                        console.error("Error al establecer id_evaluacion:", error);
                    }

                    let template = "";
                    criteriosParametros.forEach((item, i) => {
                        switch (item.nombre_parametro) {
                            case "Escala Likert":
                                template += createLikertScale(item, i);
                                break;
                            case "Elección binaria":
                                template += createBinaryChoice(item, i);
                                break;
                            case "Numeral entero":
                                template += createNumeralInput(item, i);
                                break;
                            case "Categoria":
                                template += createCategoryScale(item, i);
                                break;
                        }
                    });

                    $("#contenido-tabla").html(template);
                    $('.ventana-emergente-calificacion').css('display', 'flex');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error en la solicitud:', textStatus, errorThrown);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Hubo un error al cargar los criterios de evaluación'
                    });
                }
            });
        });

        // Funciones auxiliares para crear templates
        function createLikertScale(item, index) {
            return `
        <tr>
            <td>${item.evaluacion}</td>
            <td>
                <button class="info-button">?</button>
                <div class="info-message">${item.descripcion_evaluacion}</div>
            </td>
            <td>
                <div class="radio-group">
                    <label>Deficiente</label>
                    <input type="radio" name="question${index}" value="10">
                </div>
            </td>
            <td>
                <div class="radio-group">
                    <label>Malo</label>
                    <input type="radio" name="question${index}" value="30">
                </div>
            </td>
            <td>
                <div class="radio-group">
                    <label>Regular</label>
                    <input type="radio" name="question${index}" value="50">
                </div>
            </td>
            <td>
                <div class="radio-group">
                    <label>Bueno</label>
                    <input type="radio" name="question${index}" value="75">
                </div>
            </td>
            <td>
                <div class="radio-group">
                    <label>Excelente</label>
                    <input type="radio" name="question${index}" value="100">
                </div>
            </td>
        </tr>
    `;
        }

        function createBinaryChoice(item, index) {
            return `
        <tr>
            <td>${item.evaluacion}</td>
            <td>
                <button class="info-button">?</button>
                <div class="info-message">${item.descripcion_evaluacion}</div>
            </td>
            <td>
                <div class="radio-group">
                    <label>Falso</label>
                    <input type="radio" name="question${index}" value="15">
                </div>
            </td>
            <td>
                <div class="radio-group">
                    <label>Verdadero</label>
                    <input type="radio" name="question${index}" value="100">
                </div>
            </td>
        </tr>
    `;
        }

        function createNumeralInput(item, index) {
            return `
        <tr>
            <td>${item.evaluacion}</td>
            <td>
                <button class="info-button">?</button>
                <div class="info-message">${item.descripcion_evaluacion}</div>
            </td>
            <td>
                <div class="radio-group">
                    <label>Rango [0 - 100]</label>
                    <input class="rango-numeros" type="text" id="numero${index}" value="0" 
                           oninput="validarEntrada(event)" onpaste="prevenirPegar(event)" maxlength="3" />
                </div>
            </td>
        </tr>
    `;
        }

        function createCategoryScale(item, index) {
            return `
        <tr>
            <td>${item.evaluacion}</td>
            <td>
                <button class="info-button">?</button>
                <div class="info-message">${item.descripcion_evaluacion}</div>
            </td>
            <td>
                <div class="radio-group">
                    <label>Baja</label>
                    <input type="radio" name="question${index}" value="10">
                </div>
            </td>
            <td>
                <div class="radio-group">
                    <label>Media</label>
                    <input type="radio" name="question${index}" value="50">
                </div>
            </td>
            <td>
                <div class="radio-group">
                    <label>Alta</label>
                    <input type="radio" name="question${index}" value="100">
                </div>
            </td>
        </tr>
    `;
        }

        // Modificación del script de guardado
        $('#calificarBtnForm').on('click', function() {
            let notas = [];
            const errorMessage = document.getElementById('error-message');
            let allQuestionsAnswered = true;

            // Validar campos numéricos
            const rangoNumerosInputs = document.querySelectorAll('.rango-numeros');
            rangoNumerosInputs.forEach(input => {
                const valor = input.value.trim();
                if (valor === '' || isNaN(valor) || parseInt(valor) < 0 || parseInt(valor) > 100) {
                    allQuestionsAnswered = false;
                } else {
                    notas.push(parseInt(valor));
                }
            });

            // Validar radio buttons
            const grupos = new Set();
            document.querySelectorAll('input[type="radio"]').forEach((input) => {
                grupos.add(input.name);
            });

            grupos.forEach((groupName) => {
                const radios = document.querySelectorAll(`input[name="${groupName}"]`);
                const checkedRadio = Array.from(radios).find(radio => radio.checked);
                if (checkedRadio) {
                    notas.push(parseInt(checkedRadio.value));
                } else {
                    allQuestionsAnswered = false;
                }
            });

            if (!allQuestionsAnswered) {
                errorMessage.style.display = 'block';
                return;
            }

            errorMessage.style.display = 'none';
            const promedio = Math.round(notas.reduce((a, b) => a + b) / notas.length);

            $.ajax({
                url: "/guardar_nota_evaluacion_pares",
                method: 'POST',
                data: {
                    nota: promedio,
                    idEvaluacion: $("#id-evaluacion").val(),
                    idEstudianteEvaluado: $("#id-estudiante-a-evaluar").val(),
                    idEstudiante: $("#id-evaluador").val()
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Evaluación completada',
                        text: 'Has calificado correctamente.',
                        allowOutsideClick: false,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Hubo un error al guardar la calificación'
                    });
                }
            });
        });
        const botonCancelar = document.getElementById('btn-cancelar');
        botonCancelar.addEventListener('click', function() {
            $('.ventana-emergente-calificacion').css('display', 'none');
            $('.ventana-emergente-calificacion input[type="radio"]').prop('checked', false);
            errorMessage.style.display = 'none';
        });
    </script>

</body>

</html>
