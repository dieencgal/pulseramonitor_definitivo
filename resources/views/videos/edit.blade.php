@extends('layouts.app')

@section('content')
    @if(Auth::user()->hasRole('admin'))
        <li>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Editar vídeo</div>

                        <div class="panel-body">
                            @include('flash::message')

                            {!! Form::model($video, [ 'route' => ['videos.update',$video->id], 'method'=>'PUT']) !!}

                            <div class="form-group">
                                {!! Form::label('url', 'URL') !!}
                                {!! Form::text('url',$video->url,['class'=>'form-control', 'required', 'autofocus']) !!}
                            </div>

                            <div class="form-group">
                                {!!Form::label('paciente_id', 'Paciente') !!}
                                <br>
                                {!! Form::select('paciente_id', $pacientes, $video>paciente_id, ['class' => 'form-control']) !!}
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
