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




    @if(Auth::user()->hasRole('admin'))
        <li>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Editar paciente</div>

                        <div class="panel-body">
                            @include('flash::message')

                            {!! Form::model($paciente, [ 'route' => ['pacientes.update',$paciente->id], 'method'=>'PUT']) !!}

                            <div class="form-group">
                                {!! Form::label('nombre', 'Nombre del paciente') !!}
                                {!! Form::text('nombre',$paciente->name,['class'=>'form-control', 'required', 'autofocus']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('apellidos', 'Apellidos del paciente') !!}
                                {!! Form::text('apellidos',$paciente->apellidos,['class'=>'form-control', 'required']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('edad', 'edad del paciente') !!}
                                {!! Form::text('edad',null,['class'=>'form-control', 'required']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('peso', 'peso del paciente') !!}
                                {!! Form::text('peso',null,['class'=>'form-control', 'required']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('sexo', 'sexo del paciente') !!}
                                {!! Form::text('sexo',null,['class'=>'form-control', 'required']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('altura', 'altura del paciente') !!}
                                {!! Form::text('altura',null,['class'=>'form-control', 'required']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('operacion', 'Patología') !!}
                                {!! Form::text('operacion',null,['class'=>'form-control', 'required']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('fecha_operacion', 'Fecha y hora de la operación') !!}

                                <input type="datetime-local" id="fecha_operacion" name="fecha_operacion" class="form-control"
                                       value="{{Carbon\Carbon::createFromDate($paciente->fecha_operacion)->format('Y-m-d\TH:i')}}"/>
                            </div>
                            <div class="form-group">
                                {!! Form::label('tipo_paciente', 'Tipo de dispositivo') !!}
                                {!! Form::text('tipo_paciente',null,['class'=>'form-control', 'required']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('medico_id', 'medico del paciente') !!}
                                {!! Form::text('medico_id',null,['class'=>'form-control', 'required']) !!}
                            </div>
                            {!! Form::submit('Guardar',['class'=>'btn-primary btn']) !!}

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </li>
    @else
        <div class="panel-heading">Solo puede editar los datos un médico.</div>
    @endif

@endsection
