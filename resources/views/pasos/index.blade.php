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
            <div class="col-lg-12">
                <div id="myDiv">

                </div>
            </div>


                <div class="panel panel-default">
                    <div class="panel-heading">Pasos</div>
                    @if ((Auth::user()->hasRole('admin')))

                        <!doctype html>
                        <html lang="{{ app()->getLocale() }}">
                        <head>
                            <meta charset="utf-8">
                            <meta http-equiv="X-UA-Compatible" content="IE=edge">
                            <meta name="viewport" content="width=device-width, initial-scale=1">
                            <title>Laravel Charts</title>
                        </head>
                        <body>
                        <div class="container">
                            <h1 style="text-align: center;">Pasos totales</h1>
                            <br>
                            {!! $chart->html() !!}
                        </div>

                        {!! Charts::scripts() !!}
                        {!! $chart->script() !!}
                        </body>
                        </html>
                    @endif

                @if ((Auth::user()->hasRole('user')))

                                <!doctype html>
                                <html lang="{{ app()->getLocale() }}">
                                <head>
                                    <meta charset="utf-8">
                                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                                    <meta name="viewport" content="width=device-width, initial-scale=1">
                                    <title>Laravel Charts</title>
                                </head>
                                <body>
                                <div class="container">
                                    <h1 style="text-align: center;">Pasos totales</h1>
                                    <br>
                                    {!! $chart->html() !!}
                                </div>

                                {!! Charts::scripts() !!}
                                {!! $chart->script() !!}
                                </body>
                                </html>
                                @endif

                    <div class="panel-body">
                        @include('flash::message')
                        {!! Form::open(['route' => 'pasos.create', 'method' => 'get']) !!}
                        {!!     Form::submit('Crear pasos', ['class'=> 'btn btn-primary'])!!}
                        {!! Form::close() !!}

                        <br><br>
                        <div class="col-md-6">
                            <button type="submit" >Mostrar pasos realizados el día (número del día)</button>
                            <form action="/search2"  method="get">
                                <div class="form-group">
                                    <input type="search2" name="search2" class="form-control" placeholder="Ej 10">
                                    <span class="input-group-prepend">

                                    </span>

                                </div>
                            </form>
                        </div>



                        <table class="table table-striped table-bordered">
                            <tr>

                                <th>Fecha</th>
                                <th>Distancia</th>
                                <th>Número de pasos</th>
                                <th>Paciente</th>
                                <th colspan="2">Acciones</th>
                            </tr>

                            @foreach ($pasos as $paso)


                                <tr>
                                    <td>{{ $paso->fecha }}</td>
                                    <td>{{ $paso->distancia }}</td>
                                    <td>{{ $paso->num_pasos }}</td>
                                    <td>{{ $paso->paciente_id}}</td>


                                    <td>


                                        {!! Form::open(['route' => ['pasos.edit',$paso->id], 'method' => 'get']) !!}
                                        {!!   Form::submit('Editar', ['class'=> 'btn btn-warning'])!!}
                                        {!! Form::close() !!}
                                    </td>
                                    <td>
                                        {!! Form::open(['route' => ['pasos.destroy',$paso->id], 'method' => 'delete']) !!}
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
