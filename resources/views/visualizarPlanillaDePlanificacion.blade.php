<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    </style>
</head>
<body>
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
</body>
</html>