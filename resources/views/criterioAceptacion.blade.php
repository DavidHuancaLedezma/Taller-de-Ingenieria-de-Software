<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Evaluaciones Semanales</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
            width: 80%;
            margin: 50px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
            padding: 10px;
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
                
                .btn-aceptar:hover {
                    background-color: #118CD9;
                    color: white;
                    
                }
                .error-message {
                    color: red;
                    font-size: 0.9em;
                    margin-top: s5px;
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

    </style>
</head>
<body>
    <div class="container">
        <div class="header">
        <h2 class="titulo-objetivo">Entregable:</h2>
            <h1>{{ $objetivo->descrip_objetivo ?? 'Descripción no disponible' }}</h1>
        </div>
        @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
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
        <br>
        <form action="process.php" method="post">
            <button type="button" id="add-criteria" class="tab-button">Criterios de Aceptación +</button>
           
            <table class="table">
                <thead>
                    <tr>
                        <th>Descripción de criterio de aceptación</th>
                    </tr>
                </thead>
                <tbody id="activityTable">
                    @foreach($criterios_aceptacion as $criterio)
                    <tr>
                        <td>{{ $criterio->descripcion_ca }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
 
        </form>

    </div>

   
    <!-- Formulario emergente para Criterio de Aceptación -->
    <div id="popupCriteriaForm" class="popup-form" style="display: none;">
        <div class="contenedor-mini-formulario">
            <header class="header-mini-formulario">
                <h1 class="h1-mini-formulario">Criterio de aceptación</h1>
            </header>
            <main class="main-mini-formulario">
                <form id="criteriaForm" action="{{ route('criterio_aceptacion.store') }}" method="POST">
                    @csrf <!-- Incluye el token CSRF -->
                    <input type="hidden" name="objetivo_id" value="{{ $objetivo->id_objetivo }}">
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
    // Obtener elementos del DOM
       
        const popupCriteriaForm = document.getElementById('popupCriteriaForm');
        const addCriteriaBtn = document.getElementById('add-criteria');
        const cancelCriteriaBtn = document.getElementById('cancelCriteria');
        const criteriaForm = document.getElementById('criteriaForm');


        // Mostrar el formulario emergente para Criterio de Aceptación
        addCriteriaBtn.addEventListener('click', function (e) {
            e.preventDefault(); // Prevenir la acción por defecto
            popupCriteriaForm.style.display = 'flex'; // Mostrar el formulario
        });

        // Cerrar formulario de Criterio de Aceptación
        cancelCriteriaBtn.addEventListener('click', function () {
            popupCriteriaForm.style.display = 'none'; // Ocultar el formulario
        });

          // Función para contar caracteres especiales y números
        function countSpecialCharsAndNumbers(str) {
            const regex = /[0-9!@#$%^&*(),.?":{}/|<>]/g; // Carácteres especiales y números
            const matches = str.match(regex);
            return matches ? matches.length : 0;
        }

        // Validar el formulario de Criterio de Aceptación antes de enviar
        criteriaForm.addEventListener('submit', function (e) {
            let isValid = true;

            const descripcionCriterio = document.getElementById('descripcionCriterio').value.trim();

            if (descripcionCriterio === '') {
                document.getElementById('descripcionCriterioError').textContent = 'La descripción del criterio de aceptación es obligatoria.';
                isValid = false;
            } else if (descripcionCriterio.length < 20) {
                document.getElementById('descripcionCriterioError').textContent = 'La descripción debe tener más de 20 caracteres.';
                isValid = false;
            } else if (descripcionCriterio.length > 500) {
                document.getElementById('descripcionCriterioError').textContent = 'La descripción no puede exceder los 500 caracteres.';
                isValid = false;
            } else if (countSpecialCharsAndNumbers(descripcionCriterio) > 10) {
                document.getElementById('descripcionCriterioError').textContent = 'La descripción no puede contener más de 10 caracteres especiales o números.';
                isValid = false;
            } else if (/^[0-9]+$/.test(descripcionCriterio) || /^[^a-zA-Z0-9]+$/.test(descripcionCriterio)) {
                document.getElementById('descripcionCriterioError').textContent = 'La descripción no puede contener solo números o caracteres especiales.';
                isValid = false;
            } else {
                document.getElementById('descripcionCriterioError').textContent = '';
            }

            if (!isValid) {
                e.preventDefault(); // Prevenir el envío del formulario si hay errores
            }
        });

        // Eliminar el mensaje de error al hacer clic en el campo
        document.getElementById('descripcionCriterio').addEventListener('focus', function () {
            document.getElementById('descripcionCriterioError').textContent = '';
        });
    </script>

 </body>


</html>
