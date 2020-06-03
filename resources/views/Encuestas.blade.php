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



    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div id="myDiv">

                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Cuestionarios</div>

                <div class="panel-body">
                    @include('flash::message')





                    <br>

                    <a href="{{  url('/encuesta_nrspain') }}" class="btn btn-primary">NRS-Pain</a>
                    <div>
                        Evalúe el nivel de dolor que padece (Escala numérica según la intensidad del dolor)
                    </div>
                    <br><br>
                    <a href="{{ url('/encuesta_eqd5') }}" class="btn btn-primary">Cuestionario EQ-5D</a>
                    <div>
                    Evalúe su calidad de vida
                    </div>
                    <br><br>
                    <a href="{{  url('/encuesta_oswestry') }}" class="btn btn-primary">Cuestionario Oswestry</a>
                    <div>
                        Valoración del dolor y discapacidad
                    </div>
                    <br><br>




                </div>
            </div>
        </div>
    </div>

        @endsection

