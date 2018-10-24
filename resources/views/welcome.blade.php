@extends('layouts.app')

@section('content')
<div id="carousel-example-generic" class="carousel slide slider" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <img src="{{asset('img/slider1.jpg')}}" alt="...">
            <div class="carousel-caption">
                slider1
            </div>
        </div>
        <div class="item">
            <img src="{{asset('img/slider2.jpg')}}" alt="...">
            <div class="carousel-caption">
                Slider2
            </div>
        </div>
        <div class="item">
            <img src="{{asset('img/slider3.jpg')}}" alt="...">
            <div class="carousel-caption">
                Slider3
            </div>
        </div>
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <i class="left-icon fas fa-chevron-left"></i>
    </a>
    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <i class="right-icon fas fa-chevron-right"></i>
    </a>
</div>
<div class="spacing50"></div>
<div class="container">
    <h1 class="text-center text-prin">Acerca de</h1>
    <br>
    <div class="col-md-10 col-md-offset-1">
        <p class="text-justify text-black">Et voluptate dolor irure eu et enim ex velit eu ad. Eiusmod irure officia commodo reprehenderit et reprehenderit sunt pariatur deserunt aliquip ipsum sint qui. Laboris quis in occaecat reprehenderit labore laboris quis laborum consequat excepteur officia. Aute commodo enim veniam cupidatat cillum fugiat voluptate pariatur ex. Aute quis proident do id consectetur anim consequat et nulla sunt nostrud officia.</p>
    </div>
</div>
<div class="spacing50"></div>

<div class="container">
    <div class="col-md-10 col-md-offset-1"> 
        <div class="col-md-4">
            <div class="thumbnail services">
                <div class="spacing50"></div>
                <img class="icons" src="{{ asset('img/icon1.png')}}" alt="...">
                <h3 class="text-center text-sec">Titulo</h3>
                <hr>
                <br>
                <p class="text-center text-sec">Quis tempor non excepteur voluptate.</p>
                <div class="spacing50"></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="thumbnail services">
                <div class="spacing50"></div>
                <img class="icons" src="{{ asset('img/icon2.png')}}" alt="...">
                <h3 class="text-center text-sec">Titulo</h3>
                <hr>
                <br>
                <p class="text-center text-sec">Occaecat deserunt est elit velit.</p>
                <div class="spacing50"></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="thumbnail services">
                <div class="spacing50"></div>
                <img class="icons" src="{{ asset('img/icon3.png')}}" alt="...">
                <h3 class="text-center text-sec">Titulo</h3>
                <hr>
                <br>
                <p class="text-center text-sec">Fugiat sit aliquip adipisicing tempor aliqua.</p>
                <div class="spacing50"></div>
            </div>
        </div>
    </div>
</div>
<div class="spacing50"></div>
<div class="fondo-prin">
    <div class="container">
        <div class="col-md-6">
            <div class="spacing50"></div>
            <h1 class="text-white text-center">Cillum laboris.</h1>
            <div class="spacing50"></div>
            <p class="text-white text-center">Irure eiusmod tempor aute non aliqua ea sunt deserunt ea id duis amet. Non do tempor ea id consectetur sunt do ea cillum exercitation cillum ullamco reprehenderit proident. Sint dolor non id nostrud Lorem tempor sit ex ut anim. Culpa excepteur irure id sunt. Sunt nulla non commodo consequat aliqua aliquip id laboris elit ex veniam elit.</p>
            <br>
            <p class="text-white text-center">Enim ut proident laboris culpa eu adipisicing pariatur aliqua. Eiusmod est incididunt nostrud dolore deserunt. Labore reprehenderit ullamco esse aliquip id.</p>
            <div class="spacing50"></div>
        </div>
        <div class="col-md-6">
            <div class="spacing50"></div>
            <img class="img-responsive" src="{{asset('img/slider2.jpg')}}" alt="">
            <div class="spacing50"></div>
        </div>
    </div>
</div>
<br>
<div class="container">
    <h1 class="text-center">Irure excepteur cillum nulla quis magna deserunt.</h1>
    <div class="spacing50"></div>
    <p>Laboris irure cillum mollit aute enim id dolore qui aliqua. Magna magna labore ea labore amet culpa labore sint nisi incididunt. Officia velit in sit non cupidatat aliqua reprehenderit adipisicing fugiat fugiat Lorem. Et labore nisi eiusmod laborum labore.</p>
    <br>
    <p>Nostrud magna dolore nulla id. Est laboris fugiat magna anim laborum. Quis cillum quis mollit non tempor ad dolore qui amet laboris. Elit sunt sit consequat deserunt do dolor aliquip excepteur elit nostrud ex. Laboris cillum esse ad occaecat elit anim aliqua nulla non. Laboris cillum magna minim ullamco magna enim ex quis ex sint sit amet. Laboris laboris irure et voluptate cillum pariatur enim fugiat officia tempor velit veniam occaecat commodo.</p>
</div>
<div class="spacing50"></div>
<hr>
<div class="container">
<footer>
    <div class="spacing25"></div>
    <p class="float-right text-right"><a href="#">Back to top</a></p>
    <p>&copy; 2018 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
    <div class="spacing25"></div>
</footer>
</div>
@endsection