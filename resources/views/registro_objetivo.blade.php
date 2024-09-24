<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro objetivo</title>
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
            background-image: url('https://impulsapopular.com/wp-content/uploads/2014/09/iStock_66988435_LARGE.jpg'); /* Reemplaza con la URL de tu imagen */
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            filter: blur(10px); /* Ajusta el valor del blur según tu preferencia */
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

        /* Contenedor de color plomo con fondo difuminado */
        .container {
            background-color: rgba(255, 255, 255, 0.8); 
            border-radius: 8px;
            padding: 10%;
            display: inline-block;
            max-width: 80%; /* Ajusta el máximo ancho del contenedor */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5); 
            box-sizing: border-box; /* Asegura que el padding no se agregue al tamaño total del contenedor */
            text-align: left; /* Alinea el contenido a la izquierda */
        }

        .container h1, .container p {
            margin: 0 100 10px;
            padding: 0;
        }

        /* Estilos específicos para los inputs */
        input[type="text"],select, input[type="date"] {
            background-color: rgba(150, 150, 150, 0.3); /* Color plomo más suave */
            /*background-color: white;*/
            color:black;
            border: 1px solid rgba(100, 100, 100, 0.5);
            border-radius: 4px;
            padding: 10px;
            font-size: 16px;
            margin-bottom: 10px;
            width: calc(100%); /* Ajusta el ancho considerando el padding */
            box-sizing: border-box; /* Asegura que el padding no se agregue al tamaño total del input */
            
        }
        .select_priori_group{
            display: flex;
            justify-content: space-between;
        }
        /* Estilo para los campos de fecha */
        .date-group {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px; 
    
        }
        select {
            width: 200px;
            height: 40px;
        }


        input[type="date"] {
            color:rgba(80,80,80);
            width: calc(95% - 8px); /* Ajusta el ancho de los campos de fecha */
            margin-right: 2%;
        }

        /* Estilo para las etiquetas de radio */
        .radio-group {
            display: flex;
            justify-content: space-between;
            
        }
       
        .acti_criAcep{
            display: flex;
            gap: 20%;
        }
        a{
            color: black;
            font-size: 23px;
            text-decoration:none;
            padding: 5px;
            margin-bottom: 10px;
            
            }
        a:hover{
            color: #118CD9;
        }

        label {
            margin-right: 10px;
            color: black;
            font-size: 16px; /* Tamaño de fuente más pequeño para las etiquetas de radio */
        }
        input[type="text"]:focus {
            border: 2px solid #3F9BBF; /* Cambia el color y grosor del borde */
            outline: none; /* Elimina el borde azul por defecto */
        }   
        select:focus{
            border: 2px solid #3F9BBF; /* Cambia el color y grosor del borde */
            outline: none;   
        }
        input[type="date"]:focus{
            border: 2px solid #3F9BBF; /* Cambia el color y grosor del borde */
            outline: none; 
        }   
        .botones {
            display: flex;
            gap: 50px; /* Espacio entre los botones */
            position: fixed;
            bottom: 20px;  /* Alinea los botones 20px arriba del borde inferior */
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

        /* Cambiar el color del texto y el fondo al pasar el mouse sobre el botón de Cancelar */
        .btn-cancelar:hover {
            background-color: darkred;
            color: white;
            border-color: darkred;
        }

    </style>
</head>
<body>
    <div class="background"></div>
    <div class="content">
        <div class="container">
            <h1>Registro de Planificación</h1>
            
            @if(session('success'))
                <script>
                    Swal.fire({
                        title: '¡Registro exitoso!',
                        text: 'Ojetivo registrado correctamente',
                        icon: 'success',
                        confirmButtonText: 'Ir al inicio',
                        allowOutsideClick: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "{{ url('/') }}"; // Cambia la URL según tu necesidad
                        }
                    });
                </script>
            @endif

            <form action="{{ route('objetivo.store') }}" method="POST">
                @csrf
                <!-- Campo para el objetivo -->
                <h5>Objetivo</h5>
                <input type="text" name="objetivo" placeholder="Escribe tu objetivo" value="{{ old('objetivo') }}" required>

                <div class="select_priori_group">
                    <div>
                    <h5>Seleccione Hito</h5>
                        <select name="hito" id="hitos" required>
                            <option value="">-- Selecciona un Hito --</option>
                            @foreach($hitos as $hito)
                                <option value="{{ $hito->id_hito }}">{{ 'Hito ' . $hito->numero_hito }}</option>

                            @endforeach
                        </select>
                    </div>

                    <!-- Selección de prioridad -->
                    <div>
                        <h5>Prioridad</h5>
                        <div class="radio-group"> 
                            <label>
                                <input type="radio" name="prioridad" value="Alta" {{ old('prioridad') == 'Alta' ? 'checked' : '' }}> Alta
                            </label>
                            <label>
                                <input type="radio" name="prioridad" value="Media" {{ old('prioridad') == 'Media' ? 'checked' : '' }}> Media
                            </label>
                            <label>
                                <input type="radio" name="prioridad" value="Baja" {{ old('prioridad') == 'Baja' ? 'checked' : '' }}> Baja
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Fecha de inicio y fin -->
                <div class="date-group">
                    <div>
                        <h5>Fecha Inicio</h5>
                        <input type="date" name="fecha_inicio" value="{{ old('fecha_inicio') }}" required>
                    </div>
                    <div>
                        <h5>Fecha Fin</h5>
                        <input type="date" name="fecha_fin" value="{{ old('fecha_fin') }}" required>
                    </div>
                </div>

                <!-- Botones de Aceptar y Cancelar -->
                <div class="botones">
                    <button type="submit" class="btn-aceptar">
                        Aceptar <i class="bi bi-rocket-takeoff-fill"></i>
                        <span class="overplay"></span>
                    </button>

                    <!-- Cambia route() por url() si sigues teniendo problemas con route() -->
                    <button type="button"  class="btn-cancelar" onclick="window.location.href='{{ url('/') }}'">
                        Cancelar <i class="bi bi-x-circle-fill"></i>
                        <span class="overplay"></span>
                    </button>
                </div>
                <div class= acti_criAcep>
                <a href="#" id="add-activity">Actividad <i class="bi bi-plus-circle"></i></a>
                <a href="#" id="add-criteria">Criterios de aceptación <i class="bi bi-plus-circle"></i></a>
                </div>
                </div>
                <!-- Mostrar errores de validación -->
                @if ($errors->any())
                    <div style="color: red">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            </form>
        </div>
    </div>
    
   <!-- Formulario emergente -->
<div id="popupForm" class="popup-form">
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
            
            <button id="boton-guardar-actividad" class="btn btn-info">Guardar</button>
            <button class="btn btn-danger" id="cancelBtn">Cancelar</button>
            
        </footer>
    </div>
</div>

<!-- Estilos CSS mejorados -->
<style>
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
        margin-bottom: 50px;
    }

    .h1-mini-formulario {
        font-size: 20px;
        font-weight: bold;
    }

    .form-group {
        margin-bottom: 15px;
    }

    textarea.form-control {
        width: 100%;
        resize: none;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
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
        background-color: red;
        color: white;
    }
</style>

<!-- JavaScript para manejar la interacción del formulario -->
<script>
    // Obtener los elementos del DOM
    const popupForm = document.getElementById('popupForm');
    const addCriteriaBtn = document.getElementById('add-criteria');
    const cancelBtn = document.getElementById('cancelBtn');
    const saveBtn = document.getElementById('boton-guardar-actividad');
    const descripcionCriterio = document.getElementById('descripcionCriterio');
    const descripcionError = document.getElementById('descripcionError');

    // Mostrar el formulario emergente al hacer clic en "Criterios de aceptación"
    addCriteriaBtn.addEventListener('click', function (e) {
        e.preventDefault(); // Prevenir el comportamiento predeterminado del enlace
        popupForm.style.display = 'flex';
    });

    // Cerrar el formulario emergente al hacer clic en "Cancelar"
    cancelBtn.addEventListener('click', function () {
        popupForm.style.display = 'none';
    });

    // Validar y guardar al hacer clic en "Guardar"
    saveBtn.addEventListener('click', function (e) {
        e.preventDefault();
        if (descripcionCriterio.value.trim() === "") {
            descripcionError.textContent = "La descripción es obligatoria.";
            descripcionError.style.display = "block";
        } else {
            // Si la validación es correcta, ocultar el formulario
            descripcionError.style.display = "none";
            popupForm.style.display = 'none';
            alert("Datos guardados correctamente"); // Aquí puedes agregar la lógica para guardar los datos
        }
    });

    // También cerrar el modal si se hace clic fuera del formulario
    window.addEventListener('click', function (e) {
        if (e.target === popupForm) {
            popupForm.style.display = 'none';
        }
    });
</script>

</body>

</html>

