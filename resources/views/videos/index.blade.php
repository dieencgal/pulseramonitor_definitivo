@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Vídeos</div>

                    <div class="panel-body">
                        @include('flash::message')
                        {!! Form::open(['route' => 'videos.create', 'method' => 'get']) !!}
                        {!!     Form::submit('Asignar vídeo', ['class'=> 'btn btn-primary'])!!}
                        {!! Form::close() !!}

                        <br><br>
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>URL</th>
                                <th>Paciente</th>

                                <th colspan="2">Acciones</th>
                            </tr>

                            @foreach ($videos as $video)


                                <tr>
                                    <td>{{ $video->url }}</td>
                                    <td>{{ $video->paciente->full_name}}</td>
                                    <td>
                                        {!! Form::open(['route' => ['videos.edit',$video->id], 'method' => 'get']) !!}
                                        {!!   Form::submit('Editar', ['class'=> 'btn btn-warning'])!!}
                                        {!! Form::close() !!}
                                    </td>
                                    <td>
                                        {!! Form::open(['route' => ['videos.destroy',$video->id], 'method' => 'delete']) !!}
                                        {!!   Form::submit('Borrar', ['class'=> 'btn btn-danger' ,'onclick' => 'if(!confirm("¿Está seguro?"))event.preventDefault();'])!!}
                                        {!! Form::close() !!}

                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
@endsection
