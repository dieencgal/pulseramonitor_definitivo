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

        <div class="row">

                <div class="panel panel-default">
                    <div class="panel-heading">Pulsera Monitor</div>
                    <br>


                    @if ((Auth::user()->hasRole('user')))


                        @include('flash::message')

                        {!!     Form::submit('Mis datos', ['class'=> 'btn btn-primary'])!!}
                        <br><br>
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>Edad</th>
                                <th>Peso</th>
                                <th>Sexo</th>
                                <th>Altura</th>


                            </tr>

                            @foreach ($pacientes as $paciente)


                                <tr>
                                    <td>{{ $paciente->nombre }}</td>
                                    <td>{{ $paciente->apellidos }}</td>
                                    <td>{{ $paciente->edad }}</td>
                                    <td>{{ $paciente->peso }}</td>
                                    <td>{{ $paciente->sexo }}</td>
                                    <td>{{ $paciente->altura }}</td>




                                </tr>
                            @endforeach
                        </table>
                        <br><br>

                        <div class="panel-body">

                            Use el desplegable para ver sus avances.

                        </div>
                        <a href="{{  url('import') }}" class="btn btn-primary">Importar</a> ----><a href="https://takeout.google.com/settings/takeout">Página web de Google Takeout</a><br>

                        <br><br>
                        <div class="links">

                            ¿No sabe cómo extraer sus datos de la pulsera?<a href="{{  url('ayuda') }}" class="btn btn">Vea el siguiente vídeo</a>


                        </div>
                        <br><br>
                        <div class="panel panel-dos">


                            <div> {{$var}} </div>


                        </div>
                    @else
                        <div class="panel panel-dos">

                            <small class="form-text text-muted">{!! nl2br(e($vor)) !!}</small>



                        </div>


                        <a href="{{  url('import') }}" class="btn btn-primary">Importar</a>
                        <small>Importar datos de usuarios sanos</small>
                        <br><br>


                    @endif






                </div>
            </div>

    </div>
    </body>



@endsection
