<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Etapa</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
   
    
    <style>
 body, html {
    margin: 0;
    padding: 0;
    height: 100%;
    display: flex;
   
    justify-content: center;
    align-items: center;
    background-color: #f0f0f0; /* Fondo claro */
    font-family: Arial, sans-serif;
}

.image-container {
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px; /* Espacio inferior entre divs */
    margin-right: 30px;
}

.center-image {
    max-width: 100%;
    max-height: 100%;
    object-fit: cover;
    border-radius: 5px;
}

.content {
    background: rgba(0, 0, 0, 0.6);
    color: white;
    text-align: center;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.8);
    max-width: 570px; /* Limitar el ancho aún más en pantallas pequeñas */
    width: 90%;
}

.content p {
    font-size: 18px;
    
    text-align: left;
}
.content h4{
    color: aqua;
    font-size: 24px;
}
        .back_button {
            border-radius: 25px;
            border: none;
            position: absolute;
            left: 100px; /* Fijar el botón al lado izquierdo */
            top: 40px; /* Posición fija desde el top */
            padding: 10px 20px;
            cursor: pointer;
            color: white ; 
            background-color: #367FA9    
        }

        @media screen and (max-width: 768px) {
            body {
                flex-direction: column; /* Mostrar elementos en fila en pantallas grandes */
            }

            .image-container {
                margin-right: 30px; /* Espacio entre la imagen y el contenido */
                margin-bottom: 10px; /* Eliminar margen inferior en pantallas grandes */
                
                
            }
            .content{
                width: 75%;
            }
            .content h1{
                font-size: 24; /* Cambiar alineación del texto en pantallas grandes */
            }
                .content p {
                font-size: 12px;
                
                text-align: left;
            }
            .content h4{
                color: aqua;
                font-size: 14px;
            }
            .back_button {
                font-size: 12px;
                padding: 5px 10px;
                left: 5px;
                top: 5px;

            }

}
        
    </style>
</head>
<body>
    <input type="hidden" id="id_estudiante" value="{{ $id_estudiante }}">
    <button class="back_button" id="boton-home">Regreso al home <i class="fas fa-home"></i></button>
     <div class="image-container">
        <img src="https://media.istockphoto.com/id/1306949457/es/vector/personas-que-buscan-soluciones-creativas-concepto-de-negocio-de-trabajo-en-equipo.jpg?s=612x612&w=0&k=20&c=cLtPvrCcv0CJZ3R2HFB0eD8WtOifyhFS9VSKURnEkfc=" alt="Imagen centrada" class="center-image">
    </div>
    <div class="content">
        <h1>Etapa del proyecto</h1>
        @if ($fechas_etapa)
                <p>{{ $mensaje_inicio }}</p>
                <p><i class="bi bi-calendar-check-fill"></i>  <strong>Fecha inicio:</strong> {{ $fechas_etapa['inicio'] }}</p>
                <p><i class="bi bi-calendar-check-fill"></i>  <strong>Fecha fin:</strong> {{ $fechas_etapa['fin'] }}</p>
            @else
                <p>No hay una etapa activa en este momento.</p>
            @endif

            @if (isset($mensaje_error))
                <div class="alert alert-danger">
                    <h4>{{ $mensaje_error }}</h4>
                </div>
            @endif
    </div>
    <script>
        $("#boton-home").on("click", function () {
                    //Regresa al home del estudiante
        let idEstudiante = $('#id_estudiante').val();
                    
        window.location.href = `{{ url('/estudiante_home/${idEstudiante}') }}`;
    });

    </script>
</body>
</html>