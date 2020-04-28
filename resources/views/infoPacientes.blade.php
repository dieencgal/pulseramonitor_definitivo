@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div id="myDiv">

                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Pacientes</div>

                <div class="panel-body">
                    @include('flash::message')


                    {!!     Form::submit('Información del paciente', ['class'=> 'btn btn-primary'])!!}


                    <br><br>
                    <table class="table table-striped table-bordered">

    <td style ="word-break:break-all;">
        <thead>
        <tr>

            <th>Fecha</th>
            <th>Distancia</th>
            <th>Frecuencia cardiaca media</th>
            <th>Frecuencia cardiaca max</th>
            <th>Frecuencia cardiaca min</th>
            <th>Velocidad media</th>
            <th>Velocidad max</th>
            <th>Velocidad min</th>
            <th>Velocidad min</th>
            <th>Recuento pasos</th>
            <th>Peso max</th>
            <th>Peso min</th>
            <th>Recuento de minutos activos</th>
            <th>Andar duración</th>
            <th>Dormir duracion</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $item)
            <tr>

                <td>{{$item->fecha}}</td>
                <td>{{$item->distancia}}</td>
                <td>{{$item->frec_cardiaca_media}}</td>
                <td>{{$item->frec_cardiaca_max}}</td>
                <td>{{$item->frec_cardiaca_min}}</td>
                <td>{{$item->velocidad_media}}</td>
                <td>{{$item->velocidad_max}}</td>
                <td>{{$item->velocidad_min}}</td>
                <td>{{$item->recuento_pasos}}</td>
                <td>{{$item->peso_medio}}</td>
                <td>{{$item->peso_max}}</td>
                <td>{{$item->peso_min}}</td>
                <td>{{$item->recuento_min_activos}}</td>
                <td>{{$item->andar_duracion}}</td>
                <td>{{$item->dormir_duracion}}</td>
            </tr>
        @endforeach
        </tbody>
</table>
                </div>
            </div>
        </div>
    </div>

        @endsection

