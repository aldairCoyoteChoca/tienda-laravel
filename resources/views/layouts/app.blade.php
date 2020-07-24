<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>

    <link rel="dns-prefetch" href="{{ url('//fonts.gstatic.com')}}">
    <link href="{{ url('https://fonts.googleapis.com/css?family=Nunito')}}" rel="stylesheet">
    <link href="{{ asset('css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ url('https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i')}}" rel="stylesheet">
    <link href="{{ asset('bootstrap-fileinput/css/fileinput.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/style.css')}}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css')}}" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <div>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('index')}}">Productos</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item ">
                            <span id="cart_details" class="badge badge-secondary">
                            @if(auth()->user())
                                {{auth()->user()->cart->details->sum('quantify')}}
                            @else
                              0  
                            @endif
                            </span>
                            <a class="nav-link float-left" href="{{route('carshop')}}">
                                <span style="font-size: 2rem">
                                    <i class="fas fa-shopping-cart "></i>   
                                </span>
                            </a>
                        </li>
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <span class="mr-2 d-none d-lg-inline text-gray-600 small">@isset(auth()->user()->name) {{ auth()->user()->name }} @endisset</span>
                                @isset(auth()->user()->photo)
                                <img class="img-profile rounded-circle imgRedonda" src="{{ asset(Auth::user()->photo) }}"  >
                                @endisset
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                @can('products.index')
                                <a class="dropdown-item" href="{{route('admin.pedidos')}}">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Admin
                                </a>
                                @endcan
                                <a class="dropdown-item" href=" {{route('perfil')}} ">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Perfil
                                </a>
                                <a class="dropdown-item" href=" {{route('pedidos')}} ">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Mis pedidos
                                </a>
                              <div class="dropdown-divider"></div>
                              
                              <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                
                            </div>
                          </li>
                          @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            @if (session('info'))
            <div class="container">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="alert alert-success" role="alert">
                            {{ session('info') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @if(count($errors))
            <div class="container">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            @foreach ($errors->all() as $error)
                            <ul>
                                <li>
                                    {{ $error }}
                                </li>
                            </ul>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @yield('content')
        </main>
        <script src="{{ asset('js/jquery.min.js')}}"></script>
        <script src="{{ asset('js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{ asset('js/jquery.easing.min.js')}}"></script>
        <script src="{{ asset('js/sb-admin-2.min.js')}}"></script>
        <script src="{{ asset('bootstrap-fileinput/js/fileinput.min.js')}}"></script>
        <script src="{{ asset('bootstrap-fileinput/js/locales/es.js')}}"></script>
        <script src="{{ asset('bootstrap-fileinput/themes/fas/theme.min.js')}}"></script>
        <script src="{{ asset('js/index.js') }}"></script>
        @yield('scripts')
        @include('sweetalert::alert')
        <script src="{{ url('https://cdn.jsdelivr.net/npm/sweetalert2@9')}}"></script>
    </div>
</body>
</html>
