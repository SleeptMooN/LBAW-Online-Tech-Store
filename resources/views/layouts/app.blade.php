<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> --}}

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body>
    <main>
        {{-- Start Header Section --}}
        <header>
            <nav class="bg-light border-bottom">
                <div class="container d-flex flex-wrap mb-1 mt-1">
                    <ul class="nav me-auto"></ul>
                    <ul class="nav">
                        @if (Auth::check())
                            <div class="btn-group">
                                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ url('/users') }}"> Profile</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/orders') }}"> Orders</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/wishlist') }}"> Wishlist</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/logout') }}"> Logout</a></li>
                                </ul>
                            </div>
                        @else
                            <li class="nav-item">
                                <a type="button" href="{{ url('/login') }}" class="btn btn-light btn btn-outline-dark me-1">Login</a>
                            </li>
                            <li class="nav-item">
                                <a type="button" href="{{ url('/register') }}" class="btn btn-warning">Sign-up</a>
                            </li>
                        @endif


                    </ul>
                </div>
            </nav>
            <div class="p-3 bg-dark text-white">
                <div class="container">
                    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">

                        <a href="/"
                            class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="32" fill="currentColor"
                                class="bi bi-cpu mr" viewBox="0 0 16 16">
                                <path
                                    d="M5 0a.5.5 0 0 1 .5.5V2h1V.5a.5.5 0 0 1 1 0V2h1V.5a.5.5 0 0 1 1 0V2h1V.5a.5.5 0 0 1 1 0V2A2.5 2.5 0 0 1 14 4.5h1.5a.5.5 0 0 1 0 1H14v1h1.5a.5.5 0 0 1 0 1H14v1h1.5a.5.5 0 0 1 0 1H14v1h1.5a.5.5 0 0 1 0 1H14a2.5 2.5 0 0 1-2.5 2.5v1.5a.5.5 0 0 1-1 0V14h-1v1.5a.5.5 0 0 1-1 0V14h-1v1.5a.5.5 0 0 1-1 0V14h-1v1.5a.5.5 0 0 1-1 0V14A2.5 2.5 0 0 1 2 11.5H.5a.5.5 0 0 1 0-1H2v-1H.5a.5.5 0 0 1 0-1H2v-1H.5a.5.5 0 0 1 0-1H2v-1H.5a.5.5 0 0 1 0-1H2A2.5 2.5 0 0 1 4.5 2V.5A.5.5 0 0 1 5 0zm-.5 3A1.5 1.5 0 0 0 3 4.5v7A1.5 1.5 0 0 0 4.5 13h7a1.5 1.5 0 0 0 1.5-1.5v-7A1.5 1.5 0 0 0 11.5 3h-7zM5 6.5A1.5 1.5 0 0 1 6.5 5h3A1.5 1.5 0 0 1 11 6.5v3A1.5 1.5 0 0 1 9.5 11h-3A1.5 1.5 0 0 1 5 9.5v-3zM6.5 6a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3z" />
                            </svg>
                            <span class="fs-4">{{ config('app.name') }}</span>
                        </a>


                        <form class="col-8 col-lg-4 mb-3 mb-lg-0 me-lg-3" action="/" method="GET">
                            <input type="text" name="search" class="form-control form-control-dark" placeholder="Search..."
                                aria-label="Search">
                        </form>

                        <div>
                            <a type="button" class="btn btn-light" href="{{ url('/cart') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    class="bi bi-cart" viewBox="0 0 16 16">
                                    <path
                                        d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                </svg>
                                <span class="badge rounded-pill badge-notification bg-danger">
                                    0                        
                                </span>
                            </a>
                            
                        </div>
                    </div>
                </div>
            </div>

            <nav class="py-2 bg-light border-bottom">
                <div class="container d-flex flex-wrap">
                    <ul class="nav me-auto">
                        
                    </ul>
                    <ul class="nav">
                        <li class="nav-item"><a href="#" class="nav-link link-dark px-2">Contact us: +351
                            9333333</a>
                        </li>
                    </ul>
                </div>
            </nav>
         
        </header>
        {{-- End Header Section --}}

        {{-- Main page content --}}
        <section id="content">
            @yield('content')
        </section>
        {{-- End page content --}}

        {{-- Start footer here --}}
        <footer>
            <div class="container">
                <footer class="d-flex flex-wrap justify-content-between align-items-center py-4 my-4 border-top">
                    <p class="col-md-4 mb-0 text-muted">&copy; 2022 OnlyT3ch, Ltd</p>
                    <a href="/"
                        class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">

                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="22" fill="currentColor"
                                class="bi bi-house" viewBox="0 0 16 16">
                                <path
                                    d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5ZM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5 5 5Z" />
                            </svg>
                    </a>
                    <ul class="nav col-md-4 justify-content-end">
                        <li class="nav-item"><a href="{{ URL::to('faq') }}" class="nav-link px-2 text-muted">FAQ</a></li>
                        <li class="nav-item"><a href="{{ URL::to('terms') }}" class="nav-link px-2 text-muted">Terms and Conditions</a></li>
                        <li class="nav-item"><a href="{{ URL::to('about') }}" class="nav-link px-2 text-muted">About</a></li>
                        <li class="nav-item"><a href="{{ URL::to('contact') }}" class="nav-link px-2 text-muted">Contact</a></li>
                    </ul>
                </footer>
            </div>
        </footer>
        {{-- End footer here --}}
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>
