@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div id="myDiv">

                </div>
            </div>


            <div class="panel panel-default">
                <div class="panel-heading">Registro del sueño</div>
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
    <h1 style="text-align: center;">Media de horas de sueño</h1>
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


@endsection


