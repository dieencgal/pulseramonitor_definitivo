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
            height: 190px;
            width: 240px;

        }




    </style>

    <body>



    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Buenas</div>
                    <div class="card-body">
                        <form action="/cuestionarios" method="post">
                            <div class="form-group">
                                <label for="titulo">Titulo</label>
                                <input name="titulo" type="text" class="form-control" id="titulo" aria-describedby="tituloHelp" placeholder="Enter title">
                                <small id="tituloHelp" class="form-text text-muted">Dale a tu cuestionario un titulo que atraiga la atención.</small>
                            </div>
                            <div class="form-group">
                                <label for="proposito">Proposito</label>
                                <input name="proposito" type="text" class="form-control" id="proposito" aria-describedby="propositoHelp" placeholder="Enter title">
                                <small id="propositoHelp" class="form-text text-muted">Añadiendo un proposito incrementará la participación.</small>
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar cuestionario</button>
                        </form>
                    </div>

                </div>
            </div>


                        <a href="/cuestionarios/create" class="btn btn-dark">Crear nuevo cuestionario</a>
                    </div>

                    <br>


                </div>








@endsection


