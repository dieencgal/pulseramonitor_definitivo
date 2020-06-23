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
            margin: 0;


        }
        .panel > .panel-default{
            margin: 0;
            margin-left: 0;
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
        .container{
            margin-left: 10px;
        }
        .panel-heading{
            font-size: 20px;
            font-weight: bold;
            font-stretch: expanded;
        }



    </style>






                            <div class="container"style="width: 100%" >
                                <div class="row"style="width: 100%" >
                                    <div class="col-lg-12"style="width: 100%" >
                                        <div id="myDiv">
                                        </div>
                                    </div>
                                    <div class="panel panel-default" style="width: 100%">
                            <div class="panel-heading">Cuestionarios</div>

                            <div class="panel-body">
                                @include('flash::message')
                                <div class="panel-heading">Cuestionarios EQD5</div>




                                <table class="table table-responsive table-hover" width="100%">
                                    <td style ="word-break:break-all;">
                                        <thead>

                                        <tr>
                                            <th>Movilidad</th>
                                            <th>Cuidado-Personal</th>
                                            <th>Actividades del día a día</th>
                                            <th>Dolor/Malestar</th>
                                            <th>Ansiedad/Depresión</th>
                                            <th>ID del paciente</th>
                                            <th colspan="1">Acciones</th>
                                        </tr>
                                        </thead>

                                        @foreach ($show2 as $medico)


                                            <tr>
                                                <td>{{ $medico->Movilidad }}</td>
                                                <td>{{ $medico->Cuidado_personal }}</td>
                                                <td>{{ $medico->Actividades_dia }}</td>
                                                <td>{{ $medico->Dolor_malestar }}</td>
                                                <td>{{ $medico->Ansiedad_depresion }}</td>
                                                <td>{{ $medico->paciente_id}}</td>





                                                <td>
                                                    {!! Form::open(['route' => ['encuesta_eqd5.destroy',$medico->id], 'method' => 'delete']) !!}
                                                    {!!   Form::submit('Borrar', ['class'=> 'btn btn-danger' ,'onclick' => 'if(!confirm("¿Está seguro?"))event.preventDefault();'])!!}
                                                    {!! Form::close() !!}

                                                </td>
                                            </tr>
                                    @endforeach
                                </table>
                                <br>

                                            <div class="panel-heading">Cuestionarios OSWESTRY</div>

                                            <div class="panel-body">
                                                @include('flash::message')






                                                <table class="table table-responsive table-hover" width="100%">
                                                    <td style ="word-break:break-all;">
                                                        <thead>

                                                        <tr style="word-wrap: break-word">
                                                            <th width=2000px>Indique la intensidad de su dolor de
                                                                espalda (lumbar) en las últimas 4 semanas</th>
                                                            <th width=2000px>Indique la intensidad de su dolor de pierna (ciática) en las últimas 4 semanas</th>
                                                            <th width=2000px>Intensidad del dolor (generalizado)</th>
                                                            <th width=200px>Cuidados personales</th>
                                                            <th width=200px>Estar de pie</th>
                                                            <th width=200px>Dormir</th>
                                                            <th width=200px>Levantar peso</th>
                                                            <th width=200px>Actividad sexual</th>
                                                            <th width=200px>Andar</th>
                                                            <th width=200px>Vida social</th>
                                                            <th width=200px>Estar sentado</th>
                                                            <th width=200px>Viajar</th>
                                                            <th width=200px style="color:red">Resultado</th>
                                                            <th width=200px>ID del paciente</th>



                                                            <th colspan="1">Acciones</th>




                                                        </tr>
                                                        </thead>

                                                        @foreach ($show as $medico)


                                                            <tr>
                                                                <td>{{ $medico->Intensidad_dolor_espalda_lumbar_4sem }}</td>
                                                                <td>{{ $medico->Intensidad_dolor_pierna_ciatica_4sem }}</td>
                                                                <td>{{ $medico->Intensidad_dolor}}</td>
                                                                <td>{{ $medico->Cuidados_personales}}</td>
                                                                <td>{{ $medico->Estar_de_pie}}</td>
                                                                <td>{{ $medico->Dormir}}</td>
                                                                <td>{{ $medico->Levantar_peso}}</td>
                                                                <td>{{ $medico->Actividad_sexual}}</td>
                                                                <td>{{ $medico->Andar }}</td>
                                                                <td>{{ $medico->Vida_social }}</td>
                                                                <td>{{ $medico->Estar_sentado }}</td>
                                                                <td>{{ $medico->Viajar }}</td>
                                                                <td style="color:red">{{ $medico->Intensidad_dolor_espalda_lumbar_4sem + $medico->Intensidad_dolor_pierna_ciatica_4sem
                                                                + $medico->Intensidad_dolor + $medico->Cuidados_personales + $medico->Estar_de_pie +
                                                                 $medico->Dormir + $medico->Levantar_peso + $medico->Actividad_sexual + $medico->Andar +
                                                                 $medico->Vida_social + $medico->Estar_sentado + $medico->Viajar}}</td>

                                                                <td>{{ $medico->paciente_id }}</td>







                                                                <td>
                                                                    {!! Form::open(['route' => ['encuesta_oswestry.destroy',$medico->id], 'method' => 'delete']) !!}
                                                                    {!!   Form::submit('Borrar', ['class'=> 'btn btn-danger' ,'onclick' => 'if(!confirm("¿Está seguro?"))event.preventDefault();'])!!}
                                                                    {!! Form::close() !!}

                                                                </td>
                                                            </tr>
                                                    @endforeach
                                                </table>
                                                <br>
                                                <div class="panel-heading">Cuestionarios NRS-Pain</div>

                                                <div class="panel-body">
                                                    <table class="table table-responsive table-hover" >


                                                    <thead>



                                                    <th width=200px>Nivel de dolor</th>
                                                    <th width=200px>ID del paciente</th>
                                                    <th width=200px colspan="1">Acciones</th>




                                                    </tr>
                                                    </thead>

                                                    @foreach ($show3 as $medico)


                                                        <tr>
                                                            <td>{{ $medico->Nivel_dolor }}</td>

                                                            <td>{{ $medico->paciente_id }}</td>







                                                            <td>


                                                                {!! Form::open(['route' => ['encuesta_nrspain.destroy',$medico->id], 'method' => 'delete']) !!}
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
        </div>
                    </div>
            </div>
        </div>
    </div>


@endsection
