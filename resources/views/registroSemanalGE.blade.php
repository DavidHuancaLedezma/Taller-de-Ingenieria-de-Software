<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <style>
        *{
            margin : 0px ; 
            padding : 0px ; 
        }
        body{
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #D2D6DE ; /**/ 

        }
        .margen{
            border: 2px solid black;
            width: 700px;
            background-color : white;/**/
            padding : 0px ; 
        }
        .margen .registro-semanal-GE{
            min-height:60px ;
            background-color: #367FA9 ;
            display: flex ; 
            justify-content : center ; 
            align-items: center ; 
            color : white ; 
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
            gap: 10px ; 
        }
        .contenedor-asistencia{
            border: 1px solid #F5F5F5;
            border-radius: 20px;
            background-color: #F5F5F5;
            margin : 0px 20px ;
            padding: 20px ; 
            display : flex ; 
            flex-direction : column ; 
            justify-content: center ;
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
            border: 2px solid rgb(0, 68, 255) ;
            display: flex;
            width : 90% ;
            margin: 5px 35px;
            min-height : 20px ;  
        }

        .progress-container .step{
            border: 2px solid rgb(0, 0, 0) ;
            padding: 0px ;text-align: center;
            flex-grow: 1;
        }

        .step p {
            font-size: 12px;  /* Tamaño del texto más pequeño */
            margin: 5px 0;
        }

        .completed {
            background-color: lightblue;
            border-color: blue;
        }
        main .nroHito{
            margin : 3px 0px 0px 20px ;  
        }
        main .progreso{
            margin : 0px 0px 0px 20px ;  
        }
    </style>
</head>
<body>
    <input id="id-hito" type="hidden" value="{{$idHito}}">
    <input id="id-color" type="hidden" value="{{$numeroColor}}">
    <input id="id-semana-registro" type="hidden" value="{{ json_encode($enProgreso) }}">


    <div class="margen">

        <header class="registro-semanal-GE"><h2>Registro Semanal {{$nombreCorto}}</h2></header>

        <main>
            <!--<div class="espacio-para-barra-de-progreso"></div>-->
            <h4 class="nroHito">Hito {{$numeroDeHito}}</h4>
            <p class="progreso">Progreso de las semanas del hito</p>
            <div class="progress-container">
                
                @foreach ($semanas as $item)
                    <div class="step active">
                        <p>{{$item['inicio']}}</p>
                        <p>{{$item['fin']}}</p>
                    </div>
                @endforeach


            </div>
            @if (count($enProgreso) == 2)
                <h3 class="control-hoy">Semana: {{$enProgreso[0]}} al {{$enProgreso[1]}}</h3>
            @else
                <h3 class="control-hoy">{{$enProgreso[0]}}</h3>
            @endif
           
            <div class="contenedor-objetivos">
                <h4>Objetivos:</h4>
                @foreach ($objetivos as $objetivo)
                    <p>-{{$objetivo->descrip_objetivo}}</p>
                @endforeach
            </div>
            <div class="contenedor-asistencia">
                <h4>Asistencia</h4>
                <table class="control-de-asistencia">
                    <tbody>

                        @foreach ($nombreEstudiante as $estudiante)
                            <tr>
                                <td>{{$estudiante->nombre_completo}}</td>
                                <td><input name="asistencia[]" value="{{$estudiante->id_usuario}}" type="checkbox" class="asistencia" checked></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="contenedor-descripcion">
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
<script>
    const guardarBtn = document.getElementById('boton-guardar-seguimiento-semanal');
    const areaTextoDescripcion = document.getElementById('descripcion');
    guardarBtn.addEventListener('click', () => {
        const descripcionError = document.getElementById('descripcionError');
        const descripcion = areaTextoDescripcion.value.trim();
        // Verificar si el campo de descripción está vacío
        if (descripcion === '') {
                // Mostrar el mensaje de error y resaltar el campo de texto
            descripcionError.textContent = 'Por favor, completa la descripción.';
            descripcionError.style.display = 'block';
            areaTextoDescripcion.classList.add('error');
        }else if (descripcion.length < 30) {
                // Mostrar el mensaje de error si es menor a 30 caracteres
            descripcionError.textContent = 'La descripción debe tener al menos 30 caracteres.';
            descripcionError.style.display = 'block';
            areaTextoDescripcion.classList.add('error');  // Añadir clase para el borde rojo
        } else if (descripcion.length > 500) {
            // Mostrar el mensaje de error si supera los 500 caracteres
            descripcionError.textContent = 'La descripción no debe exceder los 500 caracteres.';
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

            if($('#descripcion').val() != '' && $('#descripcion').val().length > 30 && $('#descripcion').val().length < 500){
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
                    alert(res); // mensaje sobre el registro
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    console.error('Error en la solicitud:', textStatus, errorThrown);
                    console.error('Detalles del error:', jqXHR.responseText);
                    alert('Error: ' + jqXHR.responseText); // muestra el mensaje de error del servidor
                });
                $('#descripcion').val('');
                
            }
            });
    });
</script>
</body>
</html>