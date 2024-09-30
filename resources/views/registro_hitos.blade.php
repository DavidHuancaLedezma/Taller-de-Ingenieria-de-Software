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
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
}
.header_2 {
    background-color: #4682b4;
    padding: 3px;
    border-top-left-radius: 2px;
    border-top-right-radius: 2px;
}
.h3{
    padding: 50px;
}
.tabs {
    display: flex;
    justify-content: space-between;
    padding: 10px 0;
}

.tab-button {
    background-color: #4682b4;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
}

.table {
    width: 80%;
    border-collapse: collapse;
    margin-top: 20px;
    margin: 0 auto; /* Centra la tabla horizontalmente */
}

.table th, .table td {
    border: 1px solid #ddd;
    padding: 12px;
    text-align: center;
}

.table th {
    background-color: #f2f2f2;
}

/* Estilos específicos para los inputs */
input[type="text"], input[type="date"] {
    background-color: rgba(150, 150, 150, 0.3); /* Color plomo más suave */
            /*background-color: white;*/
    color:black;
    border: 1px solid rgba(100, 100, 100, 0.5);
    border-radius: 4px;
    padding: 5px;
    font-size: 16px;
    margin-bottom: 10px;
    width: calc(100%); /* Ajusta el ancho considerando el padding */
    box-sizing: border-box; /* Asegura que el padding no se agregue al tamaño total del input */
            
}
 /* Estilo para los campos de fecha */
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
.submit-btn:hover {
    background-color: #5a9bd4;
}
input[type="text"]:focus {
    border: 2px solid #3F9BBF; /* Cambia el color y grosor del borde */
    outline: none; /* Elimina el borde azul por defecto */
} 
input[type="date"]:focus{
    border: 2px solid #3F9BBF; /* Cambia el color y grosor del borde */
    outline: none; 
}     
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Registro de Hitos</h1>
        </div>
        <br>
        <form action="process.php" method="post">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre Hito</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>(%) Cobro</th>
                    </tr>
                </thead>
                <tbody id="activityTable">
                    <!-- Las actividades se agregarán aquí dinámicamente -->
                </tbody>
            </table>
            <br>
            <h3>Añadir nuevo Hito</h3>
            <div class="header_2">
            </div>
            <br>
            <div class="date-group">
                <div>
                    <h5>Fecha Inicio</h5>
                    <input type="date">
                </div>
                <div>
                    <h5>Fecha Fin</h5>
                    <input type="date">
                </div>
                <div>
                    <h5>Porcentaje de Cobro % </h5>
                   <input type="text" placeholder="Porcentaje de cobro %">
                </div>
            </div>
            <button id="addHitoBtn" class="tab-button">Añadir Hito <i class="bi bi-rocket-takeoff-fill"></i></button>

        </form>
    </div>

    <script src="script.js"></script>
</body>
</html>
