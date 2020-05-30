@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Preguntas</div>

                    <div class="panel-body">
                        @include('flash::message')

                        {!! Form::open(['route' => 'encuesta.store']) !!}
                        <div class="form-group">
                            {!! Form::label('pregunta', 'Pregunta') !!}
                            {!! Form::text('pregunta',null,['class'=>'form-control', 'required','autofocus'])!!}

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
