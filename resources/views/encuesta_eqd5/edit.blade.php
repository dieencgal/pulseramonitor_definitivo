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
                    <div class="panel-heading">Editar</div>

                    <div class="panel-body">
                        @include('flash::message')

                        {!! Form::model($show, [ 'route' => ['encuesta_eqd5.update',$show->id], 'method'=>'PUT']) !!}

                        <div class="form-group">
                            {!!Form::label('Movilidad', 'Movilidad' )!!}
                            <br>
                            {!! Form::select('Movilidad', ['Seleccione una respuesta',1=>'No tengo problemas para caminar','Tengo algunos problemas para caminar','Tengo que estar en la cama'], null,['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('Cuidado_personal', 'Cuidado personal') !!}
                            {!! Form::select('Cuidado_personal',['Seleccione una respuesta','No tengo problemas con el cuidado personal','Tengo algunos problemas para lavarme o vestirme solo','Soy incapaz de lavarme o vestirme solo'],null,['class'=>'form-control'])!!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('Actividades_dia', 'Actividades del día a día') !!}
                            {!! Form::select('Actividades_dia',['Seleccione una respuesta','No tengo problemas para realizar mis actividades de todos los días','Tengo algunos problemas para realizar mis actividades de todos los días','Soy incapaz de realizar mis actividades de todos los días'],null,['class'=>'form-control'])!!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('Dolor_malestar', 'Dolor/Malestar') !!}
                            {!! Form::select('Dolor_malestar',['Seleccione una respuesta','No tengo dolor ni malestar','Tengo moderado dolor o malestar','Tengo mucho dolor o malestar'],null,['class'=>'form-control'])!!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('Ansiedad_depresion', 'Ansiedad/Depresión') !!}
                            {!! Form::select('Ansiedad_depresion',['Seleccione una respuesta','No estoy ansioso/a ni deprimido/a' => value(2),'Estoy moderadamente ansioso/a o deprimido/a','Estoy muy ansioso/a o deprimido/a'],null,['class'=>'form-control'])!!}
                        </div>
                        <div class="form-group">
                            {!!Form::label('paciente_id', 'Paciente') !!}

                            {!! Form::text('paciente_id', Auth::user()->id-1,null,['class'=>'form-control']) !!}
                        </div>



                        {!! Form::submit('Guardar',['class'=>'btn-primary btn']) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
