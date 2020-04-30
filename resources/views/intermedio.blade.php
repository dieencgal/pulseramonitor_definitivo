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
            height: 100vh;com
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
        .links > a {
             color: black;
             /*#636b6f;*/
             padding: 0 25px;
             font-size: 12px;
             font-weight: 600;
             letter-spacing: .1rem;
             text-decoration: none;
             text-transform: uppercase;
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
            padding: 0px;
            font-size: 15px;
            font-weight: 700;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform:initial;

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
            font-size: 20px;
            font-weight: 600;
            color: black;

        }
        .gallery li {
            display: inline;
            list-style: none;
            width: 100px;
            min-height: 100px;
            float: left;
            margin: 0 10px 10px 0;
            text-align: center;
            position: center;
        }
        div.box {
            border: 1px darkcyan;
            height: 2000px;
            width: 2000px;
            background: darkcyan;
            display: table-cell;
            vertical-align: initial;
            horiz-align: center;
        }
        .box img {
            display:compact;
            margin: fill;
            horiz-align: center;
            vertical-align: center;
            height: 250px;
            width: 410px;

        }




    </style>

    <body>



    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div id="myDiv">

                </div>
            </div>
            <div class="box">

            <div class="panel panel-default">
                <div class=" panel panel-dos">
                    <br>
                    En los siguientes enlaces tiene acceso a gráficas comparativas según los datos que desee comparar
                </div>

            <br>

                <div class="links">

                    Acceda a la comparación de sus datos frente a otros pacientes según
                    la media de pasos andados al día en los últimos 15 días pinchando <a href="{{  url('grafica') }}" >aquí</a>
                <br><br>
                    Acceda a la comparación de sus recuento de pasos antes y despúes de la operación para comprobar sus avances <a href="{{  url('grafica2') }}" >aquí</a>.

                    <br><br>
                    Acceda a la comparación de su frecuencia cardíaca media antes y despúes de la operación para comprobar sus avances <a href="{{  url('grafica3') }}" >aquí</a>.

                    <br><br>
                    Acceda a la comparación de sus horas de sueño antes y despúes de la operación para comprobar sus avances <a href="{{  url('grafica4') }}" >aquí</a>.
                    <br><br>
            </div>
            </div>
                <div class="col-md-8 col-md-offset-3">


                <img src="img/podium.png" />

            </div>
            </div>

        </div>
    </div>



@endsection


