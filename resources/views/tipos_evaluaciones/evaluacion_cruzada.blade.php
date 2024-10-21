<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Evaluacion de pares Escala Likert</title>
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
        }

        .container {
            background-color: white;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 750px ; 
        }

        h1 {
            text-align: center;
            min-height: 100px ; 
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
        /* Centrar los números de calificación */
        table.likert .calificacion {
            text-align: center;
        }

    </style>
    <style>
        .ventana-emergente-calificacion {
            display: none; /* Oculto inicialmente */
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
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
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

        .ventana-emergente-calificacion table.likert input[type="radio"] {
            transform: scale(1.5);
            margin: 0 10px;
        }

        .ventana-emergente-calificacion img {
            width: 40px;
            height: 55px;
        }

        .ventana-emergente-calificacion .btn-calificar{
            border: none ; 
            background-color: #367FA9;
            color: #ffffff;
            padding: 10px ;
            border-radius: 10px ;
        }

        .ventana-emergente-calificacion .btn-cancelar{
            border: none ; 
            background-color: #a93636;
            color: #ffffff;
            padding: 10px ;
            border-radius: 10px ;
        }

        .ventana-emergente-calificacion .container .footer-autoevaluacion{
            width: 100% ;
            display: flex;
            flex-direction: column ;
            justify-content: center;
            align-items: center;
            gap: 5px ;  
        }
    </style>
    <style>
        /*Estilos de la ventana emergente con criterios y parametros de evaluación*/
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

        .error-message {
            color: red;
            display: none; /* Oculto por defecto */
            margin-bottom: 10px;
            text-align: center;
            font-size: 16px;
        }

        #calificarBtnForm{
            border: none ; 
            background-color: #367FA9;
            color: #ffffff;
            padding: 10px ;
            border-radius: 10px ;
        }

        .null{
            border: none ; 
            background-color: #b8b8b8;
            color: #ffffff;
            padding: 10px ;
            border-radius: 10px ;
        }
    </style>
</head>
<body>
    <input id="id-evaluacion" type="hidden" value="">
    <input id="id-evaluador" type="hidden" value="{{$idEvaluador}}">
    <input id="id-grupo-empresa-a-evaluar" type="hidden" value="">
    <div class="container">
        <h1>Registro de evaluación cruzada</h1>
        <table class="likert">
            <thead>
                <tr>
                    <th>Integrantes de GE</th>
                    <th>

                    </th>
                    <th>
                        Calificacion
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($grupoEmpresas as $item)
                    <tr>
                        <td>{{$item->nombre_corto}}</td>
                        
                        @php
                            $valorCambiado = 0;  // Inicializas la variable fuera del bucle
                        @endphp
                        @foreach ($grupoEmpresasCalificadas as $geCalificados)
                            @if ($geCalificados->id_grupo_empresa == $item->id_grupo_empresa)
                                <td><button class="null" data-id="{{ $item->id_grupo_empresa }}" disabled>Evaluar</button></td>
                                <td>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; {{$geCalificados->puntaje}}/100 </td>
                                @php
                                    $valorCambiado = 1;  // Inicializas la variable fuera del bucle
                                @endphp
                            @endif
                            
                        @endforeach
                        @if ($valorCambiado != 1)
                            <td><button class="btn-calificar" data-id="{{ $item->id_grupo_empresa }}">Evaluar</button></td>
                            <td>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;    No calificado</td>
                        @endif


                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="ventana-emergente-calificacion">
            <div class="container">
            <h1 id="titulo-evaluacion-grupo-empresa">Evaluando a EliteSoft</h1>
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
                    <p id="error-message" class="error-message">Por favor, selecciona una opción en cada parámetro de calificación.</p>
                </div> 
                <div> 
                    <button id="calificarBtnForm" class="btn-calificar-form" >Calificar</button>
                    <button id="btn-cancelar" class="btn-cancelar">Cancelar</button>
                </div> 
            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).on('click', '.btn-calificar', function() {
            // Configurar el token CSRF para todas las solicitudes AJAX
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
            });

            let id_grupo_empresa = $(this).data('id'); // Captura el id del botón presionado
            console.log(id_grupo_empresa);
            $("#id-grupo-empresa-a-evaluar").val(id_grupo_empresa);

            $.ajax({
                url: '{{ url('/obtener_criterios_y_parametros') }}', //nueva url para la comunicación con AJAX
                method: 'POST',
                data: {
                    idGrupoEmpresa: id_grupo_empresa 
                }

            }).done(function(res){
                let criteriosParametros = JSON.parse(res);
                console.log(criteriosParametros);
                try {
                    $("#id-evaluacion").val(criteriosParametros[0].id_evaluacion);
                } catch (error) {
                    console.log(error);
                }
                

                let template = "";
                for(let i=0; i<criteriosParametros.length; i++){
                    if(criteriosParametros[i].nombre_parametro === "Escala Likert"){
                        $('#titulo-evaluacion-grupo-empresa').html("Evaluando a " + criteriosParametros[i].nombre_corto);
                        template += `
                            <tr>
                                <td>
                                    ${criteriosParametros[i].evaluacion}
                                </td>
                                <td>
                                    <button class="info-button">?</button>
                                    <div class="info-message">
                                        ${criteriosParametros[i].descripcion_evaluacion}
                                    </div>
                                </td>
                                <td>
                                    <div class="radio-group">
                                        <label>Deficiente</label>
                                        <input type="radio" name="question${i}" value="10">
                                    </div>
                                </td>
                                <td>
                                    <div class="radio-group">
                                        <label>Malo</label>
                                        <input type="radio" name="question${i}" value="30">
                                    </div>
                                </td>
                                <td>
                                    <div class="radio-group">
                                        <label >Regular</label>
                                        <input type="radio" name="question${i}" value="50">
                                    </div>
                                </td>
                                <td>
                                    <div class="radio-group">
                                        <label >Bueno</label>
                                        <input type="radio" name="question${i}" value="75">
                                    </div>
                                </td>
                                <td>
                                    <div class="radio-group">
                                        <label >Excelente</label>
                                        <input type="radio" name="question${i}" value="100">
                                    </div>
                                </td>
                            </tr>
                        `;

                    }
                    if(criteriosParametros[i].nombre_parametro === "Elección binaria"){
                        template += `
                            <tr>
                                <td>${criteriosParametros[i].evaluacion}</td>
                                <td>
                                    <button class="info-button">?</button>
                                    <div class="info-message">
                                        ${criteriosParametros[i].descripcion_evaluacion}
                                    </div>
        
                                </td>
        
                                <td>
                                    <div class="radio-group">
                                        <label >Falso</label>
                                        <input type="radio" name="question${i}" value="15">
                                    </div>
                                    <td>
                                        <div class="radio-group">
                                            <label >Verdadero</label>
                                            <input type="radio" name="question${i}" value="100">
                                        </div>
                                    </td>
                                </td>
                            </tr>
                            
                        `;

                    }
                    if(criteriosParametros[i].nombre_parametro === "Numeral entero"){
                        template += `
                            <tr>
                                <td>${criteriosParametros[i].evaluacion}</td>
                                <td>
                                    <button class="info-button">?</button>
                                    <div class="info-message">
                                        ${criteriosParametros[i].descripcion_evaluacion}
                                    </div>
                                </td>
                                <td>
                                    <div class="radio-group">
                                        <label >Rango [0 - 100]</label>
                                        <input class="rango-numeros" type="text" id="numero" value="0" oninput="validarEntrada(event)" onpaste="prevenirPegar(event)" maxlength="3" />
                                    </div>
                                </td>
                            </tr>
                        
                        `;
                    }
                    if(criteriosParametros[i].nombre_parametro === "Categoria"){
                        template += `
                            <tr>
                                <td>${criteriosParametros[i].evaluacion}</td>
                                <td>
                                    <button class="info-button">?</button>
                                    <div class="info-message">
                                        ${criteriosParametros[i].descripcion_evaluacion}
                                    </div>
                                </td>
                                <td>
                                    <div class="radio-group">
                                        <label >Baja</label>
                                        <input type="radio" name="question${i}" value="10">
                                    </div>
                                </td>
                                <td>
                                    <div class="radio-group">
                                        <label >Media</label>
                                        <input type="radio" name="question${i}" value="50">
                                    </div>
                                </td>
                                <td>
                                    <div class="radio-group">
                                        <label >Alta</label>
                                        <input type="radio" name="question${i}" value="100">
                                    </div>
                                </td>
                            </tr>
                        `;

                    }
                    
                }
                $("#contenido-tabla").html(template);
                $('.ventana-emergente-calificacion').css('display', 'flex');

            }).fail(function(jqXHR, textStatus, errorThrown) {
                console.error('Error en la solicitud:', textStatus, errorThrown);
                console.error('Detalles del error:', jqXHR.responseText);
            });
        });
        const errorMessage = document.getElementById('error-message');
        const botonCancelar = document.getElementById('btn-cancelar');
        botonCancelar.addEventListener('click', function() {
            $('.ventana-emergente-calificacion').css('display', 'none');
            $('.ventana-emergente-calificacion input[type="radio"]').prop('checked', false);
            errorMessage.style.display = 'none';
        });
    </script>
    <script>
        $(document).on('click', '.info-button', function(event) {
            event.stopPropagation(); // Evitar que el clic fuera del botón cierre el mensaje
            const infoMessage = $(this).next('.info-message'); // Selecciona el div de mensaje siguiente al botón
            if (infoMessage.css('display') === 'block') {
                infoMessage.css('display', 'none');
            } else {
                $('.info-message').css('display', 'none'); // Cierra cualquier otro mensaje abierto
                infoMessage.css('display', 'block');
            }
        });

        $(document).on('click', function() {
            $('.info-message').css('display', 'none'); // Ocultar todos los mensajes al hacer clic fuera
        });

        $(document).on('click', '.info-message', function(event) {
            event.stopPropagation(); // Prevenir que el mensaje se cierre si se hace clic en él
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

            $('#calificarBtnForm').on('click', function() {
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

                    let sumatoriaNota = 0;
                    for(let i=0;i<notas.length;i++){
                        sumatoriaNota = sumatoriaNota + notas[i];
                    }

                    sumatoriaNota = sumatoriaNota / notas.length;
                    sumatoriaNota = Math.round(sumatoriaNota);

                    //eliminar inicio
                    console.log(sumatoriaNota + "<------- Esta en la linea 606");
                    console.log("ID DE EVALUACION ---->" + $("#id-evaluacion").val());
                    console.log("ID EVALUADOR: " + $("#id-evaluador").val());

                    console.log("id ge a evaluar.-" + $("#id-grupo-empresa-a-evaluar").val());
                    //fin eliminar


                    $.ajax({
                        url: '{{ url('/guardar_nota_evaluacion_cruzada') }}', //nueva url para la comunicación con AJAX
                        method: 'POST',
                        data: {
                            nota: sumatoriaNota, // Posible error si no hay nota(La base de datos tiene que estar llenado todas las grupo empresas con su evaluacion cruzada)
                            idEvaluacion: $("#id-evaluacion").val(),
                            idEvaluador: $("#id-evaluador").val(),
                            idGrupoEmpresaEvaluada: $("#id-grupo-empresa-a-evaluar").val()
                        }
                    });

                    Swal.fire({
                        icon: 'success',
                        title: 'Evaluación completada',
                        text: 'Has calificado correctamente.',
                        allowOutsideClick: false,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Aquí puedes agregar la acción que desees realizar
                            $('.ventana-emergente-calificacion').css('display', 'none');
                            // Limpiar los valores seleccionados en los inputs
                            $('.ventana-emergente-calificacion input[type="radio"]').prop('checked', false);
                            $('.ventana-emergente-calificacion .rango-numeros').val('');
                            // Ocultar el mensaje de error
                            errorMessage.style.display = 'none';

                            // Recarga la página después de presionar "OK"
                            location.reload();
                        }
                    });

 

                }
            });
        });
    </script>
</body>
</html>
