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
            color: black;
            font-size: 17px;
            font-weight: 600;


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
            border: 1px white;
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
            horiz-align: left;
            vertical-align: center;
            height: 200px;
            width: 310px;
            background: darkcyan;
            text-transform: uppercase;
            font-size: 12px;
            font-weight: 600;

        }





    </style>
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div id="myDiv">

                </div>
            </div>


            <div class="panel panel-default">
                <div class="panel-heading">Vídeos recomendados</div>

                <div class="panel-body">


                    <br><br>

                    <table class="table table-striped table-bordered">
                        <tr>
                            <th>Vídeo</th>


                        </tr>



                        @foreach ($videos as $video)


                            <tr>
                              <td>  <iframe width="620" height="315" src={!! $video->url !!} frameborder="0" allowfullscreen></iframe>  </td>


                            </tr>
                        @endforeach
                    </table>








                </div>
    </div>
    </div>
    </div>



    @endsection












