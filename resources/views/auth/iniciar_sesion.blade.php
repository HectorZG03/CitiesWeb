<!doctype html>
<html lang="es" data-bs-theme="auto">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Sistema de inicio de sesión" />
    <title>Iniciar Sesión</title>

    <!-- Bootstrap + tus recursos Vite -->
    @vite(['resources/js/app.js', 'resources/css/index.css'])
</head>
<body class="bg-body-tertiary d-flex align-items-center justify-content-center vh-100">

    @include('partials.theme-icons')
    @include('partials.theme-toggle')

    <main class="card shadow-sm p-4" style="max-width: 400px; width: 100%;">
        <form method="POST" action="/login" class="text-center">
            @csrf

            <!-- Logo -->
            <img class="mb-3 rounded-circle" src="{{ asset('images/CityLogo.jpg') }}" alt="Logo" width="80" height="80">

            <!-- Título -->
            <h1 class="h4 mb-4 fw-semibold text-primary">Iniciar Sesión</h1>

            <!-- Mensajes de error -->
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show text-start" role="alert">
                    <strong>¡Error!</strong>
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Mensajes de éxito -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show text-start" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Campo Email -->
            <div class="form-floating mb-3">
                <input type="email" 
                       class="form-control @error('email') is-invalid @enderror" 
                       id="floatingInput" 
                       name="email"
                       placeholder="nombre@ejemplo.com"
                       value="{{ old('email') }}"
                       required
                       autofocus>
                <label for="floatingInput">Correo electrónico</label>
            </div>

            <!-- Campo Password -->
            <div class="form-floating mb-4">
                <input type="password" 
                       class="form-control @error('password') is-invalid @enderror" 
                       id="floatingPassword" 
                       name="password"
                       placeholder="Contraseña"
                       required>
                <label for="floatingPassword">Contraseña</label>
            </div>

            <!-- Botón de envío -->
            <button class="btn btn-primary w-100 py-2 fw-semibold" type="submit">
                <i class="bi bi-box-arrow-in-right me-1"></i> Ingresar
            </button>
        </form>
    </main>

</body>
</html>
