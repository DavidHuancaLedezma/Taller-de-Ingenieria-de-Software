<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        /*
        .null{
            border: none ; 
            background-color: #b8b8b8;
            color: #ffffff;
            padding: 10px ;
            border-radius: 10px ;
        }*/
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
            flex-direction: row ;
            justify-content: center;
            align-items: center;
            gap: 20px ;  
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Registro de evaluación de pares</h1>
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
                <tr>
                    <td>David Huanca Ledezma</td>
                    <td><button class="btn-calificar null" data-id="{{1}}">Evaluar</button></td>
                    <td>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;     3</td>
                </tr>
                <tr>
                    <td>Alan Garnica Quispe</td>
                    <td><button class="btn-calificar null" data-id="{{2}}">Evaluar</button></td>
                    <td> &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;      4</td>
                </tr>
                <tr>
                    <td>Cecilia Vergara Zeballos</td>
                    <td><button class="btn-calificar null" data-id="{{3}}">Evaluar</button></td>
                    <td>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; 3</td>
                </tr>
                <tr>
                    <td>Erika Chino Alanoka</td>
                    <td><button class="btn-calificar null" data-id="{{4}}">Evaluar</button></td>
                    <td>&nbsp;&nbsp;&nbsp; No calificado </td>
                </tr>
                <tr>
                    <td>Rodrigo Chocamani Borda</td>
                    <td><button class="btn-calificar null" data-id="{{5}}">Evaluar</button></td>
                    <td>&nbsp;&nbsp;&nbsp; No calificado </td>
                </tr>
            </tbody>
        </table>
    </div>


    <div class="ventana-emergente-calificacion">
            <div class="container">
            <h1>Evaluando a Rodrigo Chocamani Borda</h1>
            
            <div class="columnas">
                <h3 class="criterios">Criterios</h3>
                <h3 class="parametros">Parametros de evaluación</h3>
            </div>
            <table class="likert">
                <thead>
                    
                </thead>
                <tbody>
                    
                        <tr>
                            <td>
                                Responsabilidad
                            </td>
                            <td>
                                <button class="info-button">?</button>
                                <div class="info-message">
                                    Información sobre la responsabilidad
                                </div>
                            </td>
                            <td>
                                <div class="radio-group">
                                    <label for="muy-mal">Muy mal</label>
                                    <input type="radio" value="1">
                                </div>
                            </td>
                            <td>
                                <div class="radio-group">
                                    <label for="mal">Mal</label>
                                    <input type="radio" value="2">
                                </div>
                            </td>
                            <td>
                                <div class="radio-group">
                                    <label for="regular">Regular</label>
                                    <input type="radio" value="3">
                                </div>
                            </td>
                            <td>
                                <div class="radio-group">
                                    <label for="bien">Bien</label>
                                    <input type="radio" value="4">
                                </div>
                            </td>
                            <td>
                                <div class="radio-group">
                                    <label for="muy-bien">Muy bien</label>
                                    <input type="radio" value="5">
                                </div>
                            </td>
                        </tr>
    
                        <tr>
                            <td>Puntualidad</td>
                            <td>
                                <button class="info-button">?</button>
                                <div class="info-message">
                                    Información de la puntualidad
                                </div>
    
                            </td>
    
                            <td>
                                <div class="radio-group">
                                    <label for="falso">Falso</label>
                                    <input type="radio" name="question1" value="1">
                                </div>
                                <td>
                                    <div class="radio-group">
                                        <label for="verdadero">Verdadero</label>
                                        <input type="radio" name="question2" value="5">
                                    </div>
                                </td>
                            </td>
                        </tr>
    
                        <tr>
                            <td>Aporte</td>
                            <td>
                                <button class="info-button">?</button>
                                <div class="info-message">
                                    Información del aporte
                                </div>
                            </td>
                            <td>
                                <div class="radio-group">
                                    <label for="verdadero">Rango [0 - 100]</label>
                                    <input class="rango-numeros" type="text" id="numero" value="0" oninput="validarEntrada(event)" onpaste="prevenirPegar(event)" maxlength="3" />
                                </div>
                            </td>
                        </tr>
                        
                        <tr>
                            <td>Comunicación</td>
                            <td>
                                <button class="info-button">?</button>
                                <div class="info-message">
                                    Informacion de la comunicación
                                </div>
                            </td>
                            <td>
                                <div class="radio-group">
                                    <label for="alta">Alta</label>
                                    <input type="radio" value="1">
                                </div>
                            </td>
                            <td>
                                <div class="radio-group">
                                    <label for="media">Media</label>
                                    <input type="radio" value="1">
                                </div>
                            </td>
                            <td>
                                <div class="radio-group">
                                    <label for="baja">Baja</label>
                                    <input type="radio" value="1">
                                </div>
                            </td>
    
                        </tr>
                </tbody>
            </table>


            <footer class="footer-autoevaluacion">
                <button class="btn-calificar">Calificar</button>
                <button id="btn-cancelar" class="btn-cancelar">Cancelar</button>
            </footer>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).on('click', '.btn-calificar', function() {
            let id_evaluacion_estudiante = $(this).data('id'); // Captura el id del botón presionado
            console.log(id_evaluacion_estudiante);
            $('.ventana-emergente-calificacion').css('display', 'flex');
            
        });
        

        const botonCancelar = document.getElementById('btn-cancelar');
        botonCancelar.addEventListener('click', function() {
            $('.ventana-emergente-calificacion').css('display', 'none');
            $('.ventana-emergente-calificacion input[type="radio"]').prop('checked', false);
        });
    </script>


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

    


</body>
</html>
