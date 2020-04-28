@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div id="myDiv">

                </div>
            </div>


            <div class="panel panel-default">
                <div class="panel-heading">Frecuencias cardíacas</div>
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
                <h1 style="text-align: center;">Frecuencias cardíacas</h1>
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
            <h1 style="text-align: center;">Frecuencia cardiaca media</h1>
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
                        {!! Form::open(['route' => 'frecuencia_cardiacas.create', 'method' => 'get']) !!}
                        {!!     Form::submit('Crear frecuencia cardiaca', ['class'=> 'btn btn-primary'])!!}
                        {!! Form::close() !!}

                        <br><br>
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Fecha</th>
                                <th>Frecuencia cardiaca media</th>
                                <th>Frecuencia cardiaca max</th>
                                <th>Frecuencia cardiaca min</th>
                                <th>Paciente</th>
                                <th colspan="2">Acciones</th>
                            </tr>

                            @foreach ($frecuencia_cardiacas as $frecuencia_cardiaca)


                                <tr>
                                    <td>{{ $frecuencia_cardiaca->fecha}}</td>
                                    <td>{{ $frecuencia_cardiaca->frec_cardiaca_media }}</td>
                                    <td>{{ $frecuencia_cardiaca->frec_cardiaca_max }}</td>
                                    <td>{{ $frecuencia_cardiaca->frec_cardiaca_min }}</td>
                                    <td>{{ $frecuencia_cardiaca->paciente_id}}</td>
                                    <td>
                                        {!! Form::open(['route' => ['frecuencia_cardiacas.edit',$frecuencia_cardiaca->id], 'method' => 'get']) !!}
                                        {!!   Form::submit('Editar', ['class'=> 'btn btn-warning'])!!}
                                        {!! Form::close() !!}
                                    </td>
                                    <td>
                                        {!! Form::open(['route' => ['frecuencia_cardiacas.destroy',$frecuencia_cardiaca->id], 'method' => 'delete']) !!}
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
