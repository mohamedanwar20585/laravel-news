<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title'){{ config('app.name', 'Laravel') }} </title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">


    <link rel="stylesheet" href="../layout/style.css">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>

<body>

    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm sticky-top">
            <div class="container">

                <a class="navbar-brand " href="{{ url('/') }}">
                    Home
                    {{-- {{ config('app.name', 'Laravel') }} --}}
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    {{-- @if (Auth::check()) --}}
                    <div class="dropdown m-1  ">
                        <button class="nav-link dropdown-toggle btn-sm " type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            News
                        </button>
                        <ul class="dropdown-menu">
                            <li class="nav-item px-2">
                                <a class="nav-link" href="{{ route('posts.index') }}">All News</a>
                            </li>

                            @foreach ($categories as $category)
                                <li class="nav-item px-2">
                                    <a class="nav-link"
                                        href="{{ route('categories.show', $category) }}">{{ $category->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    {{-- @else --}}
                    {{-- <a class="nav-link" href="{{ route('posts.index') }}">All News</a> --}}
                    {{-- @endif --}}

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->

                        <form class="d-flex" role="search">
                            <input class="form-control me-2  rounded-pill " type="search" placeholder="Search"
                                aria-label="Search">
                            <button class="btn btn-outline-secondary rounded-pill" type="submit">Search</button>
                        </form>
                        @if (Auth::check() && Auth::user()->id)
                            <div class="dropdown m-1  ">
                                <button class="btn btn-secondary dropdown-toggle btn-sm " type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Dashboard
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="nav-link text-success " href="{{ route('posts.create') }}">Create
                                            News</a></li>
                                    <li><a class="nav-link  " href="{{ route('categories.index') }}">Categories
                                            News</a>
                                    </li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </div>
                        @endif
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Sign Up') }}</a>
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

        <main class="py-1">
            @yield('content')
        </main>
    </div>
    <footer>

        <div class="container pt-5">
            <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">

                <p class="col-md-3 mb-0 text-body-secondary">© 2023 Company, Inc</p>

                <a href="/"
                    class="col-md-3 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                    <svg class="bi me-2" width="40" height="32">
                        <use xlink:href="#bootstrap"></use>
                    </svg>
                </a>

                <ul class="nav col-md-6 justify-content-end">
                    <li class="nav-item"><a class="nav-link px-2 text-body-secondary " href="{{ url('/') }}">
                            {{ config('app.name', 'Laravel') }}
                        </a></li>
                    <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Business</a>
                    </li>
                    <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Arts &
                            Culture</a>
                    </li>
                    <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Sports</a></li>
                    <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">ET Scenes</a>
                    </li>
                    <li class="nav-item">
                        <p class="float-end mb-1 px-4 text-body-secondary">
                            <a href="#">Back to top</a>
                        </p>
                    </li>
                </ul>

            </footer>
        </div>
    </footer>
    <script src="https://kit.fontawesome.com/925c7a81bd.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>


</html>
