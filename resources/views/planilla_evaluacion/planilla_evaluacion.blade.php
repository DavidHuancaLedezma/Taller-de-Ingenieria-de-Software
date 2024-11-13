<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Planilla de Evaluación</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f0f4f8;
            padding: 20px;
        }

        .container {
            max-width: 70%;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #3a8dbc;
            color: white;
            padding: 35px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }

        .form-container {
            padding: 20px;
        }

        .grid-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }
        /*select,button.grupo-empresa-btn {
            width: auto; 
            max-width: 100%; 
            padding: 8px 12px; 
        }*/


        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
            color: #333;
        }

        select, input[type="text"] {
            max-width: 80%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        .grupo-empresa-btn {
            max-width: 100%;
            padding: 8px;
            background-color: #eef6fb;
            color: #3a8dbc;
            border: 1px solid #3a8dbc;
            border-radius: 4px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
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
        .date-group {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px; 
    
        }
        input[type="date"] {
            color:rgba(80,80,80);
            width: calc(95% - 8px); /* Ajusta el ancho de los campos de fecha */
            margin-right: 2%;
        }
        #fecha-inicio-group {
            margin-left: -50px; /* Ajusta este valor según lo que necesites */
        }
        select:focus{
            border: 2px solid #3F9BBF; /* Cambia el color y grosor del borde */
            outline: none;
        }
        input[type="date"]:focus{
            border: 2px solid #3F9BBF; /* Cambia el color y grosor del borde */
            outline: none; 
        }   
        .evaluation-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        .evaluation-table th,
        .evaluation-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        .evaluation-table th {
            background-color: #f5f5f5;
            font-weight: bold;
        }

        .add-evaluation-btn {
            background-color: #3a8dbc;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .create-btn {
            width: 20%;
            background-color: #3a8dbc;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            display: block;
            margin: 0 auto;
        }
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            align-items: center;
            justify-content: center;
        }

        /* Estilos específicos para el modal de Asignar Grupo Empresa */

        .modal-content {
            background-color: #fff;
            color: rgb(0, 0, 0);
            padding: 20px;
            border-radius: 8px;
            width: 250px;
            text-align: left;
        }

        /*.modal-content h3 {
            margin-bottom: 15px;
            font-size: 18px;
            color: #000;
        }*/
        .header_2 {
            background-color: #3a8dbc;
            color: white;
            padding: 8px;
            text-align: center;
            font-size: 18px;
            margin-bottom: 15px;
            border-radius: 8px 8px 0 0;
        }

        .modal-content input[type="checkbox"] {
            margin-right: 8px;
        }

        .modal-content label {
            display: block;
            font-size: 14px;
            color: #000;
            background-color: #fff;
            margin: 5px 0;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            text-align: left;
        }

        .modal-content .close-btn {
            background-color: #5aadd1;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }

        .close-btn {
            background-color: #3a8dbc;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .grid-container {
                grid-template-columns: 1fr;
            }
        }
        /* Estilos específicos para el modal de criterios */

        .criteria-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }

        .criteria-modal-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            /*width: 400px;*/
            width: 600px;
            max-width: 90%;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .criteria-section {
            padding: 20px;
        }

        .criteria-header {
            background-color: #3a8dbc;
            color: white;
            padding: 15px 20px;
            font-size: 18px;
            border-radius: 8px 8px 0 0;
        }

       /* .criteria-group {
            margin-bottom: 20px;
        }*/

        /*.criteria-item {
            display: flex;
            align-items: center;
            margin: 10px 0;
            padding: 8px;
            cursor: pointer;
        }*/
        .criteria-group, .criteria-group_2 {
        display: grid;
        grid-template-columns: repeat(3, 1fr); /* Crear exactamente 6 columnas */
        gap: 10px;
        margin-bottom: 20px;
    }

    .criteria-item {
        display: flex;
        align-items: center;
        padding: 8px;
        cursor: pointer;
        border: 1px solid #ddd;
        border-radius: 4px;
        transition: background-color 0.2s ease;
    }
    
        .criteria-item:hover {
            background-color: #f5f5f5;
        }

        .radio-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }
       
        .divider {
            height: 1px;
            background-color: #ddd;
            margin: 20px 0;
        }

        .score-input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-top: 10px;
        }
        .score-input:focus{
            border: 2px solid #3F9BBF; /* Cambia el color y grosor del borde */
            outline: none;
        }

        .add-btn {
            width: 20%;
            background-color: #3a8dbc;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            margin-top: 15px;
        }

        .add-btn:hover {
            background-color: #2d7aa3;
        }
        .add-evaluation-btn {
            background-color: #3a8dbc;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            margin-bottom: 15px;
        }
        .delete-btn {
            background-color: #ff4c4c;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        @media (max-width: 768px) {
            .criteria-group, .criteria-group_2 {
                display: grid;
                grid-template-columns: repeat(2, 1fr); /* Crear exactamente 6 columnas */
                gap: 10px;
                margin-bottom: 20px;
            }
        }

    .info-icon {
        margin-left: 8px;
        color: #007bff;
        cursor: pointer;
        position: relative;
    }

    /* Contenedor del tooltip */
    .tooltip-container {
        position: relative;
        display: inline-block;
    }

    /* Tooltip personalizado */
    .custom-tooltip {
        visibility: hidden;
        background-color: #333;
        color: #fff;
        text-align: center;
        padding: 8px;
        border-radius: 5px;
        position: absolute;
        bottom: 125%; /* Ajusta según el tamaño deseado */
        left: 50%;
        transform: translateX(-50%);
        width: 200px; /* Ajusta el ancho de la cajita */
        z-index: 1;
        opacity: 0;
        transition: opacity 0.3s;
        font-size: 0.875em;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    /* Triángulo del tooltip */
    .custom-tooltip::after {
        content: "";
        position: absolute;
        top: 100%;
        left: 50%;
        transform: translateX(-50%);
        border-width: 5px;
        border-style: solid;
        border-color: #333 transparent transparent transparent;
    }

    /* Mostrar el tooltip al pasar el mouse sobre el icono */
    .tooltip-container:hover .custom-tooltip {
        visibility: visible;
        opacity: 1;
    }
</style>

    
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Planilla de evaluación</h1>
        </div>
        <div class="form-container">
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
           
            <form action="{{ route('planilla_evaluacion.store') }}" method="POST">
                @csrf
                <input type="hidden" name="docente_id" value="{{ $idDocente }}">
                <div class="grid-container">
                    <!-- Left Column -->
                    <div>
                        <div class="form-group">
                            <label>Seleccione tipo de evaluación</label>

                            <select name="tipo_evaluacion" id="tipo_evaluacion" required onchange="loadEmpresasPorEvaluacion()">
                                <option value="">-- Selecciona tipo de evaluación --</option>
                                @foreach($tipos_evaluacion as $tipo_evaluacion)
                                    <option value="{{ $tipo_evaluacion->id_tipo_evaluacion }}">{{$tipo_evaluacion->tipo_evaluacion }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                    </div>

                    <!-- Right Column -->
                    <div>
                        <div class="form-group">
                            <label>Asignar a Grupo Empresa</label>
                            <button type="button" class="grupo-empresa-btn" onclick="showAssignModal()">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                                Todas las grupo empresa
                            </button>
                        </div>
                       
                    </div>
                        <!-- Modal Asignar Grupo Empresa -->
                    <div id="assignModal" class="modal">
                        <div class="modal-content">
                            <div class="header_2">
                            <h3>Asigna a:</h3>
                            </div>
                            <div id="warningMessage" style="color: red; display: block;">Por favor, seleccione un tipo de evaluación.</div>
                            <div id="vacioMessage" style="color: red; display: none;">No hay grupo empresas para asignar.</div>

                            <!-- Generar checkboxes dinámicamente para cada grupo empresa -->
                            <div id="checkboxContainer"></div>
                            <button class="close-btn" onclick="closeAssignModal()">Listo</button>
                        </div>
                    </div>
                </div>
                   
                <!-- Fecha de inicio y fin -->
                <div class="date-group">
                    <div id="fecha-inicio-group">
                        <h5>Fecha Inicio</h5>
                        <input type="date"  id="fecha_inicio" name="fecha_inicio" value="{{ old('fecha_inicio') }}" required>
                    </div>
                    <div>
                        <h5>Fecha Fin</h5>
                        <input type="date" id="fecha_fin" name="fecha_fin" value="{{ old('fecha_fin') }}" required>
                    </div>
                </div>
                <button type="button" class="add-evaluation-btn" onclick="showCriteriaModal()">Añadir evaluación +</button>
               
                <div id="error-message" style="display: none; color: red;">
                    No puedes agregar más criterios de evaluación, el puntaje máximo de 100 ha sido alcanzado.
                </div>
                <table class="evaluation-table">
                    <thead>
                        <tr>
                            <th>Criterio de evaluación</th>
                            <th>Parámetro de evaluación</th>
                            <th>Puntaje</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody id="evaluation-table-body">
                        <tr>

                        </tr>
                    </tbody>
                </table>

                <button type="submit" class="create-btn">Crear</button>
            </form>
        </div>
    </div>




    <!-- Modal de Criterios y Parámetros -->
    <div id="criteriaModal" class="criteria-modal">
        <div class="criteria-modal-content">
            <div class="criteria-section">
            <div class="criteria-header">
                Criterio de evaluación
            </div>
            <div class="criteria-group">
                @foreach($criterios_evaluacion as $criterio)
                    <div class="radio-container criteria-item">
                        <input type="radio" name="criteria" id="criteria_{{ $criterio->id_criterio_evaluacion }}" value="{{ $criterio->evaluacion }}">
                        <label for="criteria_{{ $criterio->id_criterio_evaluacion }}">{{ $criterio->evaluacion }}</label>
                        <!-- Icono de interrogación con tooltip -->
                        <div class="tooltip-container">
                            <i class="bi bi-question-circle-fill info-icon"></i>
                            <span class="custom-tooltip">{{ $criterio->descripcion_evaluacion }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
                <div class="divider"></div>

                <div class="criteria-header">
                    Parámetro de evaluación
                </div>
                <div class="criteria-group_2">
                    @foreach($parametros as $parametro)
                        <div class="radio-container criteria-item">
                         <input type="radio" name="parameter" id="parameter_{{ $parametro->id_parametro }}" value="{{ $parametro->nombre_parametro }}">
                            <label for="parameter_{{ $parametro->id_parametro }}">{{ $parametro->nombre_parametro }}</label>
                            
                            <!-- Icono de interrogación con tooltip personalizado para parámetros -->
                            <div class="tooltip-container">
                                <i class="bi bi-question-circle-fill info-icon"></i>
                                <span class="custom-tooltip">
                                    @foreach($escalas as $escala)
                                        @if($escala->id_parametro == $parametro->id_parametro)
                                            <p>{{ $escala->escala_cualitativa ?? 'N/A' }} ----> {{ $escala->escala_cuantitativa ?? 'N/A' }}</p>
                                        @endif
                                    @endforeach
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="divider"></div>

                <div>
                    <label>Puntaje de evaluación</label>
                    <input type="number" name="score" class="score-input" placeholder="Ingrese el puntaje" min="0" max="100" oninput="this.value = Math.min(Math.max(this.value, 0), 100)">
                </div>

                <button class="add-btn">Añadir</button>
            </div>
        </div>
    </div>

    <script>
        let totalScore = 0; // Puntaje total acumulado
        const maxScore = 100; // Puntaje máximo permitido
        // Funcionalidad para el modal de criterios
        const criteriaModal = document.getElementById('criteriaModal');
        const addEvaluationBtn = document.querySelector('.add-evaluation-btn');
        const addBtn = document.querySelector('.add-btn');
        const errorMessage = document.getElementById('error-message'); // Elemento para mensaje de error
        // Abrir modal de criterios
        addEvaluationBtn.addEventListener('click', () => {
            criteriaModal.style.display = 'block';
        });

        // Cerrar modal de criterios
        window.addEventListener('click', (event) => {
            if (event.target === criteriaModal) {
                criteriaModal.style.display = 'none';
            }
        });
        // Añadir evaluación
        addBtn.addEventListener('click', () => {
            const selectedCriteria = document.querySelector('input[name="criteria"]:checked');
            const selectedParameter = document.querySelector('input[name="parameter"]:checked');
            //const score = document.querySelector('.score-input').value;
            const scoreInput = document.querySelector('.score-input');
            const score = parseInt(scoreInput.value); // Convertir puntaje a número

            if (selectedCriteria && selectedParameter && score) {
                  // Verificar que el puntaje no exceda el máximo permitido
                if (totalScore + score > maxScore) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Puntaje Excedido',
                        text: `El puntaje excede el máximo permitido (${maxScore}), puntaje actual: ${totalScore} .`,
                    });
                    return; // Detiene la ejecución
                }
                const evaluationText = selectedCriteria.value; // Valor del criterio de evaluación
                const parameterText = selectedParameter.value; // Valor del parámetro de evaluación
                const idCriterio = selectedCriteria.id.split('_')[1]; // Extraer el ID de criterio
                const idParametro = selectedParameter.id.split('_')[1]; // Extraer el ID de parámetro


                // Obtener los criterios existentes en la tabla
                const existingCriteria = Array.from(document.querySelectorAll('.evaluation-table tbody tr td:first-child'))
                    .map(cell => cell.textContent.trim());

                // Verificar si el criterio ya está en la tabla
                if (existingCriteria.includes(evaluationText)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Criterio Duplicado',
                        text: 'Este criterio de evaluación ya se ha agregado.',
                    });
                    return; // Detiene la ejecución para evitar la duplicación
                }


                // Agregar una nueva fila a la tabla con los valores seleccionados
                const table = document.querySelector('.evaluation-table tbody');
                const newRow = table.insertRow();
                const rowIndex = table.rows.length; 
                newRow.innerHTML = `
                    <td>${evaluationText}
                    <input type="hidden" name="evaluaciones[${rowIndex}][id_criterio]" value="${idCriterio}">
                    </td>
                    <td>${parameterText}
                    <input type="hidden" name="evaluaciones[${rowIndex}][id_parametro]" value="${idParametro}">
                    </td>
                    <td>${score}
                    <input type="hidden" name="evaluaciones[${rowIndex}][score]" value="${score}">
                    </td>
                    <td><button type="button" class="delete-btn" onclick="deleteRow(this, ${score})">Eliminar</button></td>
                `;

                // Actualizar el puntaje total
                totalScore += score;

                // Ocultar botón de añadir evaluación si el puntaje es igual o mayor a 100
                if (totalScore >= maxScore) {
                    addEvaluationBtn.style.display = 'none';
                    errorMessage.style.display = 'block'; // Mostrar mensaje de error
                } else {
                    errorMessage.style.display = 'none'; // Ocultar mensaje de error si el puntaje es válido
                }
                 
                criteriaModal.style.display = 'none';
                
                // Limpiar selecciones
                selectedCriteria.checked = false;
                selectedParameter.checked = false;
                //document.querySelector('.score-input').value = '';
                scoreInput.value = '';
            }
        });
    </script>

   <script>
        function showAssignModal() {
            document.getElementById("assignModal").style.display = "flex";
        }

        function closeAssignModal() {
            document.getElementById("assignModal").style.display = "none";
        }

        function showCriteriaModal() {
            document.getElementById("criteriaModal").style.display = "flex";
        }


        function closeCriteriaModal() {
            document.getElementById("criteriaModal").style.display = "none";
        }
     
        /*function deleteRow(button) {
            const row = button.parentNode.parentNode;
            row.remove();
        }*/
        // Eliminar fila y actualizar puntaje
        function deleteRow(button, score) {
            const row = button.parentNode.parentNode;
            row.remove();
            totalScore -= score; // Restar el puntaje eliminado

            // Reactivar botón de añadir evaluación si el puntaje es menor a 100
            if (totalScore < maxScore) {
                addEvaluationBtn.style.display = 'block';
                errorMessage.style.display = 'none'; // Ocultar mensaje de error
            }

         }



        function toggleAllCheckboxes(source) {
            const checkboxes = document.querySelectorAll('.group-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = source.checked;
            });
        }
    </script>
        <script>
        // Obtener la fecha de hoy en formato YYYY-MM-DD
        const today = new Date().toISOString().split("T")[0];

      // Obtener los elementos de fecha inicio y fecha fin
        const fechaInicioInput = document.getElementById("fecha_inicio");
        const fechaFinInput = document.getElementById("fecha_fin");

        // Establecer el mínimo de la fecha de inicio y fecha fin en la fecha actual
        fechaInicioInput.setAttribute("min", today);
        fechaFinInput.setAttribute("min", today);

        fechaInicioInput.addEventListener("change", validarFechas);
        fechaFinInput.addEventListener("change", validarFechas);
        // Añadir eventos change para validar cada vez que cambie una fecha
        function validarFechas() {
            const fechaInicio = fechaInicioInput.value;
            const fechaFin = fechaFinInput.value;

            // Validar si la fecha de inicio es anterior a hoy
            if (fechaInicio && fechaInicio < today) {
                Swal.fire({
                    icon: 'error',
                    title: 'Fecha de inicio inválida',
                    text: 'La fecha de inicio no puede ser anterior a la fecha actual.',
                });
                fechaInicioInput.value = ""; // Limpia el campo de fecha inicio
                return;
            }

            // Actualizar la fecha mínima de fecha fin basada en fecha inicio
            if (fechaInicio) {
                fechaFinInput.setAttribute("min", fechaInicio);
            } else {
                // Restablecer el mínimo de fecha fin a la fecha de hoy si no hay fecha de inicio
                fechaFinInput.setAttribute("min", today);
            }

            // Validar si la fecha de fin es menor que la fecha de inicio
            if (fechaInicio && fechaFin && fechaFin < fechaInicio) {
                Swal.fire({
                    icon: 'error',
                    title: 'Fechas inválidas',
                    text: 'La fecha de fin no puede ser anterior a la fecha de inicio.',
                });
                fechaFinInput.value = ""; // Limpia el campo de fecha fin
            }
        }
        </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
    <script>
    function loadEmpresasPorEvaluacion() {
        const tipoEvaluacionId = document.getElementById('tipo_evaluacion').value;
        const id_docente = document.querySelector('input[name="docente_id"]').value; // Obtener el ID del docente desde el input hidden

        if (tipoEvaluacionId) {
            warningMessage.style.display = 'none';
            fetch(`/get-empresas-por-evaluacion/${tipoEvaluacionId}/${id_docente}`)
                .then(response => response.json())
                .then(data => {
                    if (data.empresas && data.empresas.length > 0) {
                        // Si hay empresas, mostrar los checkboxes
                        let modalContent = '<input type="checkbox" id="allGroups" onclick="toggleAllCheckboxes(this)"> Todas las grupo empresa<br>';

                        data.empresas.forEach(empresa => {
                            modalContent += `
                                <input type="checkbox" class="group-checkbox" name="grupoEmpresas[]" value="${empresa.id_grupo_empresa}">
                                ${empresa.nombre_corto}<br>
                            `;
                        });
                        vacioMessage.style.display = 'none';
                        checkboxContainer.innerHTML = modalContent; // Agregar los checkboxes al contenedor
                        allGroupsCheckbox.style.display = 'inline'; // Mostrar checkbox "Todas las grupo empresa"
                    } else {
                        // Si no hay empresas, mostrar el mensaje
                        vacioMessage.style.display = 'block'; // Mostrar el mensaje de "Grupo empresas para asignar"
                        checkboxContainer.innerHTML = ''; // Limpiar cualquier checkbox previo
                        allGroupsCheckbox.style.display = 'none'; // Ocultar el checkbox "Todas las grupo empresa"
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    }
    
</script>


</body>
</html>