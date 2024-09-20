<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/css/bootstrap.min.css" rel="stylesheet">

    <title>Document</title>
    <style>
        h1{
            text-align: center;
        }
        .contenedor{
            width: 1000px;
        }
        main{
            display: flex;
            justify-content: center;
            
        }
        #openFormBtn{
            margin: 20px;
        }
        #icono-mas{
            font-size: 30px;
        }


        /*inicio mini formulario*/

        /* Estilos del formulario emergente */
        #popupForm, #popupForm-edit {
        display: none; /* Oculto inicialmente */
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

        /* Estilos del fondo oscuro */
        #overlay {
        display: none; /* Oculto inicialmente */
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 500;
        }



        .h1-mini-formulario{
            text-align: center;
        }
        .contenedor-mini-formulario{
            
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .integrantes{
            margin-left: 50px;
            display: flex;
            gap: 45px;
        }

        .sub-integrante{
            display: flex;
            flex-direction: column;
        }
        .marcar-asistencia{
            display: flex;
            flex-direction: column;
            gap: 10px;
            justify-content: space-around;
        }

        .main-mini-formulario{
            border: 2px solid #ccc;
            border-radius: 10px;
            width: 400px;
            display: flex;
            flex-direction: column;
            
        }
        .footer-mini-formulario{
            display: flex;
            justify-content: center;
            width: 400px;
            gap: 40px;
        }
        .error-message {
            color: red;
            font-size: 12px;
            display: none; /* Oculto por defecto */
        }

        .texto-area.error {
            border: 2px solid red;
        }
        /*fin mini formulario*/
    </style>


</head>
<body>

    <header>
        <h1>Seguimiento semanal</h1>
    </header>
    <main>

        <div class="contenedor">
            <h2>Objetivos:</h2>
            <div>
                @foreach ($objetivos as $item)
                    <p>- {{$item->descrip_objetivo}}</p>
                @endforeach
            </div>
    
            <button id="openFormBtn" class="btn btn-info">
                <i id="icono-mas" class="fa fa-plus-square"></i>
            </button>
    
            <table class="table table-striped table-bordered table-hover">
                <thead class="table-info">
                    <tr>
                        <th>Semana</th>
                        <th>Fecha registro</th>
                        <th>Ver y editar</th>
                    </tr>
                </thead>
                <tbody id="filas-semanas">
                    
                    @foreach ($semanas_registradas as $item)

                    <tr>
                        <td>Semana {{$item->numero_semana}}</td>
                        <td>{{$item->fecha_registro_semanal}}</td>
                        <td>
                            <button class="btn btn-info openEdit" data-id="{{$item->id_control_semanal}}">
                                <i class="fa fa-edit"></i>
                            </button>
                        </td>
                    </tr>
                        
                    @endforeach
    
                </tbody>
            </table>
        </div>
    </main>

    <!-- Fondo oscuro -->
    <div id="overlay"></div> 
    <!-- Formulario emergente -->
    <div id="popupForm">
            <div class="contenedor-mini-formulario">
                <header class="header-mini-formulario">
                    <h1 class="h1-mini-formulario">Semana</h1>
                </header>
                <main class="main-mini-formulario">
                    <h3>Asistencia</h3>
                    <div class="integrantes">
                        <div class="sub-integrante">

                            @foreach ($integrantes as $item)
                                <p class="estudiante">{{$item->nombre_estudiante}} {{$item->apellido_estudiante}}</p>
                            @endforeach

                        </div>
                        <div class="marcar-asistencia">

                            @foreach ($integrantes as $item)
                                <input name="asistencia[]" value="{{$item->id_estudiante}}" type="checkbox" class="asistencia" checked>
                            @endforeach

                        </div>
                    </div>
            
                </main>
            
                <div id="descripcion-semana" class="contenedor-descripcion">
                    <input type="hidden" id="id_hito" name="id_hito" value="{{$id_hito}}">
                    <textarea name="descripcion" id="descripcion" cols="51" rows="5" class="texto-area" placeholder="Descripción"></textarea>
                    <span id="descripcionError" class="error-message"></span>
                </div>
            
                <footer class="footer-mini-formulario">
                    <button id="boton-guardar-seguimiento-semanal" class="btn btn-info">Guardar</button>
                    <button class="btn btn-danger" id="cancelBtn">Cancelar</button>
                        
                </footer>
            </div>
    </div>
    
    <!--INICIO FORMULARIO EDITAR-->
    <div id="popupForm-edit">
        <div class="contenedor-mini-formulario">
            <header class="header-mini-formulario">
                <h1 class="h1-mini-formulario">Semana</h1>
            </header>
            <main class="main-mini-formulario">
                <h3>Asistencia</h3>
                <div class="integrantes">
                    <div id="estudiantes-edit" class="sub-integrante">
                    

                    </div>
                    <div id="marcar-asistencia-edit" class="marcar-asistencia">

                        

                    </div>
                </div>
        
            </main>
        
            <div id="descripcion-semana-edit" class="contenedor-descripcion">
                <input type="hidden" id="id_control_semanal-edit" name="id_control_semanal" value="">
                <textarea name="descripcion" id="descripcion-edit" cols="51" rows="5" class="texto-area" placeholder="Descripción"></textarea>
                <span id="descripcionError-edit" class="error-message"></span>
            </div>
        
            <footer class="footer-mini-formulario">
                <button id="boton-guardar-seguimiento-semanal-edit" class="btn btn-info">Editar</button>
                <button class="btn btn-danger" id="cancelBtn-edit">Cancelar</button>
                    
            </footer>
        </div>
    </div>
    <!--FIN FORMULARIO EDITAR-->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        //Script para la ventana emergente
        // Obtener elementos
        const openFormBtn = document.getElementById('openFormBtn');
        const popupForm = document.getElementById('popupForm');
        const overlay = document.getElementById('overlay');
        const cancelBtn = document.getElementById('cancelBtn');
        const guardarBtn = document.getElementById('boton-guardar-seguimiento-semanal');
        const areaTextoDescripcion = document.getElementById('descripcion');


        /*const openEdit = document.querySelectorAll('.openEdit');*/

        guardarBtn.addEventListener('click', () => {
            const descripcionError = document.getElementById('descripcionError');
            const descripcion = areaTextoDescripcion.value.trim();

            // Verificar si el campo de descripción está vacío
            if (descripcion === '') {
                // Mostrar el mensaje de error y resaltar el campo de texto
                descripcionError.textContent = 'Por favor, completa la descripción.';
                descripcionError.style.display = 'block';
                areaTextoDescripcion.classList.add('error');
            } else {
                // Si no está vacío, ocultar el mensaje de error, quitar la clase 'error' y cerrar el formulario
                descripcionError.style.display = 'none';
                areaTextoDescripcion.classList.remove('error');
                popupForm.style.display = 'none';
                overlay.style.display = 'none';
            }
        });

        // Ocultar el formulario y el fondo oscuro al presionar cancelar
        cancelBtn.addEventListener('click', () => {
            popupForm.style.display = 'none';
            overlay.style.display = 'none';
            areaTextoDescripcion.value = '';
        });

        // También cerrar el formulario al hacer clic fuera de él
        overlay.addEventListener('click', () => {
            popupForm.style.display = 'none';
            overlay.style.display = 'none';
            areaTextoDescripcion.value = '';
        });


        // Evento cuando se toca el botón de "Añadir" (openFormBtn)
        openFormBtn.addEventListener('click', () => {
            // Restablecer el formulario al abrirlo de nuevo
            const checkboxes = document.querySelectorAll('.asistencia');
            checkboxes.forEach(checkbox => {
                checkbox.checked = true; // Marcar cada checkbox
            });
            const descripcionError = document.getElementById('descripcionError');
            descripcionError.style.display = 'none';  // Ocultar mensaje de error
            areaTextoDescripcion.classList.remove('error');  // Quitar borde rojo
            areaTextoDescripcion.value = '';  // Opcional: Limpiar el contenido del textarea
            // Mostrar el formulario y el overlay
            popupForm.style.display = 'flex';
            overlay.style.display = 'flex';
        });
                
    </script>

    <script>
        $(document).ready(function(){

            // Configurar el token CSRF para todas las solicitudes AJAX
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#boton-guardar-seguimiento-semanal').on('click', function() {

                if($('#descripcion').val() != ''){
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
                    
                    $.ajax({
                    url: 'registro_seguimiento_semanal',
                    method: 'POST',
                    data: {
                        id_hito: $('#id_hito').val(),
                        descripcion: $('#descripcion').val(),
                        asistencias: estudiantesConAsistencia,
                        faltas: estudiantesSinAsistencia
                    }
                    }).done(function(res){
                        let mensaje;

                        if(res != false){
                            mensaje = "Semana registrada con exito presione ACEPTAR";
                            let arreglo_semanas = JSON.parse(res);

                            //el template modificar con las nuevas funcionalidades que tendra
                            let template = "";
                            for(let i=0; i<arreglo_semanas.length; i++){
                                template += `
                                    <tr>
                                        <td> Semana ${arreglo_semanas[i].numero_semana}</td>
                                        <td>${arreglo_semanas[i].fecha_registro_semanal}</td>
                                        <td>
                                            <button class="btn btn-info openEdit" data-id="${arreglo_semanas[i].id_control_semanal}">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                        </td>
                                    
                                    </tr>
                                `;
                            }
                            $("#filas-semanas").html(template);
                        }else{
                            mensaje = "Error al registrar semana";
                        }
                        alert(mensaje);
                        $('#descripcion').val('');
                    });
                }
            });

            //Modificar el seguimiento semanal de la semana seleccionda
            $('#boton-guardar-seguimiento-semanal-edit').on('click', function() {
                if($('#descripcion-edit').val() != ''){
                    let estudiantesConAsistencia = [];
                    let estudiantesSinAsistencia = [];
                    let idDescripcionSemana = $('#id_control_semanal-edit').val();
                    // Recorrer los checkboxes y recoger los seleccionados y no seleccionados
                    $('.asistencia-edit').each(function() {
                        if ($(this).is(':checked')) {
                            estudiantesConAsistencia.push($(this).val());
                        } else {
                            estudiantesSinAsistencia.push($(this).val());
                        }
                    });

                    
                    
                    $.ajax({
                    url: 'actualizar_seguimiento_semanal',
                    method: 'POST',
                    data: {
                        asistencia: estudiantesConAsistencia,
                        faltas: estudiantesSinAsistencia,
                        idDescripcion: idDescripcionSemana,
                        nuevaDescripcion: $('#descripcion-edit').val()

                    }
                    });
                }
            });
        });


        // Delegar el evento click a los botones generados dinámicamente
        //Obtener los ids de los botones generados dinmicmaente 
        $(document).on('click', '.openEdit', function() {
            let id_semana = $(this).data('id'); // Captura el id del botón presionado
            
            function funcionalidadesFormularioEditar(){
                //restablecer formulario edit
                $('.asistencia-edit').each(function() {
                    $(this).prop('checked', false); // Marcar cada checkbox
                });
                $('#descripcion-edit').val('');
                $('#descripcionError-edit').css('display', 'none');
                $('#descripcion-edit').removeClass('error');

                //visualizar formulario edit
                $('#popupForm-edit').css('display', 'flex');
                $('#overlay').css('display', 'flex');
                
                
                //Desaparecer el formulaario edit y el fondo oscuro al presionar a fuera del formulario 
                $('#overlay').on('click', function() {
                    $('#popupForm-edit').css('display', 'none');
                    $('#overlay').css('display', 'none');
                });

                //boton cancelar del formulario edit
                $('#cancelBtn-edit').on('click', function(){
                    $('#popupForm-edit').css('display', 'none');
                    $('#overlay').css('display', 'none');
                });

                //Verificar que el campo descripcion no este vacio
                $('#boton-guardar-seguimiento-semanal-edit').on('click', function() {
                    const descripcionError = $('#descripcionError-edit');
                    const descripcion = $('#descripcion-edit').val().trim();

                    // Verificar si el campo de descripción está vacío
                    if (descripcion === '') {
                        // Mostrar el mensaje de error y resaltar el campo de texto
                        descripcionError.text('Por favor, completa la descripción para editar los datos.');
                        descripcionError.css('display', 'block');
                        $('#descripcion-edit').addClass('error');
                    } else {
                        // Si no está vacío, ocultar el mensaje de error, quitar la clase 'error' y cerrar el formulario
                        $('#descripcion-edit').removeClass('error');
                        $('#popupForm-edit').css('display', 'none');
                        $('#overlay').css('display', 'none');
                    }
                });
            }
            
            
            $.ajax({
                    url: 'recuperar_seguimiento_semanal',
                    method: 'POST',
                    data: {
                        id_control_semanal: id_semana
                    }
                    }).done(function(res){
                        let datos_semana_actual_seleccionada = JSON.parse(res);


                        funcionalidadesFormularioEditar();



                        let descripcion = datos_semana_actual_seleccionada[0][0].control_semanal;
                        let id_control_semanal = datos_semana_actual_seleccionada[0][0].id_control_semanal;
                        let estudiantes_y_asistencias = datos_semana_actual_seleccionada[1];


                        $('#descripcion-edit').val(descripcion);


                        let template_estudiantes = "";
                        let template_asistencia = "";

                        for(let i=0; i<estudiantes_y_asistencias.length; i++){
                            template_estudiantes += `
                                <p class="estudiante">${estudiantes_y_asistencias[i].nombre_estudiante} ${estudiantes_y_asistencias[i].apellido_estudiante}</p>
                            `;

                            if(estudiantes_y_asistencias[i].asistio){
                                template_asistencia += `
                                    <input name="asistencia[]" value="${estudiantes_y_asistencias[i].id_asistencia}" type="checkbox" class="asistencia-edit" checked>
                                `;
                            }else{
                                template_asistencia += `
                                    <input name="asistencia[]" value="${estudiantes_y_asistencias[i].id_asistencia}" type="checkbox" class="asistencia-edit">
                                `;
                            }
                        }

                        $("#estudiantes-edit").html(template_estudiantes);
                        $("#marcar-asistencia-edit").html(template_asistencia);
                        $('#id_control_semanal-edit').val(id_control_semanal);
        
                        
                    });
            
        });

    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/js/bootstrap.bundle.min.js"></script>
</body>
</html>
