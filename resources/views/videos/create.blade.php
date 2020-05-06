@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Crear Vídeo</div>

                    <div class="panel-body">
                        @include('flash::message')
                        {!! Form::open(['route' => 'videos.store']) !!}

                        <div class="form-group">
                            {!! Form::label('url', 'URL del vídeo') !!}
                            {!! Form::text('url',null,['class'=>'form-control', 'required','autofocus']) !!}
                        </div>

                        <div class="form-group">
                            {!!Form::label('paciente_id', 'Paciente') !!}

                            {!! Form::text('paciente_id', null, ['class' => 'form-control','required','autofocus']) !!}
                        </div>


                        {!! Form::submit('Guardar',['class'=>'btn-primary btn']) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
