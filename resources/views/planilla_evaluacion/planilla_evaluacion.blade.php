<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planilla de Evaluación</title>
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
            width: 100%;
            background-color: #3a8dbc;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
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
            width: 400px;
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

        .criteria-group {
            margin-bottom: 20px;
        }

        .criteria-item {
            display: flex;
            align-items: center;
            margin: 10px 0;
            padding: 8px;
            cursor: pointer;
        }

        .criteria-item:hover {
            background-color: #f5f5f5;
        }

        .radio-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .radio-container input[type="radio"] {
            margin: 0;
        }

        .info-icon {
            color: #3a8dbc;
            margin-left: auto;
            cursor: help;
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

        .add-btn {
            width: 100%;
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

    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Planilla de evaluación</h1>
        </div>
        <div class="form-container">
            <form>
                <div class="grid-container">
                    <!-- Left Column -->
                    <div>
                        <div class="form-group">
                            <label>Seleccione tipo de evaluación</label>

                            <select name="tipo_evaluacion" id="tipo_evaluacion" required>
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
                </div>
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

                <button type="button" class="add-evaluation-btn" onclick="showCriteriaModal()">Añadir evaluación +</button>
                <button type="submit" class="create-btn">Crear</button>
            </form>
        </div>
    </div>

    <!-- Modal Asignar Grupo Empresa -->
    <div id="assignModal" class="modal">
        <div class="modal-content">
            <div class="header_2">
            <h3>Asigna a:</h3>
            </div>
            <!-- Checkbox para seleccionar todas las grupo empresa -->
            <input type="checkbox" id="allGroups" onclick="toggleAllCheckboxes(this)"> Todas las grupo empresa<br>

            <!-- Generar checkboxes dinámicamente para cada grupo empresa -->
            @foreach($grupoEmpresas as $grupoEmpresa)
                <input type="checkbox" class="group-checkbox" name="grupoEmpresas[]" 
                    value="{{ $grupoEmpresa->id_grupo_empresa }}">
                {{ $grupoEmpresa->nombre_corto }}<br>
            @endforeach

            <button class="close-btn" onclick="closeAssignModal()">Listo</button>
        </div>
    </div>


    <!-- Modal de Criterios y Parámetros -->
    <div id="criteriaModal" class="criteria-modal">
        <div class="criteria-modal-content">
            <div class="criteria-header">
                Criterio de evaluación
            </div>
            <div class="criteria-section">
                <div class="criteria-group">
                    <div class="radio-container criteria-item">
                        <input type="radio" name="criteria" id="puntualidad" value="puntualidad">
                        <label for="puntualidad">Puntualidad</label>
                        <span class="info-icon">?</span>
                    </div>
                    <div class="radio-container criteria-item">
                        <input type="radio" name="criteria" id="comunicacion" value="comunicacion">
                        <label for="comunicacion">Comunicación</label>
                        <span class="info-icon">?</span>
                    </div>
                    <div class="radio-container criteria-item">
                        <input type="radio" name="criteria" id="colaboracion" value="colaboracion">
                        <label for="colaboracion">Colaboración</label>
                        <span class="info-icon">?</span>
                    </div>
                    <div class="radio-container criteria-item">
                        <input type="radio" name="criteria" id="trabajo" value="trabajo">
                        <label for="trabajo">Trabajo Colaborativo</label>
                        <span class="info-icon">?</span>
                    </div>
                </div>

                <div class="divider"></div>

                <div class="criteria-header">
                    Parámetro de evaluación
                </div>
                <div class="criteria-group">
                    <div class="radio-container criteria-item">
                        <input type="radio" name="parameter" id="likert" value="likert">
                        <label for="likert">Likert</label>
                        <span class="info-icon">?</span>
                    </div>
                    <div class="radio-container criteria-item">
                        <input type="radio" name="parameter" id="binaria" value="binaria">
                        <label for="binaria">Elección binaria</label>
                        <span class="info-icon">?</span>
                    </div>
                    <div class="radio-container criteria-item">
                        <input type="radio" name="parameter" id="categoria" value="categoria">
                        <label for="categoria">Categoría</label>
                        <span class="info-icon">?</span>
                    </div>
                    <div class="radio-container criteria-item">
                        <input type="radio" name="parameter" id="frecuencia" value="frecuencia">
                        <label for="frecuencia">Escala de frecuencia</label>
                        <span class="info-icon">?</span>
                    </div>
                    <div class="radio-container criteria-item">
                        <input type="radio" name="parameter" id="deslizante" value="deslizante">
                        <label for="deslizante">Escala deslizante</label>
                        <span class="info-icon">?</span>
                    </div>
                </div>

                <div class="divider"></div>

                <div>
                    <label>Puntaje de evaluación</label>
                    <input type="number" class="score-input" placeholder="Ingrese el puntaje">
                </div>

                <button class="add-btn">Añadir</button>
            </div>
        </div>
    </div>

    <script>
        // Funcionalidad para el modal de criterios
        const criteriaModal = document.getElementById('criteriaModal');
        const addEvaluationBtn = document.querySelector('.add-evaluation-btn');
        const addBtn = document.querySelector('.add-btn');

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
            const score = document.querySelector('.score-input').value;

            if (selectedCriteria && selectedParameter && score) {
                const table = document.querySelector('.evaluation-table tbody');
                const newRow = table.insertRow();
                newRow.innerHTML = `
                    <td>${selectedCriteria.parentElement.textContent.trim()}</td>
                    <td>${selectedParameter.parentElement.textContent.trim()}</td>
                    <td>${score}</td>
                    <td><button type="button" class="delete-btn" onclick="deleteRow(this)">Eliminar</button></td>
                `;
                criteriaModal.style.display = 'none';

                // Limpiar selecciones
                selectedCriteria.checked = false;
                selectedParameter.checked = false;
                document.querySelector('.score-input').value = '';
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
        function deleteRow(button) {
            const row = button.parentNode.parentNode;
            row.remove();
        }
        
        function toggleAllCheckboxes(source) {
            const checkboxes = document.querySelectorAll('.group-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = source.checked;
            });
        }

    </script>
</body>
</html>