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
            /*background-image: url('https://i.pinimg.com/564x/84/4c/8e/844c8e710a5b94b7ef68294b20028051.jpg');*/
            background-color: #D2D6DE;
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            filter: blur(5px);  /*Ajusta el valor del blur según tu preferencia */
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
        
       /* Estilos para la cabecera completa */
        .header {
            background-color: #4682b4; /* Color de fondo para toda la parte superior */
            padding: 30px; /* Espaciado alrededor del contenido */
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            text-align: center; /* Centrar el contenido */
        }

        .header h1 {
            color: white; /* Color del texto del h1 */
            margin: 0; /* Elimina los márgenes por defecto del h1 para que no agregue espacios indeseados */
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
            border-left: 5px solid #4682b4; /* Borde izquierdo más grueso */
            padding-left: 10px; /* Añade espacio interior para que el texto no quede pegado al borde */
            
        }
        /*.select_priori_group{
            display: flex;
            justify-content: space-between;
        }*/
        /* Estilo para los campos de fecha */
        .date-group {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px; 
    
        }
        select {
            width: 400px;
            height: 40px;
        }

        input[type="date"] {
            color:rgba(80,80,80);
            width: calc(95% - 8px); /* Ajusta el ancho de los campos de fecha */
            margin-right: 2%;
        }
        
        #fecha-inicio-group {
            margin-left: -50px; /* Ajusta este valor según lo que necesites */
        }
       
        .acti_criAcep{
            display: flex;
            gap: 20%;
        }
        .texto{
            height: 60px;
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
        p{
            font-size: 14px;
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
        .error-message {
            color: red;
            font-size: 0.9em;
            margin-top: s5px;
            display: block;
        }

    </style>
</head>
<body>
    <div class="background"></div>
    <div class="content">
        <div class="container">
            <div class="header">
                <h1>Registro de Objetivo</h1>
            </div>
          <!-- caja de Exito -->
            @if(session('success'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Buen trabajo',
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
                <!-- fin de codigo caja exito -->
            <form action="{{ route('objetivo.store') }}" method="POST">
                @csrf
                <input type="hidden" name="proyecto_id" value="{{ $id_proyecto }}">
                <!-- Campo para el objetivo -->
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
                </div>
                <h5>Objetivo</h5>
                <input type="text" class="texto" name="objetivo" placeholder="Escribe tu objetivo" value="{{ old('objetivo') }}" required>
                <p id="error-objetivo" style="color:red; display:none;">El objetivo debe tener al menos 20 caracteres.</p>
                <p id="error-caracteres" style="color:red; display:none;">El objetivo no puede exceder 500 caracteres y debe contener como máximo 10 caracteres especiales o números.</p>
                

                <!-- Fecha de inicio y fin -->
                <div class="date-group">
                    <div id="fecha-inicio-group">
                        <h5>Fecha Inicio</h5>
                        <input type="date"  id="fecha_inicio" name="fecha_inicio" value="{{ old('fecha_inicio') }}" required>
                    </div>
                    <div>
                        <h5>Fecha Fin</h5>
                        <input type="date" name="fecha_fin" value="{{ old('fecha_fin') }}" required>
                    </div>
                </div>

                <!-- Botones de Aceptar y Cancelar -->
                <div class="botones">
                    <button type="submit" class="btn-aceptar">
                        Registrar <i class="bi bi-rocket-takeoff-fill"></i>
                        <span class="overplay"></span>
                    </button>

                    <!-- Cambia route() por url() si sigues teniendo problemas con route() -->
                    <button type="button"  class="btn-cancelar" onclick="window.location.href='{{ url('/') }}'">
                        Cancelar <i class="bi bi-x-circle-fill"></i>
                        <span class="overplay"></span>
                    </button>
                </div>
         </form>
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
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const hitos = @json($hitos); // Obtener los hitos en formato JSON desde Blade

        const hitoSelect = document.getElementById('hitos');
        const fechaInicioInput = document.querySelector('input[name="fecha_inicio"]');
        const fechaFinInput = document.querySelector('input[name="fecha_fin"]');
        const objetivoInput = document.querySelector('input[name="objetivo"]');
        const errorObjetivo = document.getElementById('error-objetivo');
        const errorCaracteres = document.getElementById('error-caracteres');
        
        const errorPrioridad = document.getElementById('error-prioridad');

        let fechaInicioHandler, fechaFinHandler;

          // Función para contar caracteres especiales y números
        function countSpecialCharsAndNumbers(str) {
            const regex = /[0-9!@#$%^&*(),.?":{}|/<>]/g; // Carácteres especiales y números
            const matches = str.match(regex);
            return matches ? matches.length : 0;
        }
         // Validación del campo "Objetivo"
        objetivoInput.addEventListener('input', function () {
            const objetivoLength = this.value.length;
            const specialCharCount = countSpecialCharsAndNumbers(this.value);

            if (objetivoLength < 20) {
                errorObjetivo.style.display = 'block'; // Mostrar error si el objetivo es muy corto
            } else {
                errorObjetivo.style.display = 'none'; // Ocultar error si cumple la longitud
            }

            if (objetivoLength > 500 || specialCharCount > 10) {
                errorCaracteres.style.display = 'block'; // Mostrar error si excede el límite de caracteres o especiales
            } else {
                errorCaracteres.style.display = 'none'; // Ocultar error si cumple los límites
            }
        });

        

        // Validar si se selecciona alguna prioridad al enviar el formulario
        document.querySelector('form').addEventListener('submit', function (e) {
           

            // Validación final del campo de objetivo
            const objetivoLength = objetivoInput.value.length;
            const specialCharCount = countSpecialCharsAndNumbers(objetivoInput.value);

            if (objetivoLength < 20 || objetivoLength > 500 || specialCharCount > 10) {
                e.preventDefault(); // Evitar envío si no cumple las validaciones
                if (objetivoLength < 20) {
                    errorObjetivo.style.display = 'block'; // Mostrar error si el objetivo es muy corto
                }
                if (objetivoLength > 500 || specialCharCount > 10) {
                    errorCaracteres.style.display = 'block'; // Mostrar error si excede el límite de caracteres o especiales
                }
            }
        });

        // Función para quitar listeners previos antes de agregar nuevos
        function removePreviousHandlers() {
            if (fechaInicioHandler) {
                fechaInicioInput.removeEventListener('change', fechaInicioHandler);
            }
            if (fechaFinHandler) {
                fechaFinInput.removeEventListener('change', fechaFinHandler);
            }
        }

        hitoSelect.addEventListener('change', function () {
            const hitoSeleccionado = hitos.find(hito => hito.id_hito == this.value);

            // Limpiar eventos previos al cambiar de hito
            removePreviousHandlers();

            if (hitoSeleccionado) {
                // Convertir las fechas del hito a formato Date
                const hitoFechaInicio = new Date(hitoSeleccionado.fecha_inicio_hito);
                const hitoFechaFin = new Date(hitoSeleccionado.fecha_fin_hito);

                // Validar la fecha de inicio del objetivo
                fechaInicioHandler = function () {
                    const fechaInicio = new Date(this.value);

                    // Validar que la fecha esté dentro del rango del hito seleccionado
                    if (fechaInicio < hitoFechaInicio || fechaInicio > hitoFechaFin) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Fecha fuera de rango',
                            text: `La fecha de inicio debe estar dentro del rango del hito seleccionado (${hitoFechaInicio.toLocaleDateString()} - ${hitoFechaFin.toLocaleDateString()}).`,
                        });
                       
                        this.value = ''; // Limpiar el campo si no es válido
                    }
                };
                fechaInicioInput.addEventListener('change', fechaInicioHandler);

                // Validar la fecha de fin del objetivo
                fechaFinHandler = function () {
                    const fechaFin = new Date(this.value);
                    const fechaInicio = new Date(fechaInicioInput.value); // Obtener la fecha de inicio seleccionada

                    // Validar que la fecha de fin esté dentro del rango del hito
                    if (fechaFin < hitoFechaInicio || fechaFin > hitoFechaFin) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Fecha fuera de rango',
                            text: `La fecha de fin debe estar dentro del rango del hito seleccionado (${hitoFechaInicio.toLocaleDateString()} - ${hitoFechaFin.toLocaleDateString()}).`,
                        });
                        this.value = ''; // Limpiar el campo si no es válido
                    } else if (fechaFin < fechaInicio) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Fecha inválida',
                            text: `La fecha de fin no debe ser anterior a la fecha de inicio (${fechaInicio.toLocaleDateString()}).`,
                        });
                        this.value = ''; // Limpiar el campo si la fecha de fin es menor a la de inicio
                    }
                };
                fechaFinInput.addEventListener('change', fechaFinHandler);
            }
        });
    });
</script>


</body>

</html>

