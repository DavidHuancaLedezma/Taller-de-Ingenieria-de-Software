<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #e0e0e0;
        }
       
        .container {
            width: 90%;
            margin: 50px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
        }

        .container_uno {
            width: 20%;
            padding: 10px;
            background-color: #f5f5f5;
            margin-bottom: 10px;
        }

        .container_two {
            width: 80%;
           /* background-image: url('https://i.pinimg.com/564x/84/4c/8e/844c8e710a5b94b7ef68294b20028051.jpg');
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;*/
            border-radius: 8px;
        }

        .header h3 {
            text-align: center;
            color: white;
            background-color: #4682b4;
            padding: 10px;
            border-radius: 8px 8px 0 0;
        }
        select {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 20px; 
        }
        .header h1 {
            text-align: center;
            color: white;
            background-color: #4682b4;
            padding: 20px;
            border-top-left-radius: 2px;
            border-top-right-radius: 2px;
        }
        .header h2 {
            text-align: left;
            color: white;
            background-color: #4682b4;
            padding: 30px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }
       

        .tabs {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
        }

        .tab-button {
           /* background-color: #cbe3f4;*/
           background-color: #4682b4;
            color: white;
            /*border: none;*/
           
            border: 2px solid #118CD9;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            
            transition: background-color 0.5s, color 0.5s, border-color 0.5s;
        }
        .tab-button:hover{
            background-color: #222D32;
            color: white;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th, .table td {
            border: 1px solid #ddd;
            padding: 12px;
           
        }
        .table td{
            text-align: left;   
        }
        .table th {
            background-color: #f2f2f2;
            text-align: center;
        }

        

                /* Estilos para formularios emergentes */
                .popup-form {
                    display: none; /* Oculto por defecto */
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background-color: rgba(0, 0, 0, 0.5);
                    justify-content: center;
                    align-items: center;
                    z-index: 9999;
                }

                .contenedor-mini-formulario {
                    background-color: #fff;
                    padding: 50px;
                    border-radius: 10px;
                    width: 400px;
                    box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
                }

                .header-mini-formulario {
                    text-align: center;
                    margin-bottom: 20px;
                }

                .h1-mini-formulario {
                    font-size: 20px;
                    font-weight: bold;
                }

                .form-group {
                    margin-bottom: 15px;
                }
               /* select {
                    width: 190px;
                    height: 50px;
                    
                }*/
                select:focus{
                    border: 2px solid #3F9BBF; /* Cambia el color y grosor del borde */
                    outline: none;   
                }
            
                select option:checked {
                    background-color: #87C5E9; /* Color de fondo de la opción seleccionada 87C5E9*/
                }
                textarea.form-control {
                    width: 100%;
                    resize: none;
                    padding: 10px;
                    border-radius: 5px;
                    border: 1px solid #ccc;
                }

                textarea:focus {
                    border: 2px solid #3F9BBF; /* Cambia el color y grosor del borde */
                    outline: none; /* Elimina el borde azul por defecto */
                } 
                
                .btn-aceptar:hover {
                    background-color: #118CD9;
                    color: white;
                    
                }
                .error-message {
                    color: red;
                    font-size: 0.9em;
                    margin-top: 5px;
                    display: block;
                }
                .footer-mini-formulario {
                    display: flex;
                    justify-content: space-between;
                }

                .btn {
                    padding: 10px 15px;
                    cursor: pointer;
                    border: none;
                    border-radius: 5px;
                    font-size: 14px;
                }

                .btn.btn-info {
                    background-color: #3F9BBF;
                    color: white;
                }

                .btn.btn-danger {
                    background-color: darkred;
                    color: white;
                }
                .lista-actividades li, .lista-criterios li {
                    font-size: 0.7em; /* Ajusta el tamaño de la fuente, por ejemplo, 90% del tamaño normal */
                    line-height: 1.2em; /* Ajusta el espaciado entre las líneas para que se vea más compacto */
                }

            .lista-actividades strong, .lista-criterios strong {
                    font-size: 1em; /* Mantener el texto en negrita ligeramente más grande */
                }
         .back_button {
            border-radius: 25px;
            border: none;
            position: absolute;
            left: 80px; /* Fijar el botón al lado izquierdo */
            top: 10px; /* Posición fija desde el top */
            padding: 10px 20px;
            cursor: pointer;
            color: white ; 
            background-color: #367FA9    
          
        }
    @media (max-width: 768px) {
        .container {
            flex-direction: column;
            align-items: center;
        }

        .container_uno {
            order: 1;
            width: 100%;
        }

        .container_two {
            order: 2;
            width: 100%;
        }

        table {
            width: 100%;
        }

        .table-container {
            overflow-x: auto; /* Permitir desplazamiento horizontal en pantallas pequeñas */
        }
        .back_button {
            left: 20px; /* Reduce la distancia desde el borde izquierdo */
            top: 15px; /* Ajusta la distancia desde la parte superior */
            padding: 8px 10px; /* Reduce el tamaño del botón */
            font-size: 0.9rem; /* Disminuye el tamaño del texto */
            
        }
    }
    @media screen and (max-width: 576px) {
        .container_uno select,
        .form-group textarea,
        .form-group select {
            width: 100%;
            font-size: 14px;
        }

        .back_button {
            width: 100%;
            margin-bottom: 10px;
        }

        .popup-form {
            padding: 10px;
        }

        .contenedor-mini-formulario {
            width: 100%;
            padding: 15px;
        }

        .footer-mini-formulario {
            flex-direction: column;
            gap: 10px;
        }
        table {
            width: 100%;
        }

        .table-container {
            overflow-x: auto; /* Permitir desplazamiento horizontal en pantallas pequeñas */
        }
        .back_button {
            left: 20px; /* Reduce la distancia desde el borde izquierdo */
            top: 15px; /* Ajusta la distancia desde la parte superior */
            padding: 8px 10px; /* Reduce el tamaño del botón */
            font-size: 0.7rem; /* Disminuye el tamaño del texto */
            width: 130px;
        }
    }

    </style>
</head>
<body>
    <input type="hidden" id="id_estudiante" value="{{ $id_estudiante }}">
    <button class="back_button" id="boton-home">Regreso al home <i class="fas fa-home"></i></button>
    <div class="container">
        <div class="container_uno">
            <div class="header">
                <h3>Paso 1: Seleccione Hito</h3>
            </div>
            <select name="hito" id="hitos" required>
                <option value="">-- Selecciona un Hito --</option>
                @foreach($hitos as $hito)
                     <option value="{{ $hito->id_hito }}">{{ 'Hito ' . $hito->numero_hito }}</option>

                 @endforeach
            </select>
            
            <div class="header">
                <h3> Paso 2: Seleccione entregable</h3>
            </div>
            <select name="entregable" id="entregable" required>
                <option value="">-- Selecciona un entregable --</option>
            </select>
        </div>
        <div class="container_two"></div>
        
    </div>
      <!-- Formulario emergente para Actividad -->
      <div id="popupActivityForm" class="popup-form" style="display: none;">
        <div class="contenedor-mini-formulario">
            <header class="header-mini-formulario">
                <h1 class="h1-mini-formulario">Actividad</h1>
            </header>
            <main class="main-mini-formulario">
                <form id="activityForm" action="{{ route('actividad.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="objetivo_id" id="objetivo_id">
                    <div class="form-group">
                        <label for="descripcionActividad">Descripción de la Actividad</label>
                        <textarea name="descripcion" id="descripcionActividad" class="form-control" placeholder="Descripción de la actividad" required></textarea>
                        <span id="descripcionActividadError" class="error-message"></span>
                    </div>
                    <div class="form-group">
                        <label for="resultadoEsperado">Resultado Esperado</label>
                        <textarea name="resultado" id="resultadoEsperado" class="form-control" placeholder="Resultado esperado" required></textarea>
                        <span id="resultadoEsperadoError" class="error-message"></span>
                    </div>
                    <div class="form-group">
                        <label for="estudiante">Asignar a Estudiante</label>
                        <select name="usuario_id" id="estudiante" class="form-control">
                            <option value="">Selecciona un responsable</option>
                            @if ($estudiantes->isNotEmpty())
                                @foreach($estudiantes as $estudiante)
                                    <option value="{{ $estudiante->id_usuario }}">{{ $estudiante->nombre_estudiante }}</option>
                                @endforeach
                            @else
                                <option>No hay estudiantes disponibles</option>
                            @endif

                        </select>
                        <span id="estudianteError" class="error-message"></span>
                    </div>
                    <footer class="footer-mini-formulario">
                        <button type="submit" class="btn btn-info">Añadir <i class="bi bi-rocket-takeoff-fill"></i></button>
                        <button type="button" class="btn btn-danger" id="cancelActivity">Cancelar <i class="bi bi-x-circle-fill"></i></button>
                    </footer>
                </form>
            </main>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#hitos').on('change', function() {
                var hitoId = $(this).val();

                // Limpiar el select de entregables al cambiar de hito
                $('#entregable').html('<option value="">-- Selecciona un Entregable --</option>');

                if (hitoId) {
                    $.ajax({
                        url: '{{ route("get.entregables") }}',
                        type: 'GET',
                        data: { id_hito: hitoId },
                        success: function(data) {
                            // Verificar si hay entregables
                            if (data.length > 0) {
                                $.each(data, function(key, entregable) {
                                    $('#entregable').append('<option value="' + entregable.id_objetivo + '">' + entregable.descrip_objetivo + '</option>');
                                });
                            } else {
                                Swal.fire('Sin entregables', 'No hay entregables disponibles para el hito seleccionado.', 'warning');                            }
                        }
                    });
                }
            });
            $('#entregable').on('change', function() {
            var entregableId = $(this).val();
            if (entregableId) {
                $.ajax({
                    url: '/entregable-data/' + entregableId,
                    type: 'GET',
                    success: function(response) {
                        $('#objetivo_id').val(entregableId);
                        if (response.error) {
                            Swal.fire('Error', response.error, 'error');
                        } else {
                            // Renderizar título y actividades en container_two
                            $('.container_two').html(`
                                <div class= "header">
                                <h2 class="titulo-objetivo">Entregable: ${response.objetivo.descrip_objetivo}</h2>
                                </div>
                                <div class="tabs">
                                    <button id="add-activity" class="tab-button">Actividades +</button>
                                
                                </div>
                                <div class="table-container">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Descripción de actividad</th>
                                            <th>Resultado esperado</th>
                                            <th>Responsable</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        ${response.actividades.map(actividad => {
                                            const estudiante = response.estudiantes.find(est => est.id_usuario === actividad.id_usuario);
                                            return `
                                                <tr>
                                                    <td>${actividad.descripcion_actividad}</td>
                                                    <td>${actividad.resultado}</td>
                                                    <td>${estudiante ? estudiante.nombre_estudiante : 'No asignado'}</td>
                                                </tr>`;
                                        }).join('')}
                                    </tbody>
                                </table>
                                </div>
                            `);
                        }
                    },
                    error: function() {
                        Swal.fire('Error', 'Error al obtener los datos del entregable.', 'error');
                    }
                });
            } else {
                $('.container_two').empty();
            }
            if (!$('#hitos').val()) {
                    Swal.fire('Error', 'Por favor, selecciona un hito primero.', 'error');
                    
                }
        });
        //});
    
         // Mostrar el formulario emergente para Actividad
         $(document).on('click', '#add-activity', function() {
                $('#popupActivityForm').css('display', 'flex'); // Mostrar el formulario
            });

            // Cerrar formulario de Actividad
            $('#cancelActivity').on('click', function() {
                $('#popupActivityForm').hide(); // Ocultar el formulario
            });

                  // Función de validación en tiempo real
            function validateField(field, minLength, maxLength, errorField, emptyMessage, lengthMessage) {
                const value = field.val().trim();
                
                if (value === '') {
                    errorField.text(emptyMessage);
                    return false;
                } else if (value.length < minLength) {
                    errorField.text(`Debe tener al menos ${minLength} caracteres.`);
                    return false;
                } else if (value.length > maxLength) {
                    errorField.text(`No puede exceder ${maxLength} caracteres.`);
                    return false;
                } else {
                    errorField.text('');
                    return true;
                }
            }
        


            // Validación y envío del formulario de actividad
            $('#activityForm').on('submit', function(e) {
                e.preventDefault(); // Prevenir el envío por defecto
                let isValid = true;

              //  const descripcion = $('#descripcionActividad').val().trim();
              //  const resultado = $('#resultadoEsperado').val().trim();
             //   const estudiante = $('#estudiante').val();

                const descripcionValid = validateField(
                $('#descripcionActividad'), 5, 500,
                $('#descripcionActividadError'),
                'La descripción es obligatoria.',
                'La descripción debe tener entre 5 y 500 caracteres.'
            );


            const resultadoValid = validateField(
                $('#resultadoEsperado'), 5, 500,
                $('#resultadoEsperadoError'),
                'El resultado esperado es obligatorio.',
                'El resultado esperado debe tener entre 5 y 500 caracteres.'
            );
            const estudianteValid = $('#estudiante').val() !== '';
            if (!estudianteValid) {
                $('#estudianteError').text('Debes asignar un estudiante responsable.');
            } else {
                $('#estudianteError').text('');
            }
            isValid = descripcionValid && resultadoValid && estudianteValid;

                if (isValid) {
                    $.ajax({
                        url: $(this).attr('action'),
                        type: $(this).attr('method'),
                        data: $(this).serialize(), // Serializar el formulario
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Éxito',
                                    text: response.success,
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                            }
                            $('#popupActivityForm').hide(); // Ocultar el formulario
                            $('#activityForm')[0].reset(); // Limpiar el formulario
                            //$('.container_two').empty(); // Limpiar las actividades (opcional, o puedes volver a cargar)
                            const entregableId = $('#entregable').val();
                           
                $.ajax({
                    url: '/entregable-data/' + entregableId,
                    type: 'GET',
                    success: function(response) {
                        $('.container_two').html(`
                            <div class="header">
                                <h2 class="titulo-objetivo">Entregable: ${response.objetivo.descrip_objetivo}</h2>
                            </div>
                            <div class="tabs">
                                <button id="add-activity" class="tab-button">Actividades +</button>
                            </div>
                            <div class="table-container">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Descripción de actividad</th>
                                        <th>Resultado esperado</th>
                                        <th>Responsable</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${response.actividades.map(actividad => {
                                        const estudiante = response.estudiantes.find(est => est.id_usuario === actividad.id_usuario);
                                        return `
                                            <tr>
                                                <td>${actividad.descripcion_actividad}</td>
                                                <td>${actividad.resultado}</td>
                                                <td>${estudiante ? estudiante.nombre_estudiante : 'No asignado'}</td>
                                            </tr>`;
                                    }).join('')}
                                </tbody>
                            </table>
                            </div>
                        `);
                    },
                    error: function() {
                        alert('Error al obtener los datos del entregable.');
                    }
                });

                        },
                        error: function(xhr) {
                        $('#popupActivityForm').hide();

                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: xhr.responseJSON.error,
                            confirmButtonText: "Aceptar"
                        });
                    }
                    });
                }
            
            });

              // Validación en tiempo real al escribir en los campos
        $('#descripcionActividad').on('keyup', function() {
            validateField(
                $(this), 5, 500, $('#descripcionActividadError'),
                'La descripción es obligatoria.',
                'La descripción debe tener entre 5 y 500 caracteres.'
            );
        });

        $('#resultadoEsperado').on('keyup', function() {
            validateField(
                $(this), 5, 500, $('#resultadoEsperadoError'),
                'El resultado esperado es obligatorio.',
                'El resultado esperado debe tener entre 5 y 500 caracteres.'
            );
        });

        $('#estudiante').on('change', function() {
            if ($(this).val() === '') {
                $('#estudianteError').text('Debes asignar un estudiante responsable.');
            } else {
                $('#estudianteError').text('');
            }
        });
    });
    $("#boton-home").on("click", function () {
                //Regresa al home del estudiante
                let idEstudiante = $('#id_estudiante').val();
                
                window.location.href = `{{ url('/estudiante_home/${idEstudiante}') }}`;
    });
    </script>
 </body>
</html>