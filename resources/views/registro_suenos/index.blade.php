@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div id="myDiv">

                </div>
            </div>


            <div class="panel panel-default">
                <div class="panel-heading">Registros del sueño</div>
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
                        <h1 style="text-align: center;">Sueño del paciente</h1>
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
                <h1 style="text-align: center;">Horas de sueño</h1>
                <br>
                {!! $chart->html() !!}
            </div>

            {!! Charts::scripts() !!}
            {!! $chart->script() !!}
            </body>
            </html>
        @endif
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Registro sueño</div>

                    <div class="panel-body">
                        @include('flash::message')
                        {!! Form::open(['route' => 'registro_suenos.create', 'method' => 'get']) !!}
                        {!!     Form::submit('Crear registro de sueño', ['class'=> 'btn btn-primary'])!!}
                        {!! Form::close() !!}

                        <br><br>
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Fecha</th>
                                <th>Horas de sueño</th>
                                <th>Paciente</th>
                                <th colspan="2">Acciones</th>
                            </tr>

                            @foreach ($registro_suenos as $registro_sueno)


                                <tr>
                                    <td>{{ $registro_sueno->fecha }}</td>
                                    <td>{{ $registro_sueno->horas_sueno}}</td>
                                    <td>{{ $registro_sueno->paciente->id }}</td>
                                    <td>
                                        {!! Form::open(['route' => ['registro_suenos.edit',$registro_sueno->id], 'method' => 'get']) !!}
                                        {!!   Form::submit('Editar', ['class'=> 'btn btn-warning'])!!}
                                        {!! Form::close() !!}
                                    </td>
                                    <td>
                                        {!! Form::open(['route' => ['registro_suenos.destroy',$registro_sueno->id], 'method' => 'delete']) !!}
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
