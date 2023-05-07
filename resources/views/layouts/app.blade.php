<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    {{-- link css --}}
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }} ">

    <!-- adding custom css  -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }} ">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
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
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="d-flex" id="wrapper">


            <!-- /////////////////////////////////////////////////////////////////// -->

            <!-- Sidebar -->
            <div class="bg-white" id="sidebar-wrapper">
                <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom"><i
                        class="fa-solid fa-book-open-reader"></i>Library</div>
                <div class="list-group list-group-flush my-3">
                    <a href="{{ route('dashboard') }}"
                        class="list-group-item list-group-item-action bg-transparent second-text fw-bold"></i>Dashboard</a>
                    <a href="{{ route('authors') }}"
                        class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Authors</a>
                    <a href="{{ route('publishers') }}"
                        class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Publishers</a>
                    <a href="{{ route('categories') }}"
                        class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Categories</a>
                    <a href="{{ route('books') }}"
                        class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Books</a>
                    <a href="{{ route('students') }}"
                        class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Register
                        Students</a>
                    <a href="{{ route('book_issued') }}"
                        class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Issue Book</a>
                    <a href="{{ route('reports') }}"
                        class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Reports</a>
                    <a href="{{ route('settings') }}"
                        class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Settings</a>
                    <a href="#" onclick="document.getElementById('logoutForm').submit()"
                        class="list-group-item list-group-item-action bg-transparent text-danger fw-bold">Logout</a>
                </div>
            </div>
            <!-- /#sidebar-wrapper -->
            <!-- /////////////////////////////////////////////////////////////////// -->

            <!-- Page Content -->
            <div class="container" id="page-content-wrapper">


                @yield('content')



            </div>
        </div>
    </div>
    <!-- end of wrapper -->
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>

</body>

</html>
