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





    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div id="myDiv">

                </div>
            </div>


            <div class="panel panel-default">
                <div class="panel-heading">Pasos</div>


                <div class="panel-body">
                    @include('flash::message')

                    {!! Form::open(['route' => 'registro_suenos.create', 'method' => 'get']) !!}
                    {!!     Form::submit('Crear datos registro sueño', ['class'=> 'btn btn-primary'])!!}
                    {!! Form::close() !!}

                    <br><br>

                    <div class="col-md-6">
                        <button type="submit" >Mostrar registro de sueño del día ... (número del día)</button>
                        <form action="/search3"  method="get">
                            <div class="form-group">
                                <input type="search3" name="search3" class="form-control" placeholder="Ej 10">
                                <span class="input-group-prepend">

                                    </span>

                            </div>
                        </form>
                    </div>




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
