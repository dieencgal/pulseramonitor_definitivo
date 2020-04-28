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
        text-transform: uppercase;
    }

    .m-b-md {
        margin-bottom: 30px;
    }
    .panel > .panel-heading {
        background-image: none;
        background-color: white;
        color: darkcyan;

    }



</style>

<body>



<div class="container">
<p>{{ session('status') }}</p>

<form method="POST" action="{{ url("import") }}" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
        <label for="file" class="control-label">CSV file to import</label>

        <input id="file" type="file" class="form-control" name="file" required>

        @if ($errors->has('file'))
            <span class="help-block">
        <strong>{{ $errors->first('file') }}</strong>
        </span>
        @endif

    </div>

    <p><button type="submit" class="btn btn-success" name="submit"><i class="fa fa-check"></i> Submit</button></p>

</form>
</div>
</body>



@endsection
