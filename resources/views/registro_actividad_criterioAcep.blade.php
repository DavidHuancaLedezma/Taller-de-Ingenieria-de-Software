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
            background-image: url('https://i.pinimg.com/564x/84/4c/8e/844c8e710a5b94b7ef68294b20028051.jpg');
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
            font-size: 36px;
            color: #118CD9;
            text-align: center;
            margin-bottom: 40px;
        }

        /* Subtítulos de Añadir Actividad y Criterio */
        .subtitles {
            display: flex;
            justify-content: space-around;
            margin-top: 30px;
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

    </style>
</head>
<body>
    <div class="background"></div>
    <div class="content">
        <div class="container">
            <!-- Título del objetivo -->
            <h1>{{ $objetivo->descripcion }}</h1>
            
            <!-- Subtítulos -->
            <div class="subtitles">
                <a href="#" id="add-activity">Actividad <i class="bi bi-plus-circle"></i></a>
                <a href="#" id="add-criteria">Criterio de Aceptación <i class="bi bi-plus-circle"></i></a>
            </div>
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
        background-color: darkred;
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
