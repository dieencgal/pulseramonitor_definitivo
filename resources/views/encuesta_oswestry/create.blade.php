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
                    <div class="panel-heading">Preguntas</div>

                    <div class="panel-body">
                        @include('flash::message')

                        {!! Form::open(['route' => 'encuesta_oswestry.store']) !!}
                        <div class="form-group">
                            {!!Form::label('Intensidad_dolor_espalda_lumbar_4sem', 'Intensidad del dolor de espalda en las últmas 4 semanas' )!!}
                            <br>
                            {!! Form::select('Intensidad_dolor_espalda_lumbar_4sem',['Seleccione una respuesta',0 => value('No tengo dolor') ,1=>value('A veces siento dolor'),2=>value('El dolor es constante pero no muy fuerte'),3=>value('Tengo fuertes dolores de vez en cuando'),4=>value('Tengo fuertes dolores de forma frecuente'),5=>value('No puedo aguantar el dolor')],['class' => 'form-control'])!!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('Intensidad_dolor_pierna_ciatica_4sem', 'Del mismo modo, indique la intensidad del dolor en su pierna') !!}
                            <br><br>
                            {!! Form::select('Intensidad_dolor_pierna_ciatica_4sem',['Seleccione una respuesta',0 => value('No tengo dolor') ,1=>value('A veces siento dolor'),2=>value('El dolor es constante pero no muy fuerte'),3=>value('Tengo fuertes dolores de vez en cuando'),4=>value('Tengo fuertes dolores de forma frecuente'),5=>value('No puedo aguantar el dolor')],['class' => 'form-control'])!!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('Intensidad_dolor', 'Intensidad del dolor (generalizado)') !!}
                            <br><br>
                            {!! Form::select('Intensidad_dolor',['Seleccione una respuesta',0 => value(' (0) Puedo soportar el dolor sin necesidad de tomar calmantes ') ,1=>value(' (1) El dolor es fuerte pero me arreglo sin tomar calmantes '),2=>value(' (2) Los calmantes me alivian completamente el dolor '),3=>value(' (3) Los calmantes me alivian un poco el dolor '),4=>value(' (4) Los calmantes apenas me alivian el dolor '),5=>value('(5) Los calmantes no me alivian el dolor y no los tomo')],['class' => 'form-control'])!!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('Cuidados_personales', 'Cuidados personales') !!}
                            <br><br>
                            {!! Form::select('Cuidados_personales',['Seleccione una respuesta',0 => value(' (0) Me las puedo arreglar solo sin que me aumente el dolor ') ,1=>value(' (1) Me las puedo arreglar solo pero esto me aumenta el dolor'),2=>value(' (2) Lavarme, vestirme, etc, me produce dolor y tengo que hacerlo despacio y con cuidado'),3=>value('(3) Necesito alguna ayuda pero consigo hacer la mayoría de las cosas yo solo '),4=>value(' (4) Necesito ayuda para hacer la mayoría de las cosas '),5=>value('(5) No puedo vestirme, me cuesta lavarme y suelo quedarme en la cama ')],['class' => 'form-control'])!!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('Estar_de_pie', 'Estar de pie') !!}
                            <br><br>
                            {!! Form::select('Estar_de_pie',['Seleccione una respuesta',0=>value(' (0) Puedo estar de pie tanto tiempo como quiera sin que me aumente el dolor'),1=>value(' (1) Puedo estar de pie tanto tiempo como quiera pero me aumenta el dolor'),2=>value(' (2) El dolor me impide estar de pie más de una hora '),3=>value(' (3) El dolor me impide estar de pie más de media hora'),4=>value(' (4) El dolor me impide estar de pie más de 10 minutos'),5=>value(' (5) El dolor me impide estar de pie ')],['class'=>'form-control'])!!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('Dormir', 'Dormir') !!}
                            <br><br>
                            {!! Form::select('Dormir',['Seleccione una respuesta',0 => value(' (0) El dolor no me impide dormir bien ') ,1=>value(' (1) Sólo puedo dormir si tomo pastillas '),2=>value(' (2) Incluso tomando pastillas duermo menos de 6 horas'),3=>value(' (3) Incluso tomando pastillas duermo menos de 4 horas '),4=>value(' (4) Incluso tomando pastillas duermo menos de 2 horas '),5=>value(' (5) El dolor me impide totalmente dormir ')],['class' => 'form-control'])!!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('Levantar_peso','Levantar peso') !!}
                            <br><br>
                            {!! Form::select('Levantar peso',['Seleccione una respuesta',0 => value(' (0) Puedo levantar objetos pesados sin que me aumente el dolor') ,1=>value(' (1) Puedo levantar objetos pesados pero me aumenta el dolor  '),2=>value('  (2) El dolor me impide levantar objetos pesados del suelo, pero puedo hacerlo si están en un sitio cómodo (ej. en una mesa) '),3=>value(' (3) El dolor me impide levantar objetos pesados, pero sí puedo levantar objetos ligeros o medianos si están en un sitio cómodo'),4=>value(' (4) Sólo puedo levantar objetos muy ligeros'),5=>value(' (5) No puedo levantar ni elevar ningún objeto ')],['class' => 'form-control'])!!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('Actividad_sexual', 'Actividad sexual') !!}
                            <br><br>
                            {!! Form::select('Actividad_sexual',['Seleccione una respuesta',0 => value(' (0) Mi actividad sexual es normal y no me aumenta el dolor  ') ,1=>value(' (1) Mi actividad sexual es normal pero me aumenta el dolor '),2=>value(' (2) Mi actividad sexual es casi normal pero me aumenta mucho el dolor'),3=>value(' (3) Mi actividad sexual se ha visto muy limitada a causa del dolor '),4=>value(' (4) Mi actividad sexual es casi nula a causa del dolor  '),5=>value(' (5) El dolor me impide todo tipo de actividad sexual ')],['class' => 'form-control'])!!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('Andar', 'Andar') !!}
                            <br><br>
                            {!! Form::select('Andar',['Seleccione una respuesta',0 => value(' (0) El dolor no me impide andar ') ,1=>value(' (1) El dolor me impide andar más de un kilómetro '),2=>value(' (2) El dolor me impide andar más de 500 metros'),3=>value(' (3) El dolor me impide andar más de 250 metros'),4=>value(' (4) Sólo puedo andar con bastón o muletas '),5=>value(' (5) Permanezco en la cama casi todo el tiempo y tengo que ir a rastras al baño ')],['class' => 'form-control'])!!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('Vida_social', 'Vida social') !!}
                            <br><br>
                            {!! Form::select('Vida_social',['Seleccione una respuesta',0 => value(' (0) Mi vida social es normal y no me aumenta el dolor ') ,1=>value(' (0) Mi vida social es normal pero me aumenta el dolor '),2=>value('(2) El dolor no tiene no tiene un efecto importante en mi vida social, pero si impide mis actividades más enérgicas como bailar, etc.'),3=>value(' (3) El dolor ha limitado mi vida social y no salgo tan a menudo '),4=>value(' (4) El dolor ha limitado mi vida social al hogar '),5=>value(' (5) No tengo vida social a causa del dolor')],['class' => 'form-control'])!!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('Estar_sentado', 'Estar sentado') !!}
                            <br><br>
                            {!! Form::select('Estar_sentado',['Seleccione una respuesta',0 => value(' (0) Puedo estar sentado en cualquier tipo de silla todo el tiempo que quiera ') ,1=>value('(1) Puedo estar sentado en mi silla favorita todo el tiempo que quiera '),2=>value(' (2) El dolor me impide estar sentado más de una hora'),3=>value(' (3) El dolor me impide estar sentado más de media hora '),4=>value(' (4) El dolor me impide estar sentado más de 10 minutos '),5=>value(' (5) El dolor me impide estar sentado ')],['class' => 'form-control'])!!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('Viajar', 'Viajar') !!}
                            <br><br>
                            {!! Form::select('Viajar',['Seleccione una respuesta',0 => value(' (0) Puedo viajar a cualquier sitio sin que me aumente el dolor ') ,1=>value(' (1) Puedo viajar a cualquier sitio, pero me aumenta el dolor '),2=>value(' (2) El dolor es fuerte pero aguanto viajes de más de 2 horas '),3=>value(' (3) El dolor me limita a viajes de menos de una hora '),4=>value('  (4) El dolor me limita a viajes cortos y necesarios de menos de media hora'),5=>value(' (5) El dolor me impide viajar excepto para ir al médico o al hospital')],['class' => 'form-control'])!!}
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
