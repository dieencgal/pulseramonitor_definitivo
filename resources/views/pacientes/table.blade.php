

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
<tbody>
<tr>
<tr>
    <th>Nombre</th>
    <th>Apellidos</th>
    <th>Edad</th>
    <th>Peso</th>
    <th>Sexo</th>
    <th>Altura</th>
    <th>Operacion</th>
    <th>Fecha de la operacion</th>
    <th>Tipo de paciente</th>
    <th>Médico</th>
    <th colspan="2">Acciones</th>
</tr>


</tr>
@foreach ($pacientes as $paciente)


    <tr>
        <td>{{ $paciente->nombre }}</td>
        <td>{{ $paciente->apellidos }}</td>
        <td>{{ $paciente->edad }}</td>
        <td>{{ $paciente->peso }}</td>
        <td>{{ $paciente->sexo }}</td>
        <td>{{ $paciente->altura }}</td>
        <td>{{ $paciente->operacion }}</td>
        <td>{{ $paciente->fecha_operacion }}</td>
        <td>{{ $paciente->tipo_paciente }}</td>
        <td>{{ $paciente->medico->nombre}}</td>

        <td>
            {!! Form::open(['route' => ['pacientes.edit',$paciente->id], 'method' => 'get']) !!}
            {!!   Form::submit('Editar', ['class'=> 'btn btn-warning'])!!}
            {!! Form::close() !!}
        </td>
        <td>
            {!! Form::open(['route' => ['pacientes.destroy',$paciente->id], 'method' => 'delete']) !!}
            {!!   Form::submit('Borrar', ['class'=> 'btn btn-danger' ,'onclick' => 'if(!confirm("¿Está seguro?"))event.preventDefault();'])!!}
            {!! Form::close() !!}

        </td>
    </tr>
@endforeach
</tbody>

        </div>

