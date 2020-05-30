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



    </style>

    <body>



    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Encuesta EQ-D5</div>

                    <div class="panel-body">
                        @include('flash::message')
                        {!! Form::open(['route' => 'encuesta_eqd5.create', 'method' => 'get', 'class'=>'inline-important']) !!}
                        {!!   Form::submit('Hacer encuesta', ['class'=> 'btn btn-primary'])!!}
                        {!! Form::close() !!}



                        <br><br>
                        <table class="table table-responsive table-condensed">
                            <tr>
                                <th>Movilidad</th>
                                <th>Cuidado-Personal</th>
                                <th>Actividades del día a día</th>
                                <th>Dolor/Malestar</th>
                                <th>Ansiedad/Depresión</th>
                                <th>ID del paciente</th>


                                <th colspan="2">Acciones</th>
                            </tr>

                            @foreach ($show as $medico)


                                <tr>
                                    <td>{{ $medico->Movilidad }}</td>
                                    <td>{{ $medico->Cuidado_personal }}</td>
                                    <td>{{ $medico->Actividades_dia}}</td>
                                    <td>{{ $medico->Dolor_malestar }}</td>
                                    <td>{{ $medico->Ansiedad_depresion }}</td>
                                    <td>{{ Auth::user() }}</td>




                                    <td>
                                        {!! Form::open(['route' => ['encuesta_eqd5.edit',$medico->id], 'method' => 'get']) !!}
                                        {!!   Form::submit('Editar', ['class'=> 'btn btn-warning'])!!}
                                        {!! Form::close() !!}
                                    </td>
                                    <td>
                                        {!! Form::open(['route' => ['encuesta_eqd5.destroy',$medico->id], 'method' => 'delete']) !!}
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
@endsection
