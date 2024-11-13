<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Semanal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

        @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: "{{ session('success') }}",
            });
        </script>
        @endif
        @if(session('error'))
        <script>
            Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "{{ session('error') }}",
            });
        </script>
        @endif
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
        <form action="{{ route('finHito.store', ['id_hito' => $idHito]) }}" method="POST" id="evaluacionForm">
            @csrf
            <section class="seccion_dos">
                <div class="bloque_uno"> 
                    <section class="main-content">
                        <div class="attendance">
                            <h3>Asistencia</h3>
                            <ul>
                                @foreach ($estudianteEnAlerta as $estudiante)
                                    <li @if($estudiante[1] >= 3) style="color:red;" @endif>
                                        {{$estudiante[0]}} 
                                        <input type="hidden" name="faltas[]" value="{{$estudiante[2]}}">
                                        <input name="asistencia[]" value="{{$estudiante[2]}}" type="checkbox" class="asistencia" @if($estudiante[2]) checked @endif>
                                       
                                    </li>
                                @endforeach
                            </ul>   
                        </div>
                        <div class="description">
                            <h3>Descripción</h3>
                            <textarea id="descripcion_control_semanal" name="descripcion_control_semanal" placeholder="Escribe descripción" oninput="validarDescripcionControlSemanal()">{{ old('descripcion_control_semanal') }}</textarea>

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
                                            <input type="checkbox" name="evaluar[{{ $objetivo->id_objetivo }}]" value="{{ $objetivo->id_objetivo }}" {{ $objetivo->entregado_ob ? 'checked' : '' }}>
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
                            @foreach ($historiaUsuario as $hu)
                                <tr>
                                    <td>{{ $hu->titulo_hu }}</td>
                                    <td>{{ $hu->estimacion_hu}}</td>
                                    <td>
                                        <input type="hidden" name="historias[{{ $hu->id_hu }}][idHU]" value="{{ $hu->id_hu }}">
                                        <textarea id="textarea_hu_{{ $hu->id_hu }}" name="historias[{{ $hu->id_hu }}][descripcion]" class="stile-text" placeholder="Editar Descripción">{{ $hu->descripcion_eva_hu }}</textarea>
                                        <span id="error_hu_{{ $hu->id_hu }}" class="error"></span>
                                    </td>
                                    <td>
                                        <input type="checkbox" class="stile-text" name="historias[{{ $hu->id_hu }}][done]" value="1" {{ $hu->done ? 'checked' : '' }}>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button type="button" class="addHU" onclick="agregarFila(event)">Añadir +</button>
                </div>          
            </section>
            <!-- Campos ocultos para enviar las fechas de inicio y fin -->
            <input type="hidden" name="fechaInicio" value="{{ $enProgreso[0] ?? '' }}">
            <input type="hidden" name="fechaFin" value="{{ $enProgreso[1] ?? '' }}">
            @if ($mostrarMensaje)
                <h2 class="Mensaje-de-semana-registrada" style="color: red">La evaluación final de hito ya fue registrada</h2>
            @else
                <div class="submit-section">
                    <button type="submit" class="save">Guardar <i class="bi bi-rocket-takeoff-fill"></i></button>
                </div>
            @endif

        </form>

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

function agregarFila(event) {
    event.preventDefault();
    const tabla = document.getElementById("tabla-dinamica").getElementsByTagName("tbody")[0];
    const nuevaFila = tabla.insertRow();
    const rowIndex = tabla.rows.length - 1;

    nuevaFila.insertCell(0).innerHTML = `<input type="text" id="historia_${rowIndex}" name="nuevas_historias[${rowIndex}][titulo]" placeholder="Historia de usuario" class="stile-text">
                                            <td><span id="error_historia_${rowIndex}" class="error"></span></td>`;  // Asegura que el span tenga el ID correcto
    nuevaFila.insertCell(1).innerHTML = `<input type="text" id="estimacion_${rowIndex}" name="nuevas_historias[${rowIndex}][estimacion]" placeholder="Estimación" class="stile-text">
                                            <div id="error_estimacion_${rowIndex}" class="error"></div>`;
    nuevaFila.insertCell(2).innerHTML = `<input type="text" id="descripcion_${rowIndex}" name="nuevas_historias[${rowIndex}][descripcion]" placeholder="Observación" class="stile-text">
                                            <div id="error_descripcion_${rowIndex}" class="error"></div>`;
    nuevaFila.insertCell(3).innerHTML = `<input type="checkbox" class="stile-text" name="nuevas_historias[${rowIndex}][done]" value="1">`;
    nuevaFila.insertCell(4).innerHTML = `<button type="button" class="btn-eliminar" onclick="eliminarFila(this)">Eliminar</button>`;
    agregarValidaciones(rowIndex);
}

function eliminarFila(boton) {
    const fila = boton.parentNode.parentNode;
    fila.parentNode.removeChild(fila);
}

    function agregarValidaciones(index) {
        const historiaInput = document.getElementById(`historia_${index}`);
        const estimacionInput = document.getElementById(`estimacion_${index}`);
        const descripcionInput = document.getElementById(`descripcion_${index}`);

        historiaInput.addEventListener('input', function(e) {
        // validarHistoriaUsuario(index);
            if(!validarTituloHistoria(index)){
                e.preventDefault();
            }
        });

        estimacionInput.addEventListener('input', function(e) {
            //validarEstimacion(index);
            if(!validarEstimacionHistoria(index)){
                e.preventDefault();
            }
        });

        descripcionInput.addEventListener('input', function(e) {
            //validarDescripcion(index);
            if(!validarDescripcionHistoria(index)){
                e.preventDefault();
            }
        });
    }

    // Validar descripción_control_semanal
    function validarDescripcionControlSemanal() {
        const descripcion = document.getElementById('descripcion_control_semanal').value.trim();
        const errorElement = document.getElementById('descripcionError');
        const caracteresEspeciales = descripcion.match(/[!@#$%^&*(),.?":{}|<>]/g) || [];
        
        if (descripcion === "") {
            errorElement.textContent = "La descripción no puede estar vacía.";
            return false;
        } else if (descripcion.length > 500) {
            errorElement.textContent = "La descripción no puede exceder los 500 caracteres.";
            return false;
        } else if (/^\d+$/.test(descripcion)) {
            errorElement.textContent = "La descripción no puede contener solo caracteres numéricos.";
            return false;
        } else if (caracteresEspeciales.length > 20) {
            errorElement.textContent = "La descripción no puede tener más de 20 caracteres especiales.";
            return false;
        } else {
            errorElement.textContent = "";
            return true;
        }
    }

    // Validar títulos de nuevas historias
    function validarTituloHistoria(index) {
        const titulo = document.getElementById(`historia_${index}`).value.trim();
        const errorElement = document.getElementById(`error_historia_${index}`);
        const caracteresEspeciales = titulo.match(/[!@#$%^&*(),.?":{}|<>]/g) || [];

        if (titulo === "") {
            errorElement.textContent = "El título no puede estar vacío.";
            return false;
        } else if (titulo.length < 4 || titulo.length > 100) {
            errorElement.textContent = "El título debe tener entre 4 y 100 caracteres.";
            return false;
        } else if (/^\d+$/.test(titulo)) {
            errorElement.textContent = "El título no puede contener solo valores numéricos.";
            return false;
        } else if (caracteresEspeciales.length > 20) {
            errorElement.textContent = "El título no puede tener más de 20 caracteres especiales.";
            return false;
        } else {
            errorElement.textContent = "";
            return true;
        }
    }

    // Validar estimación de nuevas historias
    function validarEstimacionHistoria(index) {
        const estimacion = document.getElementById(`estimacion_${index}`).value.trim();
        const errorElement = document.getElementById(`error_estimacion_${index}`);

        if (!/^\d+$/.test(estimacion)) {
            errorElement.textContent = "La estimación debe contener solo valores numéricos.";
            return false;
        } else if (estimacion.length > 7) {
            errorElement.textContent = "La estimación no puede tener más de 7 dígitos.";
            return false;
        } else {
            errorElement.textContent = "";
            return true;
        }
    }

    // Validar descripción de nuevas historias
    function validarDescripcionHistoria(index) {
        const descripcion = document.getElementById(`descripcion_${index}`).value.trim();
        const errorElement = document.getElementById(`error_descripcion_${index}`);
        const caracteresEspeciales = descripcion.match(/[!@#$%^&*(),.?":{}|<>]/g) || [];

        if (descripcion.length > 500) {
            errorElement.textContent = "La descripción no puede exceder los 500 caracteres.";
            return false;
        } else if (/^\d+$/.test(descripcion)) {
            errorElement.textContent = "La descripción no puede contener solo caracteres numéricos.";
            return false;
        } else if (caracteresEspeciales.length > 20) {
            errorElement.textContent = "La descripción no puede tener más de 20 caracteres especiales.";
            return false;
        } else {
            errorElement.textContent = "";
            return true;
        }
    }


</script>


</body>
</html>