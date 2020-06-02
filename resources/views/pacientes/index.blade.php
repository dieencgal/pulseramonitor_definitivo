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
            width: 1250px;


        }
        .panel-dos{
            font-size: 17px;
            font-weight: 600;
            color: #c7254e;
            width: 1200px;

        }
        .panel-body{
            width: 1250px;



        }
        .panel-default{
            width: 1250px;

        }
        .col-md-4{
            background-color: white;
            margin-bottom: 3px;
        }



    </style>






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
                    @if(Auth::user()->hasRole('admin'))


                        {!! Form::open(['route' => 'pacientes.create', 'method' => 'get']) !!}
                        {!!     Form::submit('Añadir paciente', ['class'=> 'btn btn-primary'])!!}
                        {!! Form::close() !!}
                        <div class="panel panel-dos">


                            {{$var}}


                        </div>

                    <br><br>


                        <div class="col-md-6">
                            <button type="submit" >Buscar un paciente por apellido, patología o número de ID</button>
                            <form action="/search"  method="get">
                                <div class="form-group">
                                    <input type="search" name="search" class="form-control" placeholder="Buscar paciente">
                                    <span class="input-group-prepend">

                                    </span>

                                </div>
                            </form>
                        </div>
                        @else
                        El médico aún debe darle de alta
                    @endif





                    <br><br>

                    <table class="table table-sm">

                            <thead>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>Email</th>
                                <th>Edad</th>
                                <th>Peso</th>
                                <th>Sexo</th>
                                <th>Altura</th>
                                <th>Patología</th>
                                <th>Fecha de la operación</th>
                                <th>Tipo de dispositivo</th>
                                <th>Clínico</th>
                                <th colspan="2">Acciones</th>
                            </tr>
                            </thead>

                            @foreach ($pacientes as $paciente)


                                <tr>
                                    <td>{{ $paciente->nombre }}</td>
                                    <td>{{ $paciente->apellidos }}</td>
                                    <td>{{ $paciente->email }}</td>
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

                                        {!! Form::open(['route' => ['pacientes.destroy',$paciente->id], 'method' => 'delete']) !!}
                                        {!!   Form::submit('Borrar', ['class'=> 'btn btn-primary' ,'onclick' => 'if(!confirm("¿Está seguro?"))event.preventDefault();'])!!}
                                        {!! Form::close() !!}

                                    </td>

                                    <td>
                                        <a href="{{ url('infoPacientes/'.$paciente->id.'/') }}">
                                            {!!     Form::submit('Ver datos', ['class'=> 'btn btn-warning'])!!}
                                        </a>
                                        <br>
                                        <a href="{{ url('comparativas/'.$paciente->id.'/') }}">
                                            {!!     Form::submit('Evolución', ['class'=> 'btn btn-primary'])!!}
                                        </a>
                                    </td>


                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
@endsection

