<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
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
                <h3>Paso 2: Seleccione entregable</h3>
            </div>
            <select name="entregable" id="entregable" required>
                <option value="">-- Selecciona un entregable --</option>
            </select>
        </div>
        <div class="container_two"></div>
    </div>
    <!-- Formulario emergente para Criterio de Aceptación -->
    <div id="popupCriteriaForm" class="popup-form" style="display: none;">
        <div class="contenedor-mini-formulario">
            <header class="header-mini-formulario">
                <h1 class="h1-mini-formulario">Criterio de aceptación</h1>
            </header>
            <main class="main-mini-formulario">
                <form id="criteriaForm" action="{{ route('criterio_aceptacion.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="objetivo_id" id="objetivo_id">
                    <div class="form-group">
                        <label for="descripcionCriterio">Descripción</label>
                        <textarea name="descripcionCriterio" id="descripcionCriterio" cols="45" rows="4" class="form-control" placeholder="Descripción del criterio de aceptación"></textarea>
                        <span id="descripcionCriterioError" class="error-message"></span>
                    </div>
                    <footer class="footer-mini-formulario">
                        <button type="submit" class="btn btn-info">Añadir <i class="bi bi-rocket-takeoff-fill"></i></button>
                        <button type="button" class="btn btn-danger" id="cancelCriteria">Cancelar <i class="bi bi-x-circle-fill"></i></button>
                    </footer>
                </form>
            </main>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#hitos').on('change', function() {
                var hitoId = $(this).val();

                $('#entregable').html('<option value="">-- Selecciona un Entregable --</option>');

                if (hitoId) {
                    $.ajax({
                        url: '{{ route("get.entregables") }}',
                        type: 'GET',
                        data: { id_hito: hitoId },
                        success: function(data) {
                            if (data.length > 0) {
                                $.each(data, function(key, entregable) {
                                    $('#entregable').append('<option value="' + entregable.id_objetivo + '">' + entregable.descrip_objetivo + '</option>');
                                });
                            } else {
                                Swal.fire('Sin entregables', 'No hay entregables disponibles para el hito seleccionado.', 'warning');
                            }
                        }
                    });
                }
            });

            $('#entregable').on('change', function() {
                var entregableId = $(this).val();
                if (entregableId) {
                    $.ajax({
                        url: '/criterioAceptacion/' + entregableId,
                        type: 'GET',
                        success: function(response) {
                            $('#objetivo_id').val(entregableId);
                            if (response.error) {
                                Swal.fire('Error', response.error, 'error');
                            } else {
                                $('.container_two').html(`
                                    <div class= "header">
                                        <h2 class="titulo-objetivo">Entregable: ${response.objetivo.descrip_objetivo}</h2>
                                    </div>
                                    <div class="tabs">
                                        <button id="add-criteria" class="tab-button">Criterios de Aceptación +</button>
                                    </div>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Descripción de criterio de aceptación</th>
                                            </tr>
                                        </thead>
                                        <tbody id="activityTable">
                                            ${response.criterios_aceptacion.map(criterio => `
                                                <tr>
                                                    <td>${criterio.descripcion_ca}</td>
                                                </tr>
                                            `).join('')}
                                        </tbody>
                                    </table>
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
                
            });
            
            
            // Mostrar el formulario emergente para Actividad
         $(document).on('click', '#add-criteria', function() {
                $('#popupCriteriaForm').css('display', 'flex'); // Mostrar el formulario
            });

            $('#cancelCriteria').on('click', function () {
                $('#popupCriteriaForm').hide();
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
            $('#criteriaForm').on('submit', function(e) {
            e.preventDefault(); // Prevenir el envío por defecto
            let isValid = true;

            const descripcionValid = validateField(
                $('#descripcionCriterio'), 5, 500,
                $('#descripcionCriterioError'),
                'La descripción es obligatoria.',
                'La descripción debe tener entre 5 y 500 caracteres.'
            );

            isValid = descripcionValid;

    if (isValid) {
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito',
                        text: response.success,
                        showConfirmButton: false,
                        timer: 2000
                    });
                    $('#popupCriteriaForm').hide();
                    $('#criteriaForm')[0].reset();

                    // Realizar otra llamada AJAX para cargar los datos actualizados en `container_two`
                    const entregableId = $('#entregable').val();
                    $.ajax({
                        url: '/criterioAceptacion/' + entregableId,
                        type: 'GET',
                        success: function(response) {
                            if (response.error) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: response.error
                                });
                            } else {
                                $('.container_two').html(`
                                    <div class="header">
                                        <h2 class="titulo-objetivo">Entregable: ${response.objetivo.descrip_objetivo}</h2>
                                    </div>
                                    <div class="tabs">
                                        <button id="add-criteria" class="tab-button">Criterios de Aceptación +</button>
                                    </div>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Descripción de criterio de aceptación</th>
                                            </tr>
                                        </thead>
                                        <tbody id="activityTable">
                                            ${response.criterios_aceptacion.map(criterio => `
                                                <tr>
                                                    <td>${criterio.descripcion_ca}</td>
                                                </tr>
                                            `).join('')}
                                        </tbody>
                                    </table>
                                `);
                            }
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Error al obtener los datos del entregable.'
                            });
                        }
                    });
                }
            },
            error: function(xhr) {
                $('#popupCriteriaForm').hide();

                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: xhr.responseJSON.error
                });
            }
        });
    }
});
        $('#descripcionCriterio').on('keyup', function() {
            validateField(
                $(this), 5, 500, $('#descripcionCriterioError'),
                'La descripción es obligatoria.',
                'La descripción debe tener entre 5 y 500 caracteres.'
            );
        });

        $('#descripcionCriterio').on('focus', function () {
                $('#descripcionCriterioError').text('');
            });
     
    });
        $("#boton-home").on("click", function () {
                    //Regresa al home del estudiante
                    let idEstudiante = $('#id_estudiante').val();
                    
                    window.location.href = `{{ url('/estudiante_home/${idEstudiante}') }}`;
        });
        
       // });
    </script>
</body>

</html>