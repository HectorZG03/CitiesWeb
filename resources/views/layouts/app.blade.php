<!doctype html>
<html lang="es" data-bs-theme="auto">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Dashboard')</title>
    
    @vite(['resources/js/app.js'])
    
    <style>
        .dashboard-container {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .navbar-brand {
            font-weight: 600;
        }
        .bi {
            vertical-align: -0.125em;
            fill: currentColor;
        }
    </style>
    
    @stack('styles')
</head>
<body data-bs-theme="auto">
    
    @include('partials.theme-icons')

    <div class="dashboard-container">
        <!-- Navbar sin toggle ni dropdown -->
        <nav class="navbar navbar-dark bg-dark">
            <div class="container-fluid d-flex justify-content-between align-items-center">

                <!-- 🔹 Logo + Dashboard + Menú Principal -->
                <div class="d-flex align-items-center">
                    <a class="navbar-brand d-flex align-items-center me-3" href="{{ route('bienvenida') }}">
                        <img src="{{ asset('images/CityLogo.jpg') }}" alt="Logo" width="30" height="24" class="me-2">
                        Dashboard
                    </a>
                    <a class="nav-link text-white" href="{{ route('bienvenida') }}">
                        <i class="bi bi-house-door"></i> Menú Principal
                    </a>
                </div>

                <!-- 🔹 Lado derecho: usuario + cerrar sesión -->
                <ul class="navbar-nav flex-row align-items-center mb-0">
                    <li class="nav-item me-3">
                        <span class="nav-link text-white">
                            <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                        </span>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-light btn-sm">
                                <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>

        @include('partials.theme-toggle')

        <!-- Contenido principal -->
        <main class="flex-grow-1">
            <div class="container mt-5">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    @stack('scripts')
</body>
</html>
