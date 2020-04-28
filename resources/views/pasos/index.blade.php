@extends('layouts.app')


@section('content')
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
