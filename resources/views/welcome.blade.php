<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <link href="{{ asset('js/materialize.min.js') }}" rel="stylesheet">


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    {{--    <link href="{{ asset('css/materialize.min.css') }}" rel="stylesheet">--}}
    {{--    <link href="{{ asset('css/materialize.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>--}}
    {{--<link href="{{ asset('css/font-awesome.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>--}}
    <link href="{{ asset('css/style2.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
    <style>
        .activem {
            background-color: #F2F2F2;
        }

        .rounded {
            object-fit: cover;
            border-radius: 50%;
            height: 150px;
            width: 150px;
        }
        .activem{
            background-color: #F2F2F2;
        }
    </style>
</head>
<body>
<div class="navbar-fixed" style="z-index: 9999">
    <nav class="white">
        <div class="container">


            <div class="nav-wrapper">
                <a class="btn-floating btn-small waves-effect waves-light  dropdown-trigger hide-on-large-only" href='#'
                   data-target='dropdown1'><i class="material-icons">arrow_drop_down_circle</i></a>
                <!-- Dropdown Structure -->
                <ul id='dropdown1' class='dropdown-content'>
                    <li class="activem"><a href="/">Home</a></li>
                    @auth
                        <li class="{{request()->segment(count(request()->segments())-1)=="user" ? "activem": ""}}"><a
                                    href="/user/{{\Illuminate\Support\Facades\Auth::id()}}">Profile</a></li>
                        @if(\Illuminate\Support\Facades\Auth::id()==29)
                            <li class="{{request()->segment(count(request()->segments())-1)=="dashboard" ? "activem": ""}}">
                                <a href="/dashboard">Dashboard</a></li>
                        @endif
                        <li><a href="/logout">Logout</a></li>
                    @endauth
                </ul>

                <a id="logo-container" href="#" class="brand-logo black-text">
                    <img src="{{asset('images/logo96black.png')}}" alt="" class="" style=" padding-top: 8%">
                </a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li class="activem"><a href="/">Home</a></li>
                    @auth
                        <li class="{{request()->segment(count(request()->segments())-1)=="user" ? "activem": ""}}"><a
                                    href="/user/{{\Illuminate\Support\Facades\Auth::id()}}">Profile</a></li>
                        @if(\Illuminate\Support\Facades\Auth::id()==29)
                            <li class="{{request()->segment(count(request()->segments())-1)=="dashboard" ? "activem": ""}}">
                                <a href="/dashboard">Dashboard</a></li>
                        @endif
                        <li><a href="/logout">Logout</a></li>
                    @endauth
                    @guest
                        <li><a href="#team">Team</a></li>
                        <li><a href="#">About</a></li>
                        <li class="{{request()->segment(count(request()->segments())-1)=="login" ? "activem": ""}}"><a
                                    href="/login">Login</a></li>
                    @endguest
                </ul>

            </div>

        </div>
    </nav>
</div>
<div id="index-banner" class="parallax-container">
    <div class="section no-pad-bot">
        <div class="container" >
            <br><br>
            <div class="row center" style="background: rgba(0, 0, 0, 0.4);">
                <h1 class="header center white-text">ALPR</h1>
                <h5 class="header col s12 right white-text">
                    Automatic Licence Plate Recognition Platform.
                </h5>
                {{--<h5 class="header col s12 light white-text">Automatic Licence Plate Recognition Platform</h5>--}}
            </div>
            @guest
                <div class="row center">
                    <a href="/register" class="btn-large waves-effect waves-light">Register</a>
                </div>
            @endguest
            <br><br>

        </div>
    </div>
    <div class="parallax"><img src="{{asset('/images/background1.jpg')}}" alt="Unsplashed background img 1"></div>
</div>


<div class="container" id="team">
    <div class="section ">
        <h4 class="center"><b>Team</b></h4>
        <!--   Icon Section   -->
        <div class="row">
            <div class="col s12 m3">
                <div class="card">
                    <div class="card-content ">
                        <div class="icon-block">
                            <div class="background center ">
                                <img src="{{asset('/images/oktay.jpg')}}" class="circle rounded">
                                <h6 class="name"><b>Ogtay Huseynov</b></h6>
                                {{--<h4 class="center "><i class="material-icons">flip_to_back</i></h4>--}}
                                <span class="center">Software Developer</span>
                                {{--<i class="material-icons">flip_to_back</i>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col s12 m3">
                <div class="card">
                    <div class="card-content ">
                        <div class="icon-block">
                            <div class="background center ">
                                <img src="{{asset('/images/nijat.jpg')}}" class="circle rounded">
                                <h6 class="name"><b>Nicat Hamidov</b></h6>
                                {{--<h4 class="center "><i class="material-icons">flip_to_back</i></h4>--}}
                                <span class="center">Frontend Developer </span>
                                {{--<i class="material-icons">flip_to_back</i>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col s12 m3">
                <div class="card">
                    <div class="card-content ">
                        <div class="icon-block">
                            <div class="background center ">
                                <img src="{{asset('/images/noh.jpg')}}" class="circle rounded">
                                <h6 class="name"><b>Nihad Atakishiyev</b></h6>
                                {{--<h4 class="center "><i class="material-icons">flip_to_back</i></h4>--}}
                                <span class="center">Backend Developer </span>
                                {{--<i class="material-icons">flip_to_back</i>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12 m3">
                <div class="card">
                    <div class="card-content ">
                        <div class="icon-block">
                            <div class="background center ">
                                <img src="{{asset('/images/darvud.jpg')}}" class="circle rounded">
                                <h6 class="name"><b>Davud Ismayilov</b></h6>
                                {{--<h4 class="center "><i class="material-icons">flip_to_back</i></h4>--}}
                                <span class="center">Database Administrator </span>
                                {{--<i class="material-icons">flip_to_back</i>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

    <div class="parallax-container valign-wrapper">
        <div class="section no-pad-bot">
            <div class="container">
                <div class="row center">
                    <h2 class="header col s12 right white-text" style="background: rgba(0, 0, 0, 0.7);">
                        A modern way to automation of car access to your property.
                    </h2>
                </div>
            </div>
        </div>
        <div class="parallax"><img src="{{asset('/images/alpr1.jpg')}}" alt="Unsplashed background img 2"></div>
    </div>

    <div class="container">
        <div class="section">
            <div class="row center">
                <h4><b>Features</b></h4>
            </div>
            <div class="row">
                <div class="col s12 m6 center">
                    <h6><b>Web Dashboard</b></h6>
                    <img src="{{asset('/images/home.png')}}" alt="Unsplashed background img 2"
                         width="450" style="border: 1px solid grey;border-radius: 4px">
                </div>
                <div class="col s12 m6 center">
                    <br/>
                    <br/>
                    <br/>
                    <h5 class="center-align " style="text-align: center; vertical-align: middle;"><b class="blue-text">Monitor</b> and <b class="blue-text">Manage</b>
                        all car and user activities through our web dashboard that reveal
                        the full log of any vehicle that entered to your property. </h5>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m6 center">
                    <br/>
                    <br/>
                    <br/>
                    <h5 class="center-align " style="text-align: center; vertical-align: middle;">
                        <b class="blue-text">Statistical Information</b>
                        provided with understandable graphs and charts.
                    </h5>
                </div>
                <div class="col s12 m6 center">
                    <h6><b>Statistic</b></h6>
                    <img src="{{asset('/images/LOG.png')}}" alt="Unsplashed background img 2"
                         width="450" style="border: 1px solid grey;border-radius: 4px">
                </div>

            </div>
            <div class="row">
                <div class="col s12 m6 center">
                    <h6><b>Car Licence Plate Recognition</b></h6>
                    <img src="{{asset('/images/rename.png')}}" alt="Unsplashed background img 2"
                         width="450" style="border: 1px solid grey;border-radius: 4px">
                </div>
                <div class="col s12 m6 center">
                    <br/>
                    <br/>
                    <br/>
                    <h5 class="center-align " style="text-align: center; vertical-align: middle;">
                        Car Licence Plate<b class="blue-text"> Recognition</b> and <b class="blue-text"> Access Check</b>
                        through web interface.
                    </h5>
                </div>

            </div>

        </div>
    </div>


    <div class="parallax-container valign-wrapper">
        <div class="section no-pad-bot">
            <div class="container">
                <div class="row center">
                    <h2 class="header col s12 right white-text" style="background: rgba(0, 0, 0, 0.7);">
                        A modern way to automation of car access to your property.
                    </h2>
                </div>
            </div>
        </div>
        <div class="parallax"><img src="{{asset('/images/background3.jpg')}}" alt="Unsplashed background img 3"></div>
    </div>

    <footer class="page-footer">
        <div class="container">
            <div class="row">
                <div class="col s12 center">
                    <h5 class="">Project Description</h5>
                    <p class="grey-text text-lighten-4">
                        Our project is taking car management system of properties with parking to the whole new level,
                        with detecting places of the car plates with the help of Haar cascade and
                        recognizing those characters by making use of Tesseract,
                        which triggers background process to check existing database and make decision on car entrance.
                    </p>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container center">
                Made by <a class=" text-lighten-3" href="#">thatfuture</a>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/materialize.min.js') }}" defer></script>
    <script src=" https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

    <script>
        M.AutoInit();
        document.addEventListener('DOMContentLoaded', function () {
            var elems = document.querySelectorAll('.modal');
            var instances = M.Modal.init(elems, options);
        });
    </script>
</body>
</html>
