<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sugar Bloom</title>

    <link rel="stylesheet" href="{{ asset('admin-assets/css/custom.css') }}">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="https://kit.fontawesome.com/703c7fe880.js" crossorigin="anonymous"></script>
</head>

<body>
    @include('admin.layouts.sidebar')

    <nav class="shadow-sm navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button class="btn btn-outline-secondary me-2" id="sidebarToggle"><i class="fas fa-bars"></i></button>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        <img src="{{ asset('admin-assets/img/user.png') }}" class="rounded-circle" width="40"
                            height="40" alt="User">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <p class="dropdown-header fs-5">{{ Auth::user()->name }}</p>
                            <small class="dropdown-item-text fs-6">{{ Auth::user()->email }}</small>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('home') }}">
                                {{ __('Home Page') }}
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a href="{{ route('logout') }}" class="dropdown-item text-danger"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <main class="content-wrapper">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    <script>
        const sidebarToggle = document.getElementById('sidebarToggle');
        const body = document.body;

        sidebarToggle.addEventListener('click', () => {
            document.getElementById('sidebar').classList.toggle('hidden');
            body.classList.toggle('collapsed-sidebar');
        });
    </script>

    @yield('customJs')
</body>

</html>
