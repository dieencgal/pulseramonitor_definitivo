@extends('layouts.app')

@section('content')
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
                            {!! Form::select('Movilidad', ['No tengo problemas para caminar','Tengo algunos problemas para caminar','Tengo que estar en la cama'], ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('Cuidado_personal', 'Cuidado personal') !!}
                            {!! Form::select('Cuidado_personal',['No tengo problemas con el cuidado personal','Tengo algunos problemas para lavarme o vestirme solo','Soy incapaz de lavarme o vestirme solo'],['class'=>'form-control'])!!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('Actividades_dia', 'Actividades del día a día') !!}
                            {!! Form::select('Actividades_dia',['No tengo problemas para realizar mis actividades de todos los días','Tengo algunos problemas para realizar mis actividades de todos los días','Soy incapaz de realizar mis actividades de todos los días'],['class'=>'form-control'])!!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('Dolor_malestar', 'Dolor/Malestar') !!}
                            {!! Form::select('Dolor_malestar',['No tengo dolor ni malestar','Tengo moderado dolor o malestar','Tengo mucho dolor o malestar'],['class'=>'form-control'])!!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('Ansiedad_depresion', 'Ansiedad/Depresión') !!}
                            {!! Form::select('Ansiedad_depresion',['No estoy ansioso/a ni deprimido/a','Estoy moderadamente ansioso/a o deprimido/a','Estoy muy ansioso/a o deprimido/a'],['class'=>'form-control'])!!}
                        </div>
                        <div class="form-group">
                            {!!Form::label('paciente_id', 'Paciente') !!}

                            {!! Form::text('paciente_id', Auth::user()->id-1) !!}
                        </div>



                        {!! Form::submit('Guardar',['class'=>'btn-primary btn']) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
