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
        .col-md-4{
            background-color: white;
            margin-bottom: 3px;
        }



    </style>



    </div>
    <!doctype html>
    <html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel Charts</title>
    </head>
    <body>
    <div class="container">
        <h1 style="text-align: center;"></h1>
        <br>
        {!! $chart->html() !!}

    </div>

    {!! Charts::scripts() !!}
    {!! $chart->script() !!}

    </body>
    </html>
    </div>
    </div>
    </div>
    <!doctype html>
    <html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel Charts</title>
    </head>
    <body>
    <div class="container">
        <h1 style="text-align: center;"></h1>
        <br>
        {!! $chart2->html() !!}

    </div>

    {!! Charts::scripts() !!}
    {!! $chart2->script() !!}

    </body>
    </html>
    </div>
    </div>
    </div>
    <!doctype html>
    <html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel Charts</title>
    </head>
    <body>
    <div class="container">
        <h1 style="text-align: center;"></h1>
        <br>
        {!! $chart3->html() !!}

    </div>

    {!! Charts::scripts() !!}
    {!! $chart3->script() !!}

    </body>
    </html>
    <!doctype html>
    <html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel Charts</title>
    </head>
    <body>
    <div class="container">
        <h1 style="text-align: center;"></h1>
        <br>
        {!! $usersChart->html() !!}

    </div>

    {!! Charts::scripts() !!}
    {!! $usersChart->script() !!}

    </body>
    </html>
    <br><br>
    </div>
    </div>
    </div>



@endsection


