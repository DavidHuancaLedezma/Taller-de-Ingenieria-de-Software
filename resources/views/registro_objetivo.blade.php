<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro objetivo</title>

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

    </style>
</head>
<body>
    <div class="background"></div>
    <div class="content">
        <div class="container">
            <h1>Registro de Planificación</h1>
            <h5>Objetivo</h5>
            <input type="text" placeholder="Escribe tu objetivo" required>
            <div class="select_priori_group">
            <div>
            <h5>Seleccione Hito</h5>
            <select name="hito">
                <option value="hito1">hito1</option>
                <option value="hito2">hito2</option>
                <option value="hito3">hito3</option>
            </select>
            </div>
            <div>
            <h5>Prioridad</h5>
            <div class="radio-group"> 

                <label class="custom-radio">
                <input type="radio" name="Prioridad" />
                <span class="radio-mark"></span> Alta
                </label>
                <label class="custom-radio">
                    <input type="radio" name="Prioridad" />
                    <span class="radio-mark"></span> Media
                </label>
                <label class="custom-radio">
                    <input type="radio" name="Prioridad" />
                    <span class="radio-mark"></span> Baja
                </label>

            </div>
            </div>
            </div>
            <div class="date-group">
                <div>
                    <h5>Fecha Inicio</h5>
                    <input type="date">
                </div>
                <div>
                    <h5>Fecha Fin</h5>
                    <input type="date">
                </div>
            </div>
          
        </div>
    </div>
</body>
</html>

