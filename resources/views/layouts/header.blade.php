<header>
            <nav class="bg-light border-bottom">
                <div class="container d-flex flex-wrap mb-1 mt-1">
                    <ul class="nav me-auto"></ul>
                    <ul class="nav">
                        @if (Auth::check())
                            <div class="btn-group">
                                <button class="btn btn-dark  btn-sm dropdown-toggle" type="button"
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
            <div class="p-4 bg-black text-white">
                <div class="container">
                    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">

                        <a href="/"
                            class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                            <img src="/img/Logo_OnlyT3ch-removebg.png"
                                    class="rounded-circle" width="55">
                            <span class="fs-3">{{ config('app.name') }}</span>
                        </a>

                        <form class="col-8 col-lg-4 mb-lg-0 me-lg-3" action="/search" method="get">
                            <input type="text" name="search" class="form-control form-control-dark" placeholder="Search..."
                                aria-label="Search">
                        </form>

                        <div>
                            <a type="button" class="btn btn-light md-lg-3" href="{{ url('/cart') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    class="bi bi-cart" viewBox="0 0 16 16">
                                    <path
                                        d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                </svg>
                                <span class="badge rounded-pill badge-notification bg-danger cart-count">
                                    0                        
                                </span>
                            </a>
                            
                        </div>
                        <div>   
                        <a type="button" class="btn btn-bg-black md-lg-3" href="{{ url('/wishlist') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white" class="bi bi-star-fill" viewBox="0 0 16 16">
                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                            </svg>
                            </button>
                            </a>
                            
                        </div>
                        <div>   
                        <a type="button" class="btn btn-bg-black" href="{{ url('/users') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white" class="bi bi-person-circle" viewBox="0 0 16 16">
                                     <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                </svg>
                            </button>
                            </a>
                            
                        </div>
                    </div>
                </div>
            </div>

            <nav class="py-4 bg-light border-bottom">
                <div class="catg d-flex justify-content-center">
                    <div class= "ms-3 me-3">
                        <a class="d-flex flex-column fic text-dark text-decoration-none" href="/category/1" >
                            <div class="bgo d-flex justify-content-center">
                                <img src="/img/phone.jpeg" class="rounded-circle" width="70" height="70">
                            </div>
                            <span class="fw-bold text-sm-center">Smartphone</span>
                        </a>    
                    </div>
                    <div class= "ms-3 me-3">
                        <a class="d-flex flex-column fic text-dark text-decoration-none" href="/category/2" >
                            <div class="bgo d-flex justify-content-center">
                                <img src="/img/tablet.webp" class="rounded-circle" width="80" height="70">
                            </div>
                            <span class="fw-bold text-sm-center">Tablets</span>
                        </a>    
                    </div>
                    <div class= "ms-3 me-3 ">
                        <a class="d-flex flex-column fic text-dark text-decoration-none" href="/category/3" >
                            <div class="bgo d-flex justify-content-center">
                                <img src="/img/pc.jpg" class="rounded-circle" width="70" height="70">
                            </div>
                            <span class="fw-bold text-sm-center">Computers</span>
                        </a>    
                    </div>
                    <div class= "ms-3 me-3 ">
                        <a class="d-flex flex-column fic text-dark text-decoration-none" href="/category/4" >
                            <div class="bgo d-flex justify-content-center">
                                <img src="/img/acc.png" class="rounded-circle" width="70" height="70">
                            </div>
                            <span class="fw-bold text-sm-center">Accessories</span>
                        </a>    
                    </div>
                </div>
            </nav>
         
        </header>