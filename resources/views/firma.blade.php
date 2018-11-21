<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CloudBucket') }}</title>

    <!-- Styles -->
    <link href="{{asset('img/ico.ico')}}" rel="shortcut icon" type="image/x-icon" />
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">    
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        <br>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <img style="height:80px; width:80px;"class="logo" src="{{ asset('img/logo.png')}}" alt="">
                    <a class="navbar-brand" href="">
                        <p class="text-white"><b>CloudBucket</b></p>
                    </a>
                </div>

                <div class="panel-body">
                   Hola {{$user['name']}}, tu firma CloudBucket es: {{$user['firma']}}
                </div>
            </div>
        </div>
    </div>
</div>
<script
    src="https://code.jquery.com/jquery-2.2.4.js"
    integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
    crossorigin="anonymous">
    </script>
    
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/zxcvbn-bootstrap-strength-meter.js') }}"></script>
    <script src="{{ asset('js/star-rating-show.js') }}"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js"
    integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" 
    crossorigin="anonymous"></script>
</body>
</html>