<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/css/bootstrap.min.css" rel="stylesheet">
    <title>Planilla de planificación</title>

    <style>
        #tabla{
            width: 1000px;
        }
        .contenedor{
            display: flex;
            justify-content: center;
        }
        
        /* Cambiar color de los botones */
        .btn-info {
            background-color: #357CA5 !important;
            border-color: #357CA5 !important;
            color : white ; 
        }
        .btn-info:hover {
            background-color: #357CA5 !important; /* Un color un poco más oscuro para el hover */
            border-color: #357CA5 !important;
            color : white ; 
        }
    </style>

</head>
<body>
    

    <h1 style="text-align:center">Planilla de planificación</h1>
    <div class="contenedor">
        <table id="tabla" class="table table-striped table-bordered table-hover">
            <thead class="table-info">
                <tr>
                    <th>Hito</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Objetivo</th>
                    <th>Como se mide</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($hitos as $item)

                <tr>
                    <td>Hito {{$item->numero_hito}}</td>
                    <td>{{$item->fecha_inicio_hito}}</td>
                    <td>{{$item->fecha_fin_hito}}</td>
                    <td>
                        <form action="{{ url('/cargar_objetivos') }}" method="POST">
                            {{ csrf_field() }}
                            <button class="btn btn-info" type="submit" value="{{$item->id_hito}}" name="id_hito">objetivos</button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ url('/seguimiento_semanal')}}" method="POST">
                            {{ csrf_field() }}
                            <button class="btn btn-info" type="submit" value="{{$item->id_hito}}" name="id_hito">Seguimiento semanal</button>
                        </form>
                    </td>
                </tr>

                @endforeach 
            </tbody>
        </table>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/js/bootstrap.bundle.min.js"></script>
</body>
</html>