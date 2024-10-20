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
            width: 80%;
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

        .entregable-column {
            width: 80%; 
        }

        .evaluar-column {
            width: 20%; 
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
            background-color: #33789E;
            color: white;
            padding: 15px;
            font-size: 16px;
            margin-top: 20px;
            border-radius: 5px;
            
        }
        button.addHU{
            
            background-color: #33789E;
            color: white;
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
        .seccion_dos {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }
        .bloque_uno{
            width: 70%;
        }
        .block_dos{
            width: 30%;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #40759e;
            color: white;
        }

        td {
            border: 1px solid #ccc;
        }

        .stile-text{
            width: 100%;
            padding: 5px;
        }
        .error {
            color: red;
            font-size: 12px;
            margin-top: 5px;
        }
        .btn-eliminar {
            background-color: red; /* Color de fondo rojo */
            color: white;          /* Texto blanco */
            border: none;          /* Sin bordes */
            padding: 5px 10px;     /* Espaciado interno */
            border-radius: 5px;    /* Bordes redondeados */
            cursor: pointer;       /* Cambiar cursor al pasar por encima */
        }

        .btn-eliminar:hover {
            background-color: darkred; /* Cambia de color al pasar el ratón */
        }
        @media (max-width: 900px) {
            .seccion_dos {
                flex-direction: column; /* Cambia la disposición de los elementos a columna */
            }

            .sprint, .main-content {
                padding: 10px;
                width: 100%; /* Ambos bloques ocupan el 100% del ancho */
            }
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
          <section class= "seccion_dos">
            <div class="bloque_uno"> 
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
                        <textarea id="descripcion_control_semanal" placeholder="Escribe descripción" oninput="validarDescripcionControlSemanal()"></textarea>
                        <span id="descripcionError" class="error"></span>
                    </div>
                </section>
                <section class="objectives-section">
                    <table>
                        <thead>
                            <tr>
                                <th class="entregable-column">Entregables</th>
                                <th class="evaluar-column">Evaluar</th>                            
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($objetivos as $objetivo)
                                <tr>
                                    <td>{{ $objetivo->descrip_objetivo }}</td>
                                    <td>
                                    <input type="checkbox" ></td>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </section>
            </div>
            <div class="bloque_dos">
                <table id="tabla-dinamica">
                    <thead>
                        <tr>
                           
                            <th>Historia de Usuario</th>
                            <th>Estimación</th>
                            <th>Observación</th>
                            <th>Evaluar</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Las filas se añadirán aquí -->
                        @foreach ($historiaUsuario as $hu)
                                <tr>
                                    <td>{{ $hu->titulo_hu }}</td>
                                    <td>{{ $hu->estimacion_hu}}</td>
                                    <td>
                                    <textarea id="textarea_hu_{{ $hu->id_hu }}" class="stile-text" placeholder="Editar Descripción">{{ $hu->descripcion_eva_hu }}</textarea>
                                    </td>
                                    <td>
                                    <input type="checkbox" class="stile-text">
                                    </td>
                                </tr>
                            @endforeach
                    </tbody>
                </table>
                
                <button class="addHU" onclick="agregarFila()">Añadir +</button>
            </div>
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

        function agregarFila() {
        const tabla = document.getElementById("tabla-dinamica").getElementsByTagName("tbody")[0];
        const nuevaFila = tabla.insertRow();
        const rowIndex = tabla.rows.length;

        // Crear y agregar celdas con campos de entrada y divs para mensajes de error
        nuevaFila.insertCell(0).innerHTML = `<input type="text" id="historia_${rowIndex}" placeholder="Historia de usuario" class="stile-text">
                                             <div id="error_historia_${rowIndex}" class="error"></div>`;
        nuevaFila.insertCell(1).innerHTML = `<input type="text" id="estimacion_${rowIndex}" placeholder="Estimación" class="stile-text">
                                             <div id="error_estimacion_${rowIndex}" class="error"></div>`;
        nuevaFila.insertCell(2).innerHTML = `<input type="text" id="descripcion_${rowIndex}" placeholder="Observación" class="stile-text">
                                             <div id="error_descripcion_${rowIndex}" class="error"></div>`;
        nuevaFila.insertCell(3).innerHTML = '<input type="checkbox" class="stile-text">';
        
        nuevaFila.insertCell(4).innerHTML = `<button class="btn-eliminar" onclick="eliminarFila(this)">Eliminar</button>`;

        // Asignar validaciones en tiempo real
        agregarValidaciones(rowIndex);
    }
    function eliminarFila(boton) {
        // Eliminar la fila correspondiente
        const fila = boton.parentNode.parentNode;
        fila.parentNode.removeChild(fila);
    }
    function agregarValidaciones(index) {
        const historiaInput = document.getElementById(`historia_${index}`);
        const estimacionInput = document.getElementById(`estimacion_${index}`);
        const descripcionInput = document.getElementById(`descripcion_${index}`);

        // Validar "Historia de Usuario" en tiempo real
        historiaInput.addEventListener('input', function() {
            validarHistoriaUsuario(index);
        });

        // Validar "Estimación" en tiempo real
        estimacionInput.addEventListener('input', function() {
            validarEstimacion(index);
        });

        // Validar "Descripción" en tiempo real
        descripcionInput.addEventListener('input', function() {
            validarDescripcion(index);
        });
    }

    function validarHistoriaUsuario(index) {
        const historiaInput = document.getElementById(`historia_${index}`);
        const errorHistoria = document.getElementById(`error_historia_${index}`);

        if (historiaInput.value.length > 80) {
            errorHistoria.innerHTML = "La Historia de Usuario no debe superar los 80 caracteres.";
        } else {
            errorHistoria.innerHTML = ""; // Limpiar el error si es válido
        }
    }

    function validarEstimacion(index) {
        const estimacionInput = document.getElementById(`estimacion_${index}`);
        const errorEstimacion = document.getElementById(`error_estimacion_${index}`);

        if (!/^\d+$/.test(estimacionInput.value)) {
            errorEstimacion.innerHTML = "La Estimación debe ser un valor numérico.";
        } else {
            errorEstimacion.innerHTML = ""; // Limpiar el error si es válido
        }
    }

    function validarDescripcion(index) {
        const descripcionInput = document.getElementById(`descripcion_${index}`);
        const errorDescripcion = document.getElementById(`error_descripcion_${index}`);

        if (descripcionInput.value.length > 500) {
            errorDescripcion.innerHTML = "La Descripción no debe superar los 500 caracteres.";
        } else {
            errorDescripcion.innerHTML = ""; // Limpiar el error si es válido
        }
    }

    function validarFormulario() {
        const filas = document.querySelectorAll("#tabla-dinamica tbody tr");
        let formularioValido = true;

        filas.forEach((fila, index) => {
            // Validar cada campo al hacer submit
            validarHistoriaUsuario(index + 1);
            validarEstimacion(index + 1);
            validarDescripcion(index + 1);

            // Verifica si hay errores
            const errorHistoria = document.getElementById(`error_historia_${index + 1}`).innerHTML;
            const errorEstimacion = document.getElementById(`error_estimacion_${index + 1}`).innerHTML;
            const errorDescripcion = document.getElementById(`error_descripcion_${index + 1}`).innerHTML;

            if (errorHistoria || errorEstimacion || errorDescripcion) {
                formularioValido = false;
            }
        });

        if (formularioValido) {
            alert("Formulario enviado correctamente");
        } else {
            alert("Hay errores en el formulario. Por favor, corrígelos.");
        }
    }
    function validarDescripcionControlSemanal() {
        const descripcion = document.getElementById('descripcion_control_semanal').value;
        const errorMensaje = document.getElementById('descripcionError');
        
        let error = '';
        
        // 1. Validar límite de 500 caracteres
        if (descripcion.length > 500) {
            error = "La descripción no debe exceder los 500 caracteres.";
        }

        // 2. Validar que no haya más de 20 caracteres especiales
        const caracteresEspeciales = descripcion.match(/[^a-zA-Z0-9\s]/g); // Coincide con todos los caracteres no alfanuméricos
        if (caracteresEspeciales && caracteresEspeciales.length > 20) {
            error = "La descripción no debe contener más de 20 caracteres especiales.";
        }

        // 3. Validar que no contenga solo valores numéricos
        if (/^\d+$/.test(descripcion)) {
            error = "La descripción no puede ser solo valores numéricos.";
        }

        // Mostrar el mensaje de error debajo del campo si hay algún error
        errorMensaje.textContent = error;
    }
    </script>
</body>
</html>