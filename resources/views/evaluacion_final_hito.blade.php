<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Semanal</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
                * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            color: #333;
        }

        .container {
            width: 70%;
            margin: 30px auto;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 20px;
        }

        header {
            background-color: #40759e;
            color: white;
            text-align: center;
            padding: 20px;
            border-radius: 10px 10px 0 0;
        }

        header h1 {
            font-size: 24px;
        }

        header h2 {
            font-size: 18px;
            margin-top: 10px;
        }

        .progress-section {
            margin: 30px 0;
            
        }

        .progress-bar {
            display: flex;
           /* justify-content: space-between;*/
           gap: 5px;
           justify-content: center; 
        }

        .progress {
            width: 10%;
            height: 35px;
            background-color: #d0e7f5;
            border-radius: 5px;
        }

        .completed {
            background-color: #89c2d9;
        }

        .ongoing {
            background-color: #a9d6e5;
        }

        .not-completed {
            background-color: #e63946;
        }
        

        .main-content {
            display: flex;
            justify-content: space-between;
        }

        .attendance, .description {
            width: 48%;
        }

        .attendance h3, .description h3 {
            background-color: #40759e;
            color: white;
            padding: 10px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }

        .attendance ul {
            list-style: none;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 0 0 5px 5px;
        }

        .attendance ul li {
            margin: 10px 0;
            display: flex;
            justify-content: space-between;
        }
        .description textarea {
            width: 100%;
            height: 100px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 0 0 5px 5px;
        }

        .objectives-section {
            margin-top: 20px;
        }

        .objectives-section table {
            width: 100%;
            border-collapse: collapse;
        }

        .objectives-section th, .objectives-section td {
            padding: 15px;
            text-align: left;
            border: 1px solid #ccc;
        }

        .objectives-section th {
            background-color: #f2f2f2;
        }

        button {
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button.yes {
            background-color: #89c2d9;
            color: white;
        }

        button.no {
            background-color: #e63946;
            color: white;
        }
        .submit-section {
            text-align: center;
            margin-top: 20px;
        }

        button.save {
            width: 20%;
            background-color: #40759e;
            color: white;
            padding: 15px;
            font-size: 16px;
            margin-top: 20px;
            border-radius: 5px;
            
        }
        h6{
            padding: 7px;
            text-align: center;
            color: white;
        }
        .custom-link {
            color: #3498db; /* Cambia el color del enlace */
            text-decoration: none; /* Elimina el subrayado */
        }

        .custom-link:hover {
            color: #2c3e50; /* Cambia el color cuando pasas el cursor sobre el enlace */
            text-decoration: underline; /* Opcional: muestra subrayado al pasar el cursor */
        }
        textarea:focus {
            border: 2px solid #3F9BBF; /* Cambia el color y grosor del borde */
            outline: none; /* Elimina el borde azul por defecto */
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Registro semanal {{$nombreCorto}}</h1>
            <h2>Evaluación final de Hito {{ $numeroDeHito ?? 'hito no disponible' }}</h2>
        </header>
        <section class="progress-section">
            <div class="progress-bar">
                <div class="progress completed">
                    <h6>semana 1</h6>
                </div>
                <div class="progress ongoing">
                    <h6>Semana 2</h6>
                </div>
                <div class="progress completed">
                    <h6>Semana 3</h6>
                </div>
                <div class="progress not-completed">
                    <h6>Semana fin</h6>
                </div>
            </div>
        </section>
        <section class="main-content">
            <div class="attendance">
                <h3>Asistencia</h3>
                <ul>
                    @foreach ($estudianteEnAlerta as $estudiante)
                        <li @if($estudiante[1] >= 3) style="color:red;" @endif>
                            {{$estudiante[0]}} 
                            <input name="asistencia[]" value="{{$estudiante[2]}}" type="checkbox" class="asistencia" @if($estudiante[2]) checked @endif>
                        </li>
                    @endforeach
                </ul>   
            </div>
            @if ($mostrarMensaje)
                <h2 class="Mensaje-de-semana-registrada" style="color: red">Esta semana ya fue registrada</h2>
            @endif 
            <div class="description">
                <h3>Descripción</h3>
                <textarea placeholder="Escribe descripción"></textarea>
                <span id="descripcionError" class="error-message"></span>
            </div>
        </section>
        <section class="objectives-section">
            <table>
                <thead>
                    <tr>
                        <th>Entregables</th>
                        <th>Criterios de aceptación</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Objetivo 1 -->
                    <tr>
                        <td>Entregable 1</td>
                        <td>
                            <table class="nested-table">
                                
                                <tr>
                                    <td>criterio 1 de objetivo 1</td>
                                    <td>
                                        <button class="yes">Sí</button>
                                        <button class="no">No</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>criterio 2 de objetivo 1</td>
                                    <td>
                                        <button class="yes">Sí</button>
                                        <button class="no">No</button>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <!-- Objetivo 2 -->
                    <tr>
                        <td>Entregable 2</td>
                        <td>
                            <table class="nested-table">
                                <tr>
                                    <td>criterio 1 de objetivo 2</td>
                                    <td>
                                        <button class="yes">Sí</button>
                                        <button class="no">No</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>criterio 2 de objetivo 2</td>
                                    <td>
                                        <button class="yes">Sí</button>
                                        <button class="no">No</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>criterio 3 de objetivo 2</td>
                                    <td>
                                        <button class="yes">Sí</button>
                                        <button class="no">No</button>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </tbody>

            </table>
        </section>
        <div class="submit-section">
            <button class="save">Guardar <i class="bi bi-rocket-takeoff-fill"></i></button>
        </div>
    </div>
</body>
</html>
