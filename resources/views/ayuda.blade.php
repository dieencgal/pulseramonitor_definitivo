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
            background-color: darkcyan;
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
            text-transform: uppercase;
            font-size: 12px;
            font-weight: 600;
        }
        .box video {
            display:compact;
            margin: inherit;
            horiz-align: center;
            vertical-align: center;
            height: 600px;
            width: 910px;
            background: darkcyan;
            text-transform: uppercase;
            font-size: 12px;
            font-weight: 600;

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





                    <p>¿Cómo obtengo mis datos?:</p>
                    <video width="640" height="360" controls preload="none">

                        <source src="{{ asset('img/test.mp4') }}"  type="video/mp4" />

                    </video>




        </div>
    </div>



    @endsection












