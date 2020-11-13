<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

       <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <style>
        a{
            color: rgb(0,0,0,1);
            text-decoration: none;
            font-size: 20px;
        }
        a:hover{
            color: rgb(0,0,0,1);
        }
        #custom_link>li{
            /* color: rgb(0,0,0,0.5); */
            opacity: 0.6;
        }
        #user{
            text-decoration: none;
        }
        i{
            color: rgb(0,0,0,1);
        }
        span{
            color: rgb(0,0,0,1);
            font-size: 20px;
        }
        #custom_link>li:hover{
            color: rgb(236, 4, 4);
            opacity: 1;
            cursor: pointer;
            background-color: #CAEAEC;
        }
        .notification {
            background-color: none;
            /* color: white; */
            text-decoration: none;
            /* padding: 15px 26px; */
            position: relative;
            display: inline-block;
            /* border-radius: 2px; */
            }
            .notification .badge {
            position: absolute;
            top: -8px;
            right: -0px;
            padding: 5px 10px;
            font-size: 15px;
            font-weight: bold;
            border-radius: 60%;
            background: red;
            color: white;
            }
            .notification .badge-chat-icon {
            position: absolute;
            top: -18px;
            right: -15px;
            padding: 5px 10px;
            font-size: 20px;
            font-weight: bold;
            /* border-radius: 50%; */
            /* background: red; */
            color: red;
            }
    </style>
</head>
<body style="font-family: Sukhumvit Set;">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }} 
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                       
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif

                            {{-- <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li> --}}
                     @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4" style="padding:0!important;margin:0!important;" id='content'>
            <div class="row"style="padding:0!important;margin:0!important; height: 665px;">
                <div class="col-3" style="-moz-box-shadow: 3px 3px 3px #ECECEC;
-webkit-box-shadow: 3px 3px 3px #ECECEC;
box-shadow: 3px 3px 3px #ECECEC; padding:0!important;margin:0!important;" >
                    <ul class="navbar-nav mr-auto" id="custom_link">
                        @guest
                        @else
                        <li class="nav-item pl-3 pr-3">
                            <div style="display: flex; justify-content: space-between;align-items: center; height: 48px;">  
                            <div class="dropdown show">
                            <a class="dropdown-toggle" id="user"role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user fa-lg"></i> {{ Auth::user()->name }}({{ Auth::user()->username }})
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                            </div>
                            </div>
                        </li>
                        @endguest
                        {{-- <li class="nav-item pl-3 pr-3">
                            <div style="display: flex; justify-content: space-between;">                            
                                <a class="nav-link" href=""><i class="fas fa-inbox fa-lg"></i> Inbox</a>
                                <span class="nav-link text-muted">3</span>
                            </div>
                        </li> --}}
                        <li class="nav-item pl-3">
                            <div style="display: flex; justify-content: space-between; align-items: center;">                            
                                <a class="nav-link" href="{{url('/todo/insert_todo')}}"><i class="fas fa-calendar-plus fa-lg"></i> Create Todo</a>
                            </div>
                        </li>
                        <li class="nav-item pl-3">
                            <div style="display: flex; justify-content: space-between; align-items: center;">                            
                                <a class="nav-link" href="{{url('/todo/select_todo')}}"><i class="fas fa-calendar-plus fa-lg"></i> My Todo list</a>
                                <a href="#" class="notification">
                                    <i class="fa fa-bell fa-lg mr-3" style="font-size: 30px;"></i>
                                    <span class="badge">
                                        @if(session()->has('notify_data'))
                                                {{ session()->get('notify_data') }}
                                        @else
                                        {{$notify_data}}
                                        @endif
                                    </span>
                                 </a>
                            </div>
                        </li>
                         {{-- <li class="nav-item pl-3 pr-3">
                            
                            <div style="display: flex; justify-content: space-between;">                            
                                <a class="nav-link" href=""><i class="fas fa-address-book fa-lg"></i> Today</a>
                                <span class="nav-link text-muted">3</span>
                            </div>
                        </li>
                         <li class="nav-item pl-3 pr-3">
                            
                            <div style="display: flex; justify-content: space-between;">                            
                                <a class="nav-link" href=""><i class="fas fa-folder fa-lg"></i> Week</a>
                                <span class="nav-link text-muted">3</span>
                            </div>
                        </li>
                         <li class="nav-item pl-3 pr-3">
                            
                            <div style="display: flex; justify-content: space-between;">                            
                                <a class="nav-link" href=""><i class="fas fa-home fa-lg"></i> Home</a>
                                <span class="nav-link text-muted">3</span>
                            </div>
                        </li>
                         <li class="nav-item pl-3 pr-3">
                            
                            <div style="display: flex; justify-content: space-between;">                            
                                <a class="nav-link" href=""><i class="fas fa-image fa-lg"></i> Travel</a>
                                <span class="nav-link text-muted">3</span>
                            </div>
                        </li>
                         <li class="nav-item pl-3 pr-3">
                            
                            <div style="display: flex; justify-content: space-between;">                            
                                <a class="nav-link" href=""><i class="fas fa-copy fa-lg"></i> Wrok</a>
                                <span class="nav-link text-muted">3</span>
                            </div>
                        </li>
                         <li class="nav-item pl-3 pr-3">
                            
                            <div style="display: flex; justify-content: space-between;">                            
                                <a class="nav-link" href=""><i class="fas fa-question fa-lg"></i> Personal</a>
                                <span class="nav-link text-muted">3</span>
                            </div>
                        </li>
                         <li class="nav-item pl-3 pr-3">
                            
                            <div style="display: flex; justify-content: space-between;">                            
                                <a class="nav-link" href=""><i class="fas fa-user-friends"></i> Family</a>
                                <span class="nav-link text-muted">3</span>
                            </div>
                        </li>
                         <li class="nav-item pl-3 pr-3">
                            
                            <div style="display: flex; justify-content: space-between;">                            
                                <a class="nav-link" href=""><i class="fas fa-paper-plane fa-lg"></i> Inbox</a>
                                <span class="nav-link text-muted">3</span>
                            </div>
                        </li> --}}
                        <div class="mt-3" style="border-top: 1px solid #ECECEC;">
                         <li class="nav-item">
                            <a class="nav-link" style="padding-left: 130px;" href="">Create List+</a>
                        </li>
                        </div>
                    </ul>
                </div>    
            <div class="col-8">
                     @yield('content')
                </div>
            </div>
        </main>
        
    </div>
    
</body>
</html>

