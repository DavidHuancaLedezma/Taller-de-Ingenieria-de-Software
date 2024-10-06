<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración de Hitos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #D2D6DE;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 40px auto;
            padding: 20px;
            background-color: #f9f5ed;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            font-family: 'Arial', sans-serif;
            color: #ffffff;
            background-color: #367FA9 ; 
            width: 100% ; 
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #ddd;
        }
        .progress-button {
            background-color: #cbe6e3;
            border: none;
            border-radius: 20px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 14px;
            color: #333;
        }
        .progress-button:hover {
            background-color: #b8d9d4;
        }
        .progress-button-filled {
            background-color: #aed5c6;
        }
        .progress-20 {
            width: 60px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Administración de hitos de EliteSoft</h1>
        
        <table>
            <thead>
                <th>HITO</th>
                <th>FECHA INICIO</th>
                <th>FECHA FIN</th>
                <th>SEGUIMIENTO SEMANAL</th>
            </thead>
            <tr>
                <td>Hito 1</td>
                <td>2024-10-19</td>
                <td>2024-10-19</td>
                <td><button class="progress-button">Seguimiento</button></td>
            </tr>
            <tr>
                <td>Hito 2</td>
                <td>2024-10-19</td>
                <td>2024-10-19</td>
                <td><button class="progress-button">Seguimiento</button></td>
            </tr>
            <tr>
                <td>Hito 3</td>
                <td>2024-10-19</td>
                <td>2024-10-19</td>
                <td><button class="progress-button">Seguimiento</button></td>
            </tr>
            <tr>
                <td>Hito 4</td>
                <td>2024-10-19</td>
                <td>2024-10-19</td>
                <td><button class="progress-button">Seguimiento</button></td>
            </tr>
            <tr>
                <td>Hito 5</td>
                <td>2024-10-19</td>
                <td>2024-10-19</td>
                <td><button class="progress-button">Seguimiento</button></td>
            </tr>
        </table>
    </div>
</body>
</html>