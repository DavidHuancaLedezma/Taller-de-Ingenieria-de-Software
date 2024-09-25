<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detalle de Objetivo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="css/actividad.css">
    <style>
        /* Estilos generales */
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        /* Fondo con imagen y efecto blur */
        .background {
            /*background-image: url('https://i.pinimg.com/564x/84/4c/8e/844c8e710a5b94b7ef68294b20028051.jpg');*/
            background-color: #D2D6DE;
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            filter: blur(5px);
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: -1;
        }

        /* Contenido encima del fondo borroso */
        .content {
            position: relative;
            z-index: 1;
            text-align: center;
            top: 40%;
            transform: translateY(-50%);
            color: black;
            font-size: 24px;
        }

        /* Contenedor de contenido */
        .container {
            background-color: rgba(255, 255, 255, 0.8); 
            border-radius: 8px;
            padding: 5%;
            display: inline-block;
            max-width: 80%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
            text-align: left;
        }

        /* Título principal del objetivo */
        h1 {
            font-size: 30px;
            color: #118CD9;
            text-align: center;
            margin-bottom: 40px;
        }

        /* Subtítulos de Añadir Actividad y Criterio */
        .subtitles {
            /*display: flex;
            justify-content: space-around;*/
           
            margin-top: 30px;
            text-align: left;
        }
        .subtitles a {
            display: block; /* Asegura que cada enlace ocupe su propia línea */
            margin: 10px 0; /* Añade margen entre los enlaces */
        }

        a {
            color: black;
            font-size: 22px;
            text-decoration: none;
            padding: 10px;
        }

        a:hover {
            color: #118CD9;
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
        select {
            width: 190px;
            height: 30px;
            
        }
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
        .botones {
            display: flex;
            gap: 50px; /* Espacio entre los botones */
            position: fixed;
            bottom: 2px; /* Alinea los botones 20px arriba del borde inferior */
            left: 50%;
            transform: translateX(-50%);
        }     
        .botones button{
            cursor: pointer;
            /*background-color: transparent;*/
            border: 2px solid #118CD9;
            width: fit-content;
            display: block;
            margin: 20px auto;
            padding: 10px 22px;
            font-size: 16px;
            color: black;
            position: relative;
            z-index: 10;
            border-radius: 8px; /* Bordes ligeramente curvados */
            transition: background-color 0.5s, color 0.5s, border-color 0.5s;
        
        }
   
        .botones button:hover .overplay{
            width: 100%;
          
        }
        .btn-aceptar:hover {
            background-color: #118CD9;
            color: white;
            
        }

        .error-message {
            color: red;
            font-size: 12px;
            display: none; /* Oculto por defecto */
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
    </style>
</head>
<body>
    <div class="background"></div>
    <div class="content">
        <div class="container">
            <!-- Título del objetivo -->
            <h1>{{ $objetivo->descrip_objetivo ?? 'Descripción no disponible' }}</h1>
            
            <!-- Subtítulos -->
            <div class="subtitles">
                <a href="#" id="add-activity">Actividad <i class="bi bi-plus-circle"></i></a>
                <a href="#" id="add-criteria">Criterio de Aceptación <i class="bi bi-plus-circle"></i></a>
            </div>
            <div class="botones">
                <button type="button"  class="btn-aceptar" onclick="window.location.href='{{ url('/') }}'">
                    Aceptar <i class="bi bi-check-circle-fill"></i>
                    
                </button>
                </div>
        </div>
            @if(session('success'))
                    <script>
                        Swal.fire({
                            title: '¡Registro exitoso!',
                            text: 'Registrado guardado correctamente',
                            icon: 'success',
                            confirmButtonText: 'Aceptar',
                            allowOutsideClick: false
                        })
                    </script>
            @endif
            @if(session('error'))
                    <script>
                        Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Error de registro!",
                        });
                    </script>
            @endif
    </div>

    <!-- Formulario emergente para Criterio de Aceptación -->
    <div id="popupCriteriaForm" class="popup-form">
        <div class="contenedor-mini-formulario">
            <header class="header-mini-formulario">
                <h1 class="h1-mini-formulario">Criterio de aceptación</h1>
            </header>
            <main class="main-mini-formulario">
                <div class="form-group">
                    <label for="descripcionCriterio">Descripción</label>
                    <textarea name="descripcionCriterio" id="descripcionCriterio" cols="45" rows="4" class="form-control" placeholder="Descripción del criterio de aceptación"></textarea>
                    <span id="descripcionError" class="error-message"></span>
                </div>
            </main>
            <footer class="footer-mini-formulario">
                <button id="boton-guardar-criterio" class="btn btn-info">Guardar</button>
                <button class="btn btn-danger" id="cancelCriteria">Cancelar</button>
            </footer>
        </div>
    </div>
    
    <!-- Formulario emergente para Actividad -->
    <div id="popupActivityForm" class="popup-form">
        <div class="contenedor-mini-formulario">
            <header class="header-mini-formulario">
                <h1 class="h1-mini-formulario">Actividad</h1>
            </header>
            <main class="main-mini-formulario">
                <form action="{{ route('actividad.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="objetivo_id" value="{{ $objetivo->id_objetivo }}">
                    <div class="form-group">
                        <label for="descripcionActividad">Descripción de la Actividad</label>
                        <textarea name="descripcion" id="descripcionActividad" class="form-control" placeholder="Descripción de la actividad"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="resultadoEsperado">Resultado Esperado</label>
                        <!--input type="text" name="resultado" id="resultadoEsperado" class="form-control" placeholder="Resultado esperado"-->
                        <textarea name="resultado" id="resultadoEsperado" class="form-control" placeholder="Resultado esperado"></textarea>
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
                    </div>


                    <footer class="footer-mini-formulario">
                        <button type="submit" class="btn btn-info">Guardar</button>
                        <button type="button" class="btn btn-danger" id="cancelActivity">Cancelar</button>
                    </footer>
                </form>
            </main>
        </div>
    </div>

    <script>
        // Obtener elementos del DOM
        const popupCriteriaForm = document.getElementById('popupCriteriaForm');
        const popupActivityForm = document.getElementById('popupActivityForm');
        const addCriteriaBtn = document.getElementById('add-criteria');
        const addActivityBtn = document.getElementById('add-activity');
        const cancelCriteriaBtn = document.getElementById('cancelCriteria');
        const cancelActivityBtn = document.getElementById('cancelActivity');
        const botonGuardarCriterio = document.getElementById('boton-guardar-criterio');
        const descripcionCriterio = document.getElementById('descripcionCriterio');
        const descripcionError = document.getElementById('descripcionError');

        // Mostrar el formulario emergente para Criterio de Aceptación
        addCriteriaBtn.addEventListener('click', function (e) {
            e.preventDefault(); // Prevenir la acción por defecto del enlace
            popupCriteriaForm.style.display = 'flex'; // Mostrar el formulario
        });

        // Mostrar el formulario emergente para Actividad
        addActivityBtn.addEventListener('click', function (e) {
            e.preventDefault(); // Prevenir la acción por defecto del enlace
            popupActivityForm.style.display = 'flex'; // Mostrar el formulario
        });

        // Cerrar formulario de Criterio de Aceptación
        cancelCriteriaBtn.addEventListener('click', function () {
            popupCriteriaForm.style.display = 'none'; // Ocultar el formulario
        });

        // Cerrar formulario de Actividad
        cancelActivityBtn.addEventListener('click', function () {
            popupActivityForm.style.display = 'none'; // Ocultar el formulario
        });

        // Guardar Criterio de Aceptación
        botonGuardarCriterio.addEventListener('click', function () {
            const descripcion = descripcionCriterio.value.trim();
            if (descripcion === '') {
                descripcionError.textContent = 'La descripción no puede estar vacía';
                descripcionError.style.display = 'block';
            } else {
                descripcionError.style.display = 'none';
                // Aquí puedes agregar el código para enviar el formulario o realizar otra acción
                Swal.fire('Criterio de aceptación guardado correctamente');
                popupCriteriaForm.style.display = 'none'; // Ocultar el formulario
                descripcionCriterio.value = ''; // Limpiar el campo
            }
        });
    </script>
</body>
</html>
