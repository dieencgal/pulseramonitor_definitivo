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
        .col-md-4{
            background-color: white;
            margin-bottom: 3px;
        }
        .container{
            margin-left: 10px;
        }



    </style>

    <body>



    <div class="container"style="width: 100%" >
        <div class="row"style="width: 100%" >
            <div class="col-lg-12"style="width: 100%" >
                <div id="myDiv">
                </div>
            </div>
            <div class="panel panel-default" style="width: 100%">
                    <div class="panel-heading">Cuestionario OSWESTRY</div>

                    <div class="panel-body">
                        @include('flash::message')
                        @if(Auth::user()->hasRole('user'))
                        {!! Form::open(['route' => 'encuesta_oswestry.create', 'method' => 'get', 'class'=>'inline-important']) !!}
                            {!!   Form::submit('Realizar cuestionario', ['class'=> 'btn btn-primary'])!!}
                            {!! Form::close() !!}
                        @endif





                        <br><br>
                        <br><br>
                        <div class="table-responsive " style="width: 100%">


                            <table class="table table-responsive table-hover" style="width: 1500px;" >
                            <td style ="word-break:break-all;">
                                <thead>
                                <tr>
                                <th>Indique la intensidad de su dolor de espalda (lumbar) en las últimas 4 semanas</th>
                                <th>Indique la intensidad de su dolor de pierna (ciática) en las últimas 4 semanas</th>
                                <th>Intensidad del dolor (generalizado)</th>
                                <th>Cuidados personales</th>
                                <th>Estar de pie</th>
                                <th>Dormir</th>
                                <th>Levantar peso</th>
                                <th>Actividad sexual</th>
                                <th>Andar</th>
                                <th>Vida social</th>
                                <th>Estar sentado</th>
                                <th>Viajar</th>
                                <th>ID del paciente</th>
                                <th colspan="2">Acciones</th>


                            </tr>
                                </thead>

                            @foreach ($show as $medico)


                                <tr>
                                    <td>{{ $medico->Intensidad_dolor_espalda_lumbar_4sem }}</td>
                                    <td>{{ $medico->Intensidad_dolor_pierna_ciatica_4sem }}</td>
                                    <td>{{ $medico->Intensidad_dolor}}</td>
                                    <td>{{ $medico->Cuidados_personales}}</td>
                                    <td>{{ $medico->Estar_de_pie}}</td>
                                    <td>{{ $medico->Dormir}}</td>
                                    <td>{{ $medico->Levantar_peso}}</td>
                                    <td>{{ $medico->Actividad_sexual}}</td>
                                    <td>{{ $medico->Andar }}</td>
                                    <td>{{ $medico->Vida_social }}</td>
                                    <td>{{ $medico->Estar_sentado }}</td>
                                    <td>{{ $medico->Viajar }}</td>
                                    <td>{{ $medico->paciente_id }}</td>




                                    <td>
                                        {!! Form::open(['route' => ['encuesta_oswestry.edit',$medico->id], 'method' => 'get']) !!}
                                        {!!   Form::submit('Editar', ['class'=> 'btn btn-warning'])!!}
                                        {!! Form::close() !!}
                                    </td>
                                    <td>
                                        {!! Form::open(['route' => ['encuesta_eqd5.oswestry',$medico->id], 'method' => 'delete']) !!}
                                        {!!   Form::submit('Borrar', ['class'=> 'btn btn-danger' ,'onclick' => 'if(!confirm("¿Está seguro?"))event.preventDefault();'])!!}
                                        {!! Form::close() !!}

                                    </td>
                                </tr>
                            @endforeach
                            </div>
                        </table>
                    </div>
                </div>
            </div>
        </div>
@endsection
