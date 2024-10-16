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
            <h1>Evaluacion de integrante</h1>
            <table class="likert">
                <thead>
                    <tr>
                        <th>Evaluando a Rodrigo</th>
                        <th><img src="{{ asset('img/emoji_muy_mal.png') }}" alt="Muy Mal"></th>
                        <th><img src="{{ asset('img/emoji_mal.png') }}" alt="Mal"></th>
                        <th><img src="{{ asset('img/emoji_regular.png') }}" alt="Regular"></th>
                        <th><img src="{{ asset('img/emoji_bien.png') }}" alt="Bien"></th>
                        <th><img src="{{ asset('img/emoji_muy_bien2.png') }}" alt="Muy Bien"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Puntualidad</td>
                        <td><input type="radio" name="question1" value="1"></td>
                        <td><input type="radio" name="question1" value="2"></td>
                        <td><input type="radio" name="question1" value="3"></td>
                        <td><input type="radio" name="question1" value="4"></td>
                        <td><input type="radio" name="question3" value="4"></td>
                    </tr>
                    <tr>
                        <td>Responsabilidad</td>
                        <td><input type="radio" name="question2" value="1"></td>
                        <td><input type="radio" name="question2" value="2"></td>
                        <td><input type="radio" name="question2" value="3"></td>
                        <td><input type="radio" name="question2" value="4"></td>
                        <td><input type="radio" name="question3" value="4"></td>
                    </tr>
                    <tr>
                        <td>Actividad</td>
                        <td><input type="radio" name="question3" value="1"></td>
                        <td><input type="radio" name="question3" value="2"></td>
                        <td><input type="radio" name="question3" value="3"></td>
                        <td><input type="radio" name="question3" value="4"></td>
                        <td><input type="radio" name="question3" value="4"></td>
                    </tr>
                    <tr>
                        <td>Rendimiento.</td>
                        <td><input type="radio" name="question1" value="1"></td>
                        <td><input type="radio" name="question1" value="2"></td>
                        <td><input type="radio" name="question1" value="3"></td>
                        <td><input type="radio" name="question1" value="4"></td>
                        <td><input type="radio" name="question3" value="4"></td>
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
</body>
</html>
