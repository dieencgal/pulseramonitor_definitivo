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
                    <div class="panel-heading">NRS-Pain/Escala del dolor</div>

                    <div class="panel-body">
                        @include('flash::message')

                        {!! Form::open(['route' => 'encuesta_nrspain.store']) !!}


                        <div class="form-group">
                            {!! Form::label('Nivel_dolor', 'La Escala de calificación numérica (NRS-Pain) es una escala de 11 puntos para el autoinforme de dolor del paciente. Se basa únicamente en la capacidad de realizar actividades de la vida diaria. Señale en la siguiente escala la intensidad del dolor que sufre  ') !!}
                            <br><br>
                            {!! Form::select('Nivel_dolor',[0 => value(' (0) Sin dolor') ,1=>value(' (1) Dolor leve (interfiere levemente con las actividades de la vida diaria'),2=>value(' (2) Dolor leve (interfiere levemente con las actividades de la vida diaria'),3=>value(' (3) Dolor leve (interfiere levemente con las actividades de la vida diaria'),4=>value(' (4) Dolor moderado (interfiere significativamente con las actividades de la vida diaria'),5=>value(' (5) Dolor moderado (interfiere significativamente con las actividades de la vida diaria'),6=>value(' (6) Dolor moderado (interfiere significativamente con las actividades de la vida diaria'),7=>value(' (7) Dolor severo (incapacitante; incapaz de realizar las actividades de la vida diaria)'),8=>value(' (8) Dolor severo (incapacitante; incapaz de realizar las actividades de la vida diaria)'),9=>value(' (9) Dolor severo (incapacitante; incapaz de realizar las actividades de la vida diaria)'),10=>value(' (10) Dolor severo (incapacitante; incapaz de realizar las actividades de la vida diaria)')],['class' => 'form-control'])!!}
                        </div>
                        <div class="form-group">
                            {!!Form::label('paciente_id', 'ID') !!}

                            {!! Form::text('paciente_id', Auth::user()->id-1,['readonly']) !!}
                        </div>

                        <br>

                        {!! Form::submit('Guardar',['class'=>'btn-primary btn']) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
