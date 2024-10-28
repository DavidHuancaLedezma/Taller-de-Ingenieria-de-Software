<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Planilla de Planificación</title>
    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f0f4f4;
            padding: 20px;
            display: flex ;
            flex-direction: column ; 
            justify-content : center ; 
            align-items: center ;
            gap: 20px ; 
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            width : 100% ; 
            min-height:60px ;
            background-color: #367FA9 ;
            display: flex ; 
            justify-content : center ; 
            align-items: center ; 
            color : white ; 
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background-color: #cce5e5;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #ddd;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        td {
            font-size: 14px;
        }
        td p {
            text-align: left ; 
            margin-left: 10px;
        }

        /*Estilos del combobox*/ 
        .combo_GEs {
            width: 500px;
            background-color: #fff;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(255, 255, 255, 0.1);
            display: flex ;
        }

        .combo_GEs label {
            font-size: 16px;
            color: #333; 
            
        }
        .combo_GEs label {
            font-size: 16px;
            color: #333; 
            white-space: nowrap; /* Evita que el texto se rompa en varias líneas */
            display: block; /* Asegura que el label esté alineado correctamente */
            margin-top: 5px;  
        }
        .combo_GEs select {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: white;
            color: #333;
            cursor: pointer;
            appearance: none; /* Quita el estilo predeterminado del navegador */
            -webkit-appearance: none;
            -moz-appearance: none;
        }

        .combo_GEs select:hover {
            border-color: #222D32;
            background-color: #ffffff;
        }

        .combo_GEs select:focus {
            outline: none;
            border-color: #222D32;
            box-shadow: 0 0 5px #ffffff;
        }

        .combo_GEs option {
            padding: 10px;
        }

        .combo_GEs option:hover {
            background-color: #222D32;
            color: white;
        } 
    </style>
</head>
<body>
    <input id="id-docente" type="hidden" value="{{$idDocente}}">
    <div class="combo_GEs">
        <label for="opciones">Elige una opción:</label>
        <select id="opciones" name="opciones">
            <option value="">Seleccionar</option>
        @foreach ($grupoEmpresas as $empresa)
            <option value="{{$empresa->id_grupo_empresa}}">{{$empresa->nombre_corto}}</option>
        @endforeach
        </select>
    </div>
    <div class="container">
        <h2 class="titulo-planilla-planificacion" >Planilla de planificación {{$nombreCorto}}</h2>
        <table>
            <thead>
                <tr>
                    <th>HITO</th>
                    <th>FECHA INICIO</th>
                    <th>FECHA FIN</th>
                    <th>% COBRO</th>
                    <th>ENTREGABLES</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($planillaCompleta as $filas)
                    <tr>
                        <td>{{$filas[0]->numero_hito}}</td>
                        <td>{{$filas[0]->fecha_inicio_hito}}</td>
                        <td>{{$filas[0]->fecha_fin_hito}}</td>
                        <td>{{$filas[0]->porcentaje_cobro}}%</td>
                        <td>
                            @if (count($filas[1]) > 0)
                                @foreach ($filas[1] as $item)
                                    <p>- {{$item->descrip_objetivo}}</p>
                                @endforeach
                            @else
                                <p>- Ninguno</p>
                            @endif
                        </td>
                    </tr>
                @endforeach
                <!-- Puedes añadir más filas aquí -->
            </tbody>
        </table>    
    </div>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // Configurar el token CSRF para todas las solicitudes AJAX
        $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
            });
        $(document).ready(function(){
            $('#opciones').on('change', function() {
                // Obtener el valor de la opción seleccionada
                let valorSeleccionado = $(this).val();
                let idDocente = $('#id-docente').val();
                // Obtener el texto de la opción seleccionada
                let textoSeleccionado = $("#opciones option:selected").text();
    
                // Mostrar el valor y el texto en la consola si no es "Seleccionar"
                if(textoSeleccionado !== "Seleccionar"){
    
                    $.ajax({
                    url: '{{ url('/obtener_id_proyecto_de_grupo_empresa') }}',
                    method: 'POST',
                    data: {
                        idGrupoEmpresa: valorSeleccionado
                    }
                    }).done(function(res){
                        let idProyecto = JSON.parse(res);
                        window.location.href = `{{ url('/visualizar_planilla_de_planificacion/${idProyecto}/${idDocente}') }}`;
                        console.log("id obtenido de ajax Proyecto: " + idProyecto);
                        
                    }).fail(function(jqXHR, textStatus, errorThrown) {
                        console.error('Error en la solicitud:', textStatus, errorThrown);
                        console.error('Detalles del error:', jqXHR.responseText);
                        
                    });
                    console.log("-----------------------------------------");
                    console.log("Valor seleccionado: " + valorSeleccionado);
                    console.log("Texto seleccionado: " + textoSeleccionado);
                }
            });
            
        });
    </script>

</body>
</html>