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
            margin: 0;


        }
        .panel > .panel-default{
            margin: 0;
            margin-left: 0;
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



    <div class="container" style="width: 100%">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
            <div class="panel panel-default">
                    <div class="panel-heading">Escala NRS-PAIN (Intensidad del dolor)</div>

                    <div class="panel-body">
                        <br>
                        La escala numérica del dolor (NRS) es una escala numérica única de 11 puntos ampliamente validada en una miríada de tipos de pacientes. Los datos obtenidos a través de NRS se documentan fácilmente,
                        son intuitivamente interpretables y cumplen con los requisitos reglamentarios para la evaluación y documentación del dolor.

                        <br>
                        <img src="img/dolor.jpg" />
                        <br>
                        @include('flash::message')



                        <br><br>



                        <table class="table table-bordered table-hover" >

                                <thead>



                                    <th width=200px>Nivel de dolor</th>
                                    <th width=200px>ID del paciente</th>
                                    <th width=200px colspan="1">Acciones</th>




                                </tr>
                                </thead>

                                @foreach ($show as $medico)


                                    <tr>
                                        <td>{{ $medico->Nivel_dolor }}</td>

                                        <td>{{ $medico->paciente_id }}</td>






                                    <td>
                                        {!! Form::open(['route' => ['encuesta_nrspain.edit',$medico->id], 'method' => 'get']) !!}
                                        {!!   Form::submit('Editar', ['class'=> 'btn btn-warning'])!!}
                                        {!! Form::close() !!}


                                        {!! Form::open(['route' => ['encuesta_nrspain.destroy',$medico->id], 'method' => 'delete']) !!}
                                        {!!   Form::submit('Borrar', ['class'=> 'btn btn-danger' ,'onclick' => 'if(!confirm("¿Está seguro?"))event.preventDefault();'])!!}
                                        {!! Form::close() !!}

                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
