<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Semanal</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  
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
            .combo_GEs {
        width: 80%;  /* Asegura que el div ocupe todo el ancho disponible */
        max-width: 250px;  /* Limita el ancho máximo para hacerlo más pequeño */
        flex-direction: column;
        
    }

.combo_GEs label,
.combo_GEs select {
    width: 100%;  /* Asegura que el label y el select ocupen el ancho completo dentro del div */
    box-sizing: border-box; /* Asegura que el padding no afecte el tamaño total */
}

.combo_GEs select {
    margin-top: 10px; /* Añade espacio entre el label y el select */
    padding: 8px;  /* Espacio dentro del select para que no esté tan pegado a los bordes */
}
.botonHome {
    margin-bottom: 50px;  /* Espacio debajo del botón */
    margin-top: 20px;
}
            .seccion_dos {
                flex-direction: column; /* Cambia la disposición de los elementos a columna */
            }

            .sprint, .main-content {
                padding: 10px;
                width: 100%; /* Ambos bloques ocupan el 100% del ancho */
            }
            .bloque_uno{
                width: 100%;
            }
            .bloque_dos {
            overflow-x: auto; /* Permitir desplazamiento horizontal en pantallas pequeñas */
        }
        @media screen and (max-width: 576px){
            .main-content {
                flex-direction: column; /* Los elementos se apilan en una columna en pantallas pequeñas */
                gap: 10px; /* Menor espacio entre elementos cuando estén en columna */
            }

            .attendance,
            .description {
                width: 100%; /* Asegura que cada bloque ocupe el 100% de ancho */
            }
            button.save {
            width: 40%;       
            }
        }
           
        }
       /*estilos del combobox*/
       .combo_GEs {
            width: 500px; 
            background-color: #fff;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            /*flex-direction: column;
            align-items: center;*/
            margin: 0 auto; 
            position: relative; 
            top: 20px; 
        }

        .combo_GEs label {
            font-size: 16px;
            color: #333; 
            
        }
        .combo_GEs label {
            font-size: 16px;
            color: #333; 
            white-space: nowrap; /* Evita que el texto se rompa en varias líneas */
            display: block; /* Asegura que el label esté alineado correctamente */
            margin-top: 5px;  
        }
        .combo_GEs select {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: white;
            color: #333;
            cursor: pointer;
            appearance: none; /* Quita el estilo predeterminado del navegador */
            -webkit-appearance: none;
            -moz-appearance: none;
        }

        .combo_GEs select:hover {
            border-color: #222D32;
            background-color: #ffffff;
        }

        .combo_GEs select:focus {
            outline: none;
            border-color: #222D32;
            box-shadow: 0 0 5px #ffffff;
        }

        .combo_GEs option {
            padding: 10px;
        }

        .combo_GEs option:hover {
            background-color: #222D32;
            color: white;
        } 
        .back-button {
            border-radius: 25px;
            border: none;
            position: absolute;
            left: 20px; /* Fijar el botón al lado izquierdo */
            top: 20px; /* Posición fija desde el top */
            padding: 10px 20px;
            cursor: pointer;
            color: white ; 
            background-color: #367FA9    
        }
        
    </style>
</head>
<body>
    <input id="id-docente" type="hidden" value="{{$idDocente}}">
    <div class="botonHome">
    <button class="back-button" id="boton-home">Regreso al home <i class="fas fa-home"></i></button>
    </div>
    <div class="combo_GEs">
            <label for="opciones">Elige una Grupo Empresa:</label>
            <select id="opciones" name="opciones">
                <option value="">Seleccionar</option>
            @foreach ($grupoEmpresas as $empresa)
                <option value="{{$empresa->id_grupo_empresa}}">{{$empresa->nombre_corto}}</option>
            @endforeach
            </select>
        </div>

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
                confirmButtonText: "Aceptar"
            });
        </script>
        @endif
        @if(session('error'))
        <script>
            Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "{{ session('error') }}",
            confirmButtonText: "Aceptar"
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
                            <h3>Observación Semanal</h3>
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
                                <th>Observación <i class="bi bi-pen-fill"></i></th>
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
                    <button type="submit" class="save">Guardar </button>
                </div>
            @endif

        </form>

    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Evaluación Final de Hito',
                text: 'Esta grupo Empresa se encuentra en una semana de finalización de hito. A continuación se le mostrará la planilla de evaluación de final de hito.',
                icon: 'info',
                timer: 8000, // Tiempo en milisegundos
                showConfirmButton: false
            });
        });
    </script>
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
let filasIniciales = document.querySelectorAll('#tabla-dinamica tbody tr').length;
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
        const tituloElement = document.getElementById(`historia_${index}`);
        const errorElement = document.getElementById(`error_historia_${index}`);

        // Verificar si el elemento existe
        if (!tituloElement) {
            console.error(`El elemento con ID historia_${index} no existe.`);
            if (errorElement) {
                errorElement.textContent = "Error: No se encontró el campo de título.";
            }
            return false;
        }
        const titulo = document.getElementById(`historia_${index}`).value.trim();
       
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
        const estimacionElemento = document.getElementById(`estimacion_${index}`);
        const errorElement = document.getElementById(`error_estimacion_${index}`);
        if (!estimacionElemento) {
            console.error(`El elemento con ID historia_${index} no existe.`);
            if (errorElement) {
                errorElement.textContent = "Error: No se encontró el campo de título.";
            }
            return false;
        }
        const estimacion = document.getElementById(`estimacion_${index}`).value.trim();
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
        const descripcionElemento = document.getElementById(`descripcion_${index}`);
        const errorElement = document.getElementById(`error_descripcion_${index}`);
        if (!descripcionElemento) {
            console.error(`El elemento con ID historia_${index} no existe.`);
            if (errorElement) {
                errorElement.textContent = "Error: No se encontró el campo de título.";
            }
            return false;
        }
        const descripcion = document.getElementById(`descripcion_${index}`).value.trim();
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
<script>
    // Validar formulario completo antes del envío
    document.getElementById('evaluacionForm').addEventListener('submit', function (e) {
        e.preventDefault(); // Evita el envío inicial

        // Validar descripción semanal
        if (!validarDescripcionControlSemanal()) {
            Swal.fire({
                icon: 'error',
                title: 'Error en la descripción semanal',
                text: 'Por favor, completa la observación semanal antes de continuar.',
                confirmButtonText: 'Aceptar'
            });
            return;
        }

        // Validar todas las nuevas historias de usuario
        const filasActuales = document.querySelectorAll('#tabla-dinamica tbody tr').length;

        if (filasActuales > filasIniciales) {
            for (let i = 0; i < filas.length; i++) {
                if (!validarTituloHistoria(i)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error en las historias de usuario',
                        text: 'Por favor, corrige los errores de titulo en las historias de usuario antes de continuar.',
                        confirmButtonText: 'Aceptar'
                    });
                    return;
                }
                if (!validarEstimacionHistoria(i)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error en las historias de usuario',
                        text: 'Por favor, corrige los errores estimación en las historias de usuario antes de continuar.',
                        confirmButtonText: 'Aceptar'
                    });
                    return;
                }
                if (!validarDescripcionHistoria(i)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error en las historias de usuario',
                        text: 'Por favor, corrige los errores de observación en las historias de usuario antes de continuar.',
                        confirmButtonText: 'Aceptar'
                    });
                    return;
                }
            }
        }

        // Si todas las validaciones pasan, enviar el formulario
        this.submit();
    });
</script>

<script>
    // Configurar el token CSRF para todas las solicitudes AJAX
    $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
    $(document).ready(function(){
        //Modificar texto de hito finalizado
        let texto = $('.control-hoy').text();
        if(texto === "Hito finalizado"){
            $('.control-hoy').text("Todos los hitos de la grupo empresa terminaron");
        }


        $('#opciones').on('change', function() {
            // Obtener el valor de la opción seleccionada
            let valorSeleccionado = $(this).val();
            let idDocente = $('#id-docente').val();
            // Obtener el texto de la opción seleccionada
            let textoSeleccionado = $("#opciones option:selected").text();

            // Mostrar el valor y el texto en la consola si no es "Seleccionar"
            if(textoSeleccionado !== "Seleccionar"){

                $.ajax({
                url: '{{ url('/obtener_id_hito_grupo_empresa_combo_box') }}',
                method: 'POST',
                data: {
                    idGrupoEmpresa: valorSeleccionado
                }
                }).done(function(res){
                    let id_hito = JSON.parse(res);
                    window.location.href = `{{ url('/cargar_registro_semanal${id_hito}_${idDocente}') }}`;
                    console.log("id obtenido de ajax GE: " + id_hito);
                    
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    console.error('Error en la solicitud:', textStatus, errorThrown);
                    console.error('Detalles del error:', jqXHR.responseText);
                });
                console.log("-----------------------------------------");
                console.log("Valor seleccionado: " + valorSeleccionado);
                console.log("Texto seleccionado: " + textoSeleccionado);
            }
        });
    });

</script>
<script>
    $("#boton-home").on("click", function (event) {
    event.preventDefault(); // Prevenir la redirección automática
    
    // Obtener los datos de los campos
    //let observacionSemanal = $("#observacion_semanal").val().trim(); // Campo de observación semanal
    const observacionSemanal = document.getElementById('descripcion_control_semanal').value.trim();
    let historias = $("[id^='historia_']").map(function () {
        return $(this).val().trim();
    }).get(); // Recopilar valores de todas las historias

    // Verificar si hay datos en los campos
    let hayCambios = observacionSemanal !== "" || historias.some(h => h !== "");

    if (hayCambios && !@json($mostrarMensaje)) {
        // Mostrar alerta si hay cambios
        Swal.fire({
            title: "Hay cambios sin guardar",
            text: "¿Deseas guardar los cambios antes de salir?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Si",
            cancelButtonText: "Salir sin guardar"
        }).then((result) => {
            if (result.isConfirmed) {
                // Acción para guardar los datos (sin salir de la página)
                Swal.fire({
                    title: "Continuar ...",
                    text: "Presione botón guardar del registro semanal",
                    icon: "info",
                    confirmButtonText: "Continuar"
                });
                // Aquí puedes invocar la función de guardar o enviar los datos al servidor
            } else {
                // Redirigir al home sin guardar
                let idDocente = $('#id-docente').val();
                window.location.href = `{{ url('/docente_home/${idDocente}') }}`;
            }
        });
    } else {
        // Redirigir directamente si no hay cambios
        let idDocente = $('#id-docente').val();
        window.location.href = `{{ url('/docente_home/${idDocente}') }}`;
    }
});

</script>

</body>
</html>