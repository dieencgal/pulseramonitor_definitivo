@extends('layouts.app')


@section('content')
    <link href="http://vjs.zencdn.net/c/video-js.css" rel="stylesheet">
    <script src="http://vjs.zencdn.net/c/video.js"></script>
    <style>
        html, body {
            background-color: darkcyan;
            color: black /*#636b6f*/;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;

            /*background: transparent url('img/xia.jpg') no-repeat center center;
            background-repeat: no-repeat;
            background-position: fixed;
            -webkit-background-size: cover;
            -webkit-filter: cover;
            background-size: cover;
*/
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: black;
            /*#636b6f;*/
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: none;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
        .panel > .panel-heading {
            background-image: none;
            background-color: white;
            color: darkcyan;

        }
        .panel-dos{
            font-size: 17px;
            font-weight: 600;
            color: #c7254e;

        }




    </style>

    <body>



    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div id="myDiv">

                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Pacientes</div>

                <div class="panel-body">
                    @include('flash::message')


                    {!!     Form::submit('Información del paciente', ['class'=> 'btn btn-primary'])!!}


                    <br><br>
                    <table class="table table-striped table-bordered">

    <td style ="word-break:break-all;">
        <thead>
        <tr>

            <th>Fecha</th>
            <th>Distancia [metros]</th>
            <th>Frecuencia cardiaca media [ppm]</th>
            <th>Frecuencia cardiaca max [ppm]</th>
            <th>Frecuencia cardiaca min [ppm]</th>
            <th>Velocidad media [km/h]</th>
            <th>Velocidad max [km/h]</th>
            <th>Velocidad min [km/h]</th>
            <th>Recuento pasos</th>
            <th>Peso [kg]</th>
            <th>Recuento de minutos activos [min]</th>
            <th>Andar duración [h]</th>
            <th>Dormir duracion [h]</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $item)
            <tr>

                <td>{{$item->fecha}}</td>
                <td>{{$item->distancia}}</td>
                <td>{{$item->frec_cardiaca_media}}</td>
                <td>{{$item->frec_cardiaca_max}}</td>
                <td>{{$item->frec_cardiaca_min}}</td>
                <td>{{$item->velocidad_media}}</td>
                <td>{{$item->velocidad_max}}</td>
                <td>{{$item->velocidad_min}}</td>
                <td>{{$item->recuento_pasos}}</td>
                <td>{{$item->peso_medio}}</td>
                <td>{{$item->recuento_min_activos}}</td>
                <td>{{$item->andar_duracion}}</td>
                <td>{{$item->dormir_duracion}}</td>
            </tr>
        @endforeach
        </tbody>
</table>
                </div>
            </div>
        </div>
    </div>

        @endsection

