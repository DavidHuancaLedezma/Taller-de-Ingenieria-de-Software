<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        html {
            height: 100%;
        }

        body {
            height: 100%;
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            background-color: rgb(255, 255, 255);
            align-content: center;
        }

        button {
            background-color: #357CA5;
            color: #ffffff;
            border: none;
            padding: 5px 10px;
        }

        .principal {
            height: 90%;
            width: 60%;
            gap: 10px;
            /border: 2px solid red;/
        }

        .primerContenedor,
        .segundoContenedor {
            width: 100%;
        }

        .primerContenedor {
            display: flex;
            flex-direction: column;
            /border: 2px solid red;/
            gap: 20px;
            padding-top: 20px;
            background-color: #D9D9D9;
            border-radius: 10px;
            margin-bottom: 10px;
        }

        .contenedorTitulo {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .contenedorObjetivos {
            display: flex;
            flex-direction: row;
            padding-left: 30px;
            gap: 200px;
        }

        .contenedorObjetivos .objetivos {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .contenedorObjetivos .buttons {
            display: flex;
            flex-direction: column;
            gap: 3px;

        }

        .segundoContenedor {
            height: 70%;
            display: flex;
            flex-direction: column;
            align-items: center;
            /border: 2px solid rgb(179, 255, 0);/
            padding-top: 10px;
            background-color: #D9D9D9;
            border-radius: 10px;
            gap: 20px ; 
        }
        #btn-guardar{
            visibility: hidden;
        }

        
        .tabla {
            width: 90%;
            border-collapse: collapse;
            border: 2px solid rgb(140 140 140);
            font-size: 0.8rem;
            letter-spacing: 1px;
        }

        thead {
            background-color: #357CA5;
            color: #ffffff;
        }

        /**/
        th,
        td {
            border: 1px solid rgb(160 160 160);
            padding: 8px 10px;
        }

        td {
            text-align: center;
        }

        /* Estilo para alternar colores de las filas */
        tbody tr:nth-child(odd) {
            background-color: #f0f0f0;
            /* Color gris suave para las filas impares */
        }

        tbody tr:nth-child(even) {
            background-color: #fff;
            /* Color blanco para las filas pares */
        }

        /* Efecto hover para las filas */
        tbody tr:hover {
            background-color: #d1e7f0;
            /* Color azul claro al pasar el cursor */
        }
    </style>
</head>

<body>
    <main class="principal">
        <div class="primerContenedor">
            <div class="contenedorTitulo">
                <h2 class="tituloObjetivos">OBJETIVOS</h2>
            </div>
            <div class="contenedorObjetivos">
                <div class="objetivos">
                    @foreach ($objetivos as $item)
                        <h3>{{$item->descrip_objetivo}}</h3>
                    @endforeach
                </div>
                <div class="buttons">
                    @foreach ($objetivos as $item)
                        <button class="btn-actividades" data-id="{{$item->id_objetivo}}">Actividades</button>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="segundoContenedor">
            <table class="tabla">
                <caption>
                    <h2>Actividades y resultados</h2>
                </caption>
                <thead>
                    <tr>
                        <th scope="col">Actividades</th>
                        <th scope="col">Responsable</th>
                        <th scope="col">Resultado</th>
                        <th scope="col">Realizado</th>
                    </tr>
                </thead>
                <tbody id="tabla-actividades">      
                </tbody>
            </table>
            <button id="btn-guardar">Guardar</button>
        </div>
    <main>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>
        $(document).ready(function(){

            // Configurar el token CSRF para todas las solicitudes AJAX
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('click', '.btn-actividades', function() {
                let idActividad = $(this).data('id');
                
                $.ajax({
                    url: 'obtener_actividades',
                    method: 'POST',
                    data: {
                        id: idActividad
                    }
                    }).done(function(res){
                        let arregloActividades = JSON.parse(res);
        
                        let template = "";
                        for(let i=0; i<arregloActividades.length; i++){
                            if(arregloActividades[i].realizado == true){
                                template += `
                                    <tr>
                                        <td>${arregloActividades[i].descripcion_actividad}</td>
                                        <td>${arregloActividades[i].responsable}</td>
                                        <td>${arregloActividades[i].resultado}</td>
                                        <td><input type="checkbox" value="${arregloActividades[i].id_actividad}" class="actividades" checked></td>
                                    </tr>
                                `;
                            }else{
                                template += `
                                    <tr>
                                        <td>${arregloActividades[i].descripcion_actividad}</td>
                                        <td>${arregloActividades[i].responsable}</td>
                                        <td>${arregloActividades[i].resultado}</td>
                                        <td><input type="checkbox" value="${arregloActividades[i].id_actividad}" class="actividades"></td>
                                    </tr>
                                `;
                            }
                            
                            }
                        $("#tabla-actividades").html(template);
                        $('#btn-guardar').css("visibility", "visible");
                    });
                    
            });

            $('#btn-guardar').on('click', function() {
                let actividadRealizada = [];
                let actividadNoRealizada = [];
                $('.actividades').each(function() {
                        if ($(this).is(':checked')) {
                            actividadRealizada.push($(this).val());
                        } else {
                            actividadNoRealizada.push($(this).val());
                        }
                    });
                $.ajax({
                    url: 'editar_actividades_realizadas',
                    method: 'POST',
                    data: {
                        idActividadRealizada: actividadRealizada,
                        idActividadNoRealizado: actividadNoRealizada
                    }
                    });
                alert("Actividades modificadas con exito!");
            
            });
        });
    </script>
</body>

</html>