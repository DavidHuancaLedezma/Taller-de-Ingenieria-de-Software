<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <style>
        *{
            margin : 0px ; 
            padding : 0px ; 
            box-sizing : border-box ; /*+*/
        }


        body{
            margin: 0;
            height: 100vh;
            display: flex;
            flex-direction: column ; 
            justify-content: center;
            align-items: center;
            background-color: #D2D6DE ;
            gap : 20px ;  
        }
        .margen{
            border: 2px solid #ccc  ;
            border-radius: 10px ; /**/
            width: 70% ;/*70%*/
            background-color : white ;
            padding : 0px ; 
        }
        .margen .registro-semanal-GE{
            background-color: #367FA9 ;
            color : white ; 
            text-align : center ; 
            padding: 20px ; 
            border-radius: 10px 10px 0 0 ; 
        }

        .margen .registro-semanal-GE h1{
            font-size: 24px ;
        }

        .margen .registro-semanal-GE h2{
            font-size: 18px ;
            margin-top: 10px ;
        }

        .control-hoy{
            margin-left: 20px ; 
        }

        .contenedor-objetivos{
            margin : 10px 0px 10px 25px ; 
        }
        .control-de-asistencia{
            display: flex;
            justify-content: center;
        }
        .contenedor-descripcion{
            display: flex;
            flex-direction: column ; 
            justify-content: center;
            align-items: center ; 
        }

        .contenedor-descripcion textarea{
            width: 100%;
            height: 100px ; 
            padding: 10px ; 
            border: 1px solid #ccc ; 
            border-radius: 0 0 5px 5px ; 
            margin: 0px ; 
        }

        .contenedor-asistencia-check, .contenedor-descripcion{
            width: 48% ; 
            background-color: white ;
        }

        .contenedor-asistencia-check h3, .contenedor-descripcion h3{
            color : white ; 
            background-color: #40759e ;
            padding: 10px  ; 
            text-align: center ; 
            border-radius: 5px 5px 0 0 ;
            margin: 0px ; 
            width: 100% ; 

        }

        #descripcion{
            height: 120px ; 
        }

        .contenedor-asistencia{
            border: 1px solid #F5F5F5;
            border-radius: 20px;
            background-color: #F5F5F5;
            margin : 0px 20px ;
            padding: 20px ; 
            display : flex ; 
            flex-direction : row ; 
            justify-content: space-between ;
            align-items: center ;  
            gap : 10px ; 

        }

        .margen-footer{
            display: flex;
            justify-content: center;
            margin: 10px;
            position: relative; /**/ 
        }

        .control-de-asistencia td {
            padding: 0px 3px ; /* Añade espacio dentro de cada celda */
        }
        #boton-guardar-seguimiento-semanal{
            position: relative;
            overflow: hidden;
            background-color:#008CBA; /* Color del botón */
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        #boton-guardar-seguimiento-semanal .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 0;
            height: 100%;
            background-color: #1CB698; /* Color de la superposición */
            z-index: -1;
            transition: width 1s ease;
        }  
        #boton-guardar-seguimiento-semanal:hover .overlay {
            width: 100%;
        }      
        /*---Error---*/
        .error-message {
            color: red;
            font-size: 12px;
            display: none;
        }

        .texto-area.error {
            border: 2px solid red;
        }

        /*----grafica de semanas-----*/
        .progress-container{
            display: flex;
            width : 90% ;
            margin: 5px 35px;
            min-height : 20px ; 
            gap : 10px ;  
        }

        .progress-container .step{
            padding: 0px ;text-align: center;
            flex-grow: 1;
            border: 1px solid rgb(160, 225, 245) ; 
            border-radius: 5px ; 
            
        }

        .step p {
            font-size: 12px;  /* Tamaño del texto más pequeño */
            margin: 5px 0 ; 
        }

        .completed {
            background-color: lightblue;
            border-color: blue;
        }
        main .nroHito{
            margin : 3px 0px 0px 20px ;  
        }
        main .progreso{
            margin : 10px 0px 0px 20px ;  
        }
        /*---mensaje de semana ya registrada----*/
        .Mensaje-de-semana-registrada{
            position: absolute; 
            z-index: 100;
            margin-left: 500px ; 
        }
        /*fin mensaje de registro*/

        /*estilos del combobox*/
        .combo_GEs {
            width: 500px;
            background-color: #fff;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(255, 255, 255, 0.1);
            display: flex ;
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
            background-color: #367FA9;    
        }

        @media (max-width: 380px) {
           
            body {
                all: unset;
                margin: 5px ; 
                height: 100vh ; 
                display: flex;
                flex-direction: column ; 
                
                align-items: center;
                background-color: #D2D6DE ;
                gap : 10px; 
            }
            .back-button{
                all: unset;
                border-radius: 25px;
                border: none;
                padding: 10px 20px;
                width: 150px;
                cursor: pointer;
                color: white ; 
                background-color: #367FA9; 
            }

            
            .margen{
                width: 370px ;
                margin-left: 10px; 

            }
            
            .combo_GEs{
                width: 360px ;
            }

            .Mensaje-de-semana-registrada{
            position: absolute; 
            z-index: 100;
            margin-left: 144px ; 
            }
        }
    </style>
</head>
<body>
    <input id="id-hito" type="hidden" value="{{$idHito}}">
    <input id="id-color" type="hidden" value="{{$numeroColor}}">
    <input id="id-semana-registro" type="hidden" value="{{ json_encode($enProgreso) }}">
    <input id="ocultar-componente-semana" type="hidden" value="{{$mostrarMensaje}}">
    <input id="id-docente" type="hidden" value="{{$idDocente}}">

    <button class="back-button" id="boton-home">Regreso al home <i class="fas fa-home"></i></button>
    
        <div class="combo_GEs">
            <label for="opciones">Elige una Grupo Empresa:</label>
            <select id="opciones" name="opciones">
                <option value="">Seleccionar</option>
            @foreach ($grupoEmpresas as $empresa)
                <option value="{{$empresa->id_grupo_empresa}}">{{$empresa->nombre_corto}}</option>
            @endforeach
            </select>
        </div>
        <div class="margen">
            <header class="registro-semanal-GE">
                <h1>Registro Semanal {{$nombreCorto}}</h1>
                <h2 class="nroHito">Hito {{$numeroDeHito}}</h2>
            </header>
            <main>
                <p class="progreso">Progreso de las semanas del hito</p>
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
                <div class="contenedor-objetivos">
                    <h4>Entregables del hito:</h4>
                    @foreach ($objetivos as $objetivo)
                        <p>-{{$objetivo->descrip_objetivo}}</p>
                    @endforeach
                </div>
                <div class="contenedor-asistencia">
                    <div class="contenedor-asistencia-check">
                        <h3>Asistencia</h3>
                        <table class="control-de-asistencia">
                            <tbody>
                                @foreach ($estudianteEnAlerta as $estudiante)
                                    <tr> 
                                        @if ($estudiante[1] >= 3)
                                            <td style="color:red">{{$estudiante[0]}}</td>
                                        @else
                                            <td>{{$estudiante[0]}}</td>
                                        @endif
                                        <td><input name="asistencia[]" value="{{$estudiante[2]}}" type="checkbox" class="asistencia" checked></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if ($mostrarMensaje)
                        <h2 class="Mensaje-de-semana-registrada" style="color: red">Esta semana ya fue registrada</h2>
                    @endif 
                    <div class="contenedor-descripcion">
                        <h3 id="tituloDescripcion">Descripción</h3>
                        <textarea name="descripcion" id="descripcion" cols="51" rows="5" class="texto-area" placeholder="Descripción"></textarea>
                        <span id="descripcionError" class="error-message"></span>
                    </div>
                </div>
            </main>
            <footer class="margen-footer">
                <button id="boton-guardar-seguimiento-semanal">Guardar
                    <span class="overlay"></span>
                </button>
            </footer>
        </div>
      
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    const guardarBtn = document.getElementById('boton-guardar-seguimiento-semanal');
    const areaTextoDescripcion = document.getElementById('descripcion');
    const tituloDescripcion = document.getElementById('tituloDescripcion')
    guardarBtn.addEventListener('click', () => {
        const descripcionError = document.getElementById('descripcionError');
        const descripcion = areaTextoDescripcion.value.trim();
        // Verificar si el campo de descripción está vacío
        const regexEspeciales = /[a-zA-Z0-9]/;

        // Expresión regular para verificar si son solo números
        const regexSoloNumeros = /^[0-9]+$/;
        const regexSoloNumerosYEspeciales = /^[0-9\W]+$/;

        // maximo 20 caracteres especiales
        const regexCaracteresEspeciales =/[^\w\s]/g;  // Coincide con cualquier carácter que no sea letra ni número (caracteres especiales)

        // Contar caracteres especiales en la descripción
        const caracteresEspeciales = descripcion.match(regexCaracteresEspeciales) || []; // Si no hay coincidencias, devolver array vacío
        const cantidadCaracteresEspeciales = caracteresEspeciales.length;

        if (descripcion === '') {
            // Mostrar el mensaje de error y resaltar el campo de texto
            descripcionError.textContent = 'Por favor, completa la descripción.';
            descripcionError.style.display = 'block';
            areaTextoDescripcion.classList.add('error');
        }else if (descripcion.length < 5) {
                // Mostrar el mensaje de error si es menor a 30 caracteres
            descripcionError.textContent = 'La descripción debe tener al menos 5 caracteres.';
            descripcionError.style.display = 'block';
            areaTextoDescripcion.classList.add('error');  // Añadir clase para el borde rojo
        } else if (regexSoloNumeros.test(descripcion)) {
            // Mostrar error si la descripción contiene solo números
            descripcionError.textContent = 'La descripción no debe ser solo números.';
            descripcionError.style.display = 'block';
            areaTextoDescripcion.classList.add('error');
        } else if (!regexEspeciales.test(descripcion)) {
            // Mostrar error si la descripción contiene solo caracteres especiales
            descripcionError.textContent = 'La descripción no debe contener solo caracteres especiales.';
            descripcionError.style.display = 'block';
            areaTextoDescripcion.classList.add('error');
            
        } else if (regexSoloNumerosYEspeciales.test(descripcion)) {
            // Mostrar error si la descripción contiene solo números y caracteres especiales
            descripcionError.textContent = 'La descripción no debe contener solo números y caracteres especiales.';
            descripcionError.style.display = 'block';
            areaTextoDescripcion.classList.add('error');
        } else if (cantidadCaracteresEspeciales > 20) {
            // Mostrar error si hay más de 20 caracteres especiales
            descripcionError.textContent = 'Los caracteres especiales no deben exceder los 20.';
            descripcionError.style.display = 'block';
            areaTextoDescripcion.classList.add('error');
        } else {
            // Si no está vacío, ocultar el mensaje de error, quitar la clase 'error' y cerrar el formulario
            descripcionError.style.display = 'none';
            areaTextoDescripcion.classList.remove('error');
        }
    });

    /*---grafica de semanas-----*/
    function setProgress(stepCount) {
    // Obtener todos los elementos con la clase "step"
    const steps = document.querySelectorAll('.step');
        // Recorrer todos los pasos y aplicar la clase "completed" según el valor del contador
        steps.forEach((step, index) => {
            if (index < stepCount) {
                step.classList.add('completed'); // Añadir clase "completed"
            } else {
                step.classList.remove('completed'); // Quitar clase "completed" si no corresponde
            }
        });
    }
    const numero = document.getElementById("id-color").value.trim();
    setProgress(numero);

    //Esconder botones cuando esta semana ya fue registrada
    document.addEventListener("DOMContentLoaded", function() {
    const guardarBtn = document.getElementById('boton-guardar-seguimiento-semanal');
    const ocultarComponenteSemana = document.getElementById('ocultar-componente-semana').value;
    
    // Convertir el valor en un booleano si es necesario
    const mostrarMensaje = ocultarComponenteSemana ; // Ajustar según cómo pase PHP el valor

    // Mostrar u ocultar el botón según el valor de mostrarMensaje
    if (mostrarMensaje) {
        guardarBtn.style.display = 'none';
        areaTextoDescripcion.style.display = 'none';
        tituloDescripcion.style.display = 'none' ; 
        
    } else {
        guardarBtn.style.display = 'block';
        areaTextoDescripcion.style.display = 'block';
        tituloDescripcion.style.display = 'block' ;

        let arrayDeSemanas = JSON.parse(document.getElementById('id-semana-registro').value);
        console.log(arrayDeSemanas);
        if(arrayDeSemanas[0] === "Hito finalizado" || arrayDeSemanas[0] === "Hito no iniciado"){
            guardarBtn.style.display = 'none';
            areaTextoDescripcion.style.display = 'none';
            tituloDescripcion.style.display = 'none' ; 
        }else{
            guardarBtn.style.display = 'block';
            areaTextoDescripcion.style.display = 'block';
            tituloDescripcion.style.display = 'block' ;
        }
    }
});
</script>

<script>
    //AJAX
    $(document).ready(function(){
        // Configurar el token CSRF para todas las solicitudes AJAX
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });



        $('#boton-guardar-seguimiento-semanal').on('click', function() {
            // Verificar si el campo de descripción está vacío
            const regexSoloNumerosYEspeciales = /^[0-9\W]+$/;
            let descripcion = $('#descripcion').val();

            
            const regexCaracteresEspeciales =/[^\w\s]/g; 
            const caracteresEspeciales = descripcion.match(regexCaracteresEspeciales) || []; // Si no hay coincidencias, devolver array vacío
            const cantidadCaracteresEspeciales = caracteresEspeciales.length;
            console.log(cantidadCaracteresEspeciales + " <----- son estos");
            

            console.log("numero y caracter .-" + !regexSoloNumerosYEspeciales.test(descripcion))
            
            
            if($('#descripcion').val() != '' && $('#descripcion').val().length > 4 && $('#descripcion').val().length < 500 && !regexSoloNumerosYEspeciales.test(descripcion) && cantidadCaracteresEspeciales<=20){
                
                
                let estudiantesConAsistencia = [];
                let estudiantesSinAsistencia = [];

                // Recorrer los checkboxes y recoger los seleccionados y no seleccionados
                $('.asistencia').each(function() {
                    if ($(this).is(':checked')) {
                        estudiantesConAsistencia.push($(this).val()); // Añadir ID de los estudiantes con asistencia
                    } else {
                        estudiantesSinAsistencia.push($(this).val()); // Añadir ID de los estudiantes sin asistencia
                    }
                });

                let arrayDeSemanas = JSON.parse($('#id-semana-registro').val());
                
                $.ajax({
                url: 'registrar_seguimiento',
                method: 'POST',
                data: {
                    descripcion: $('#descripcion').val(),
                    asistencias: estudiantesConAsistencia,
                    faltas: estudiantesSinAsistencia,
                    idHito: $('#id-hito').val(),
                    verificarSemana: arrayDeSemanas
                }
                }).done(function(res){
                    
                    let mensaje = JSON.parse(res);
                    let tipoMensaje = mensaje[mensaje.length - 1];
                    mensaje = mensaje.substring(0, mensaje.length - 1);

                    if(tipoMensaje === "2"){
                        //Mensaje de error
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: mensaje
                        });
                    }else{
                        //Mensaje de exito
                        Swal.fire({
                            title: "Exito",
                            text: mensaje,
                            icon: "success",
                            confirmButtonText: 'Aceptar',
                            allowOutsideClick: false
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Recarga la página después de presionar "OK"
                                location.reload();
                            }
                        });

                       let template = `
                        Semana: ${arrayDeSemanas[0]} al ${arrayDeSemanas[1]} / Esta semana ya fue registrada
                       `;
                       $('.control-hoy').html(template);

                       
                    }
                    


                }).fail(function(jqXHR, textStatus, errorThrown) {
                    console.error('Error en la solicitud:', textStatus, errorThrown);
                    console.error('Detalles del error:', jqXHR.responseText);
                });
                $('#descripcion').val('');
                
            }
            });
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

        $("#boton-home").on("click", function () {
                //Regresa al home del docente
                let idDocente = $('#id-docente').val();
                
                window.location.href = `{{ url('/docente_home/${idDocente}') }}`;
            });
        
    });

</script>
</body>
</html>