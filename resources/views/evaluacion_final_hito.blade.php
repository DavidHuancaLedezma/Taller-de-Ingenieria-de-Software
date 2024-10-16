<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Semanal</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
                * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            color: #333;
        }

        .container {
            width: 70%;
            margin: 30px auto;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 20px;
        }

        header {
            background-color: #40759e;
            color: white;
            text-align: center;
            padding: 20px;
            border-radius: 10px 10px 0 0;
        }

        header h1 {
            font-size: 24px;
        }

        header h2 {
            font-size: 18px;
            margin-top: 10px;
        }
        /*----grafica de semanas-----*/
        .progress-section {
            /*display: flex;*/
            justify-content: center; /* Centra el contenedor horizontalmente */
            align-items: center;     /* Centra el contenedor verticalmente si es necesario */
            /*min-height: 100vh;       /* Asegura que la sección ocupe el 100% de la altura de la ventana */
        }
        .progress-container{
            display: flex;
            width : 50% ;
            margin: 5px 35px;
            min-height : 20px ; 
            gap : 10px ;  
          
        }

        .progress-container .step{
            padding: 0px ;text-align: center;
            flex-grow: 1;
            border: 1px solid rgb(160, 225, 245) ; 
            border-radius: 5px ; 
            justify-content: center;
            
            
        }

        .step p {
            font-size: 12px;  /* Tamaño del texto más pequeño */
            margin: 5px 0 ; 
           
        }

        .completed {
            background-color: lightblue;
            border-color: blue;
        }
        .final-week {
            background-color: darkred;
            color: white;
        }
        main .nroHito{
            margin : 3px 0px 0px 20px ;  
        }
        main .progreso{
            margin : 10px 0px 0px 20px ;  
        }
       

        .main-content {
            display: flex;
            justify-content: space-between;
        }

        .attendance, .description {
            width: 48%;
        }

        .attendance h3, .description h3 {
            background-color: #40759e;
            color: white;
            padding: 10px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }

        .attendance ul {
            list-style: none;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 0 0 5px 5px;
        }

        .attendance ul li {
            margin: 10px 0;
            display: flex;
            justify-content: space-between;
        }
        .description textarea {
            width: 100%;
            height: 100px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 0 0 5px 5px;
        }

        .objectives-section {
            margin-top: 20px;
        }

        .objectives-section table {
            width: 100%;
            border-collapse: collapse;
        }

        .objectives-section th, .objectives-section td {
            padding: 15px;
            text-align: left;
            border: 1px solid #ccc;
        }

        .objectives-section th {
            background-color: #f2f2f2;
        }

        button {
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .button-container {
            display: flex;
            gap: 10px; /* Espacio entre los botones */
        }

     .submit-section {
            text-align: center;
            margin-top: 20px;
        }

        button.save {
            width: 20%;
            background-color: #40759e;
            color: white;
            padding: 15px;
            font-size: 16px;
            margin-top: 20px;
            border-radius: 5px;
            
        }
        h6{
            padding: 7px;
            text-align: center;
            color: white;
        }
        .custom-link {
            color: #3498db; /* Cambia el color del enlace */
            text-decoration: none; /* Elimina el subrayado */
        }

        .custom-link:hover {
            color: #2c3e50; /* Cambia el color cuando pasas el cursor sobre el enlace */
            text-decoration: underline; /* Opcional: muestra subrayado al pasar el cursor */
        }
        textarea:focus {
            border: 2px solid #3F9BBF; /* Cambia el color y grosor del borde */
            outline: none; /* Elimina el borde azul por defecto */
        }
        /* Aumentar el tamaño del checkbox y aplicar color personalizado */
        .styled-checkbox {
            width: 20px;
            height: 20px;
        /* accent-color: #89c2d9; /* Cambia el color del checkbox */
            cursor: pointer;
            
        }

        /* Ajustar la apariencia de la etiqueta asociada */
        .checkbox-container label {
            font-size: 16px; /* Tamaño del texto */
            color: #333;     /* Color del texto */
            display: flex;
            align-items: center;
            gap: 10px;       /* Espacio entre el checkbox y el texto */
            flex-direction: row-reverse; /* ------Cambiar de posición de check--------------------*/
        }

        /* Opcional: Puedes ajustar el espaciado general entre elementos */
        .checkbox-container {
            padding: 5px 0;
        }

    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Registro semanal {{$nombreCorto}}</h1>
            <h2>Evaluación final de Hito {{ $numeroDeHito ?? 'hito no disponible' }}</h2>
        </header>
        <section class="progress-section">
            <div class="progress-container">
                    @foreach ($semanas as $item)
                        <div class="step">
                            <p>{{$item['inicio']}}</p>
                            <p>{{$item['fin']}}</p>
                        </div>
                    @endforeach
                </div>
                @if (count($enProgreso) == 2)
                    <h3 class="control-hoy">Semana: {{$enProgreso[0]}} al {{$enProgreso[1]}}</h3>
                @else
                    <h3 class="control-hoy" style="color:red">{{$enProgreso[0]}}</h3>
                @endif
        </section>  
        <section class="main-content">
            <div class="attendance">
                <h3>Asistencia</h3>
                <ul>
                    @foreach ($estudianteEnAlerta as $estudiante)
                        <li @if($estudiante[1] >= 3) style="color:red;" @endif>
                            {{$estudiante[0]}} 
                            <input name="asistencia[]" value="{{$estudiante[2]}}" type="checkbox" class="asistencia" @if($estudiante[2]) checked @endif>
                        </li>
                    @endforeach
                </ul>   
            </div>
            @if ($mostrarMensaje)
                <h2 class="Mensaje-de-semana-registrada" style="color: red">Esta semana ya fue registrada</h2>
            @endif 
            <div class="description">
                <h3>Descripción</h3>
                <textarea placeholder="Escribe descripción"></textarea>
                <span id="descripcionError" class="error-message"></span>
            </div>
        </section>
        <section class="objectives-section">
            <table>
                <thead>
                    <tr>
                        <th>Entregables</th>
                        <th>Criterios de aceptación</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($objetivos as $objetivo)
                        <tr>
                            <td>{{ $objetivo->descrip_objetivo }}</td>
                            <td>
                                <table class="nested-table">
                                    @foreach ($criteriosDeAceptacion as $criterio)
                                        @if ($criterio->descrip_objetivo === $objetivo->descrip_objetivo)
                                            <tr>
                                                <td class="checkbox-container">
                                                    <label>
                                                        <input type="checkbox" name="criterio_{{ $criterio->id_criterio_aceptacion }}" class="styled-checkbox">
                                                        <span>{{ $criterio->descripcion_ca }}</span>
                                                    </label>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </table>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>

        <div class="submit-section">
            <button class="save">Guardar <i class="bi bi-rocket-takeoff-fill"></i></button>
        </div>
    </div>
    <script>
        function setProgress(stepCount) {
            const steps = document.querySelectorAll('.step');
            steps.forEach((step, index) => {
                if (index < stepCount) {
                    step.classList.add('completed'); 
                } else {
                    step.classList.remove('completed');
                }
            });
        }

        function highlightFinalWeek() {
            const steps = document.querySelectorAll('.step');
            if (steps.length > 0) {
                const lastStep = steps[steps.length - 1];
                lastStep.classList.add('final-week');
            }
        }

        const numero =  '{{ $numeroColor }}'; // Reemplazar con valor dinámico
        setProgress(numero);
        highlightFinalWeek();
    </script>
</body>
</html>
