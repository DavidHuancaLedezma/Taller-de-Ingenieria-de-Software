<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <style>

        *{
            margin: 0px;
            padding: 0px;

        }
        body{
            height: 100vh;
            background-color: #D2D6DE;
            display: flex;
            flex-direction: column ;
            justify-content: center ; 
            align-items: center;
            gap: 5px ; 
            padding: 12px ; 
        }

        .container_inicial{
            background-color: rgb(255, 255, 255);
            padding: 10px ;
            max-width: 600px ; 
            
        }
        header{
            background-color: #367FA9 ;
            display: flex ; 
            justify-content: center ; 
            align-items: center ; 
            padding: 10px ; 
        }

        h3{
            color: white;
            text-align: center;
        }

        img{
            width: 100%;
            max-height: 500px ;
        }
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

    <div class="combo_GEs">
        <label for="opciones">Elige una opción:</label>
        <select id="opciones" name="opciones">
            <option value="">Seleccionar</option>
        @foreach ($grupoEmpresas as $empresa)
            <option value="{{$empresa->id_grupo_empresa}}">{{$empresa->nombre_corto}}</option>
        @endforeach
        </select>
    </div>
    
    <div class="container_inicial">
        <header>
            <h3>REGISTRO CONTROL SEMANAL<br>
            DE GRUPO EMPRESAS</h3>
        </header>
        <main>
            <img src="https://img.freepik.com/vector-gratis/concepto-gestion-tiempo-dibujado-mano-plana_23-2148820992.jpg" alt="imagen de control">
        </main>
    </div>


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
    
                // Obtener el texto de la opción seleccionada
                let textoSeleccionado = $("#opciones option:selected").text();
    
                // Mostrar el valor y el texto en la consola si no es "Seleccionar"
                if(textoSeleccionado !== "Seleccionar"){
    
                    $.ajax({
                    url: '{{ url('/obtener_id_hito_grupo_empresa_combo_box') }}',
                    method: 'POST',
                    data: {
                        idGrupoEmpresa: valorSeleccionado
                    }
                    }).done(function(res){
                        let id_hito = JSON.parse(res);
                        window.location.href = `{{ url('/cargar_registro_semanal${id_hito}') }}`;
                        console.log("id obtenido de ajax GE: " + id_hito);
                        
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