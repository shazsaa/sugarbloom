<!doctype html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sugar Bloom</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <link rel="stylesheet" href="{{ asset('customer-assets/style.css') }}">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="https://kit.fontawesome.com/703c7fe880.js" crossorigin="anonymous"></script>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light" style="background-color: #f8fafc">
            <div class="container">
                <a class="navbar-brand fw-semibold navbar-logo fs-2" href="{{ url('/') }}">
                    Sugar Bloom
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
                        @if (Auth::user() && Auth::user()->isCustomer())
                            <li class = "nav-item">
                                <a class="nav-link d-flex align-items-center" href = "{{ route('cart.index') }}">
                                    <svg class="me-2"width="25" height="25" viewBox="0 0 30 30" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M0 1.68137C0 1.42644 0.10536 1.18195 0.292902 1.00169C0.480444 0.821425 0.734806 0.720154 1.00003 0.720154H4.00012C4.22319 0.720213 4.43984 0.791958 4.6156 0.923979C4.79137 1.056 4.91617 1.24072 4.97015 1.44876L5.78018 4.56502H29.0009C29.1477 4.56515 29.2927 4.59636 29.4256 4.65644C29.5585 4.71651 29.676 4.80397 29.7697 4.91261C29.8634 5.02124 29.9311 5.14839 29.968 5.28501C30.0048 5.42163 30.0099 5.56437 29.9829 5.7031L26.9828 21.0826C26.9399 21.3028 26.8183 21.5018 26.639 21.645C26.4597 21.7882 26.2339 21.8667 26.0008 21.8669H8.00025C7.7671 21.8667 7.54136 21.7882 7.36205 21.645C7.18273 21.5018 7.06112 21.3028 7.01822 21.0826L4.02012 5.73194L3.2201 2.64259H1.00003C0.734806 2.64259 0.480444 2.54132 0.292902 2.36105C0.10536 2.18079 0 1.9363 0 1.68137ZM6.20419 6.48746L8.83027 19.9445H25.1708L27.7969 6.48746H6.20419ZM10.0003 21.8669C8.93941 21.8669 7.92196 22.272 7.17179 22.9931C6.42163 23.7141 6.00019 24.6921 6.00019 25.7118C6.00019 26.7315 6.42163 27.7095 7.17179 28.4305C7.92196 29.1516 8.93941 29.5567 10.0003 29.5567C11.0612 29.5567 12.0787 29.1516 12.8288 28.4305C13.579 27.7095 14.0004 26.7315 14.0004 25.7118C14.0004 24.6921 13.579 23.7141 12.8288 22.9931C12.0787 22.272 11.0612 21.8669 10.0003 21.8669ZM24.0007 21.8669C22.9398 21.8669 21.9224 22.272 21.1722 22.9931C20.4221 23.7141 20.0006 24.6921 20.0006 25.7118C20.0006 26.7315 20.4221 27.7095 21.1722 28.4305C21.9224 29.1516 22.9398 29.5567 24.0007 29.5567C25.0616 29.5567 26.0791 29.1516 26.8293 28.4305C27.5794 27.7095 28.0009 26.7315 28.0009 25.7118C28.0009 24.6921 27.5794 23.7141 26.8293 22.9931C26.0791 22.272 25.0616 21.8669 24.0007 21.8669ZM10.0003 23.7894C10.5308 23.7894 11.0395 23.9919 11.4146 24.3524C11.7896 24.713 12.0004 25.2019 12.0004 25.7118C12.0004 26.2217 11.7896 26.7106 11.4146 27.0712C11.0395 27.4317 10.5308 27.6342 10.0003 27.6342C9.46986 27.6342 8.96114 27.4317 8.58605 27.0712C8.21097 26.7106 8.00025 26.2217 8.00025 25.7118C8.00025 25.2019 8.21097 24.713 8.58605 24.3524C8.96114 23.9919 9.46986 23.7894 10.0003 23.7894ZM24.0007 23.7894C24.5312 23.7894 25.0399 23.9919 25.415 24.3524C25.7901 24.713 26.0008 25.2019 26.0008 25.7118C26.0008 26.2217 25.7901 26.7106 25.415 27.0712C25.0399 27.4317 24.5312 27.6342 24.0007 27.6342C23.4703 27.6342 22.9616 27.4317 22.5865 27.0712C22.2114 26.7106 22.0007 26.2217 22.0007 25.7118C22.0007 25.2019 22.2114 24.713 22.5865 24.3524C22.9616 23.9919 23.4703 23.7894 24.0007 23.7894Z"
                                            fill="#1E1E1E" />
                                    </svg>
                                </a>
                            </li>

                            <li class = "nav-item d-flex align-items-center">
                                <span class="mx-4 vertical-line"></span>
                            </li>
                        @endif

                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link fw-medium" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link fw-medium" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fa-regular fa-user fa-xl"></i>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                                    @if (Auth::user() && Auth::user()->isAdmin())
                                        <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                            {{ __('Admin Panel') }}
                                        </a>
                                    @else
                                        <a class="dropdown-item" href="{{ route('orderHistory') }}">
                                            {{ __('History') }}
                                        </a>

                                        <a class="dropdown-item" href="{{ route('wishlist') }}">
                                            {{ __('Wishlist') }}
                                        </a>
                                    @endif

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

        <main class="py-4">
            @yield('content')
        </main>

        <footer class="text-center text-black" style="background-color: #f8fafc">
            <div class="container pt-4">
                <section class="mb-4 justify-content-between d-flex">
                    <div class="">
                        <a href="{{ route('home') }}" class="navbar-brand">
                            Sugar Bloom
                        </a>
                        <p class="text-muted"></p>
                        <div class="gap-4 d-flex align-items-center">
                            <a href="#"><i class="fa-brands fa-instagram fa-xl link-dark"></i></a>
                            <a href="#"><i class="fa-brands fa-facebook fa-xl link-dark"></i></a>
                            <a href="#"><i class="fa-brands fa-twitter fa-xl link-dark"></i></a>
                        </div>
                    </div>
                    <div class="gap-4 d-flex">
                        <div>
                            <h5>Information</h5>
                            <ul class="list-unstyled">
                                <li><a href="#"
                                        class="link-secondary link-underline link-underline-opacity-0">About</a></li>
                                <li><a href="#"
                                        class="link-secondary link-underline link-underline-opacity-0">Product</a></li>
                                <li><a href="#"
                                        class="link-secondary link-underline link-underline-opacity-0">Blog</a></li>
                            </ul>
                        </div>
                        <div>
                            <h5>Company</h5>
                            <ul class="list-unstyled">
                                <li><a href="#"
                                        class="link-secondary link-underline link-underline-opacity-0">Community</a>
                                </li>
                                <li><a href="#"
                                        class="link-secondary link-underline link-underline-opacity-0">Career</a></li>
                                <li><a href="#" class="link-secondary link-underline link-underline-opacity-0">Our
                                        Story</a></li>
                            </ul>
                        </div>
                        <div>
                            <h5>Contact</h5>
                            <ul class="list-unstyled">
                                <li><a href="#"
                                        class="link-secondary link-underline link-underline-opacity-0">Getting
                                        Started</a></li>
                                <li><a href="#"
                                        class="link-secondary link-underline link-underline-opacity-0">Pricing</a></li>
                                <li><a href="#"
                                        class="link-secondary link-underline link-underline-opacity-0">Resources</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </section>
            </div>

            <div class="p-3 text-center text-dark" style="background-color: #f8fafc">
                2024 All Right Reserved. Terms of use Sugar Bloom.
            </div>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    @yield('customJs')
</body>

</html>
