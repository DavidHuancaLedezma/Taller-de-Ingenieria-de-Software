<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planilla de Planificación</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@500&display=swap');
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
            width: 250px;
            position: relative;
        }

        .custom-select {
            position: relative;
            display: flex;
            flex-direction: column;
        }

        select {
            display: none; /* Ocultamos el select por defecto */
        }

        .select-box {
            background-color: white;
            border: 1px solid #ccc;
            padding: 10px;
            font-size: 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: start; /* Asegura que el ícono y el texto estén alineados al inicio */
            border-radius: 5px;
            gap: 10px; /* Espaciado entre ícono y texto */
        }

        .select-box ion-icon {
            font-size: 20px; /* Ajusta el tamaño del ícono si es necesario */
        }

        .select-items {
            display: none;
            position: absolute;
            background-color: white;
            border: 1px solid #ccc;
            width: 100%;
            box-shadow: 0px 8px 16px rgba(0,0,0,0.2);
            z-index: 99;
            max-height: 150px;
            overflow-y: auto;
            border-radius: 5px;
        }

        .select-items div {
            padding: 10px;
            display: flex;
            align-items: center;
            cursor: pointer;
            transition: background-color 0.3s ease;
            gap: 10px; /* Espaciado entre ícono y texto */
        }

        .select-items div:hover {
            background-color: #222D32;
            color: white;
        }

        .select-box:hover {
            background-color: #f9f9f9;
        }

        .active .select-items {
            display: block;
        }
    </style>
</head>
<body>
    <div class="combo_GEs">
        <label for="opciones">Elige una opción:</label>
        <div class="custom-select">
            <div class="select-box" id="selectBox">
                <ion-icon name="document-text-outline"></ion-icon>
                <span>Selecciona una empresa</span>
            </div>
            <div class="select-items" id="selectItems">
                <div data-value="1"><ion-icon name="business-outline"></ion-icon>EliteSoft</div>
                <div data-value="2"><ion-icon name="business-outline"></ion-icon>Jala</div>
                <div data-value="3"><ion-icon name="business-outline"></ion-icon>JalaSoft</div>
                <div data-value="4"><ion-icon name="business-outline"></ion-icon>JalaSoft</div>
                <div data-value="5"><ion-icon name="business-outline"></ion-icon>JalaSoft</div>
            </div>
            <!-- Aquí está el select oculto -->
            <select id="opciones" name="opciones">
                <option value="1">EliteSoft</option>
                <option value="2">Jala</option>
                <option value="3">JalaSoft</option>
                <option value="4">JalaSoft</option>
                <option value="5">JalaSoft</option>
            </select>
        </div>
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
    <script>
        // Manejador de clics para abrir/cerrar el desplegable
        document.getElementById('selectBox').addEventListener('click', function() {
            var selectItems = document.getElementById('selectItems');
            selectItems.classList.toggle('active');
            if (selectItems.style.display === 'block') {
                selectItems.style.display = 'none';
            } else {
                selectItems.style.display = 'block';
            }
        });

        // Manejador de selección de opciones
        var items = document.querySelectorAll('.select-items div');
        var selectBox = document.getElementById('selectBox');
        var select = document.getElementById('opciones');  // El select oculto
        items.forEach(function(item) {
            item.addEventListener('click', function() {
                // Obtenemos el icono y el texto de la opción seleccionada
                var icon = this.querySelector('ion-icon').outerHTML;
                var text = this.textContent.trim();

                // Actualizamos el selectBox con el icono y el texto
                selectBox.innerHTML = icon + '<span>' + text + '</span>';
                
                // Actualizamos el valor del select
                var value = this.getAttribute('data-value');
                select.value = value;

                // Cerramos el desplegable
                document.getElementById('selectItems').style.display = 'none';
            });
        });

        // Para cerrar el desplegable al hacer clic fuera
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.custom-select')) {
                document.getElementById('selectItems').style.display = 'none';
            }
        });
    </script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>