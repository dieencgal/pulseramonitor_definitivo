@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Editar preguntas de la encuesta</div>

                    <div class="panel-body">
                        @include('flash::message')

                        {!! Form::model($show, [ 'route' => ['encuesta.update',$show->id], 'method'=>'PUT']) !!}

                        <div class="form-group">
                            {!! Form::label('pregunta', 'Pregunta') !!}
                            {!! Form::text('Pregunta',$show->pregunta,['class'=>'form-control', 'required', 'autofocus']) !!}
                        </div>


                        {!! Form::submit('Guardar',['class'=>'btn-primary btn']) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
