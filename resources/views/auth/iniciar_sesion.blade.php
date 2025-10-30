<!doctype html>
<html lang="es" data-bs-theme="auto">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Sistema de inicio de sesión" />
    <title>Iniciar Sesión</title>

    <!-- Vite CSS y JS -->
    @vite(['resources/js/app.js', 'resources/css/index.css'])

</head>
<body class="d-flex align-items-center py-4 bg-body-tertiary">

    @include('partials.theme-icons')

    @include('partials.theme-toggle')

    <!-- Formulario de login -->
    <main class="form-signin w-100 m-auto">
        <form method="POST" action="/login">
            @csrf
            
            <img class="mb-4" src="{{ asset('images/CityLogo.jpg') }}" alt="Logo" width="72" height="57"/>
            <h1 class="h3 mb-3 fw-normal">Por favor, inicia sesión</h1>
            
            <!-- Mensajes de error -->
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Mensajes de éxito -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Campo Email -->
            <div class="form-floating">
                <input type="email" 
                       class="form-control @error('email') is-invalid @enderror" 
                       id="floatingInput" 
                       name="email"
                       placeholder="name@example.com"
                       value="{{ old('email') }}"
                       required
                       autofocus/>
                <label for="floatingInput">Correo electrónico</label>
            </div>

            <!-- Campo Password -->
            <div class="form-floating">
                <input type="password" 
                       class="form-control @error('password') is-invalid @enderror" 
                       id="floatingPassword" 
                       name="password"
                       placeholder="Password"
                       required/>
                <label for="floatingPassword">Contraseña</label>
            </div>

            <!-- Remember Me -->
            <div class="form-check text-start my-3">
                <input class="form-check-input" 
                       type="checkbox" 
                       value="1" 
                       name="remember"
                       id="checkDefault"/>
                <label class="form-check-label" for="checkDefault">
                    Recuérdame
                </label>
            </div>

            <!-- Botón de envío -->
            <button class="btn btn-primary w-100 py-2" type="submit">Iniciar sesión</button>
            
            <!-- Info de credenciales de prueba -->
            <div class="mt-4 p-3 bg-light border rounded">
                <small class="text-muted d-block mb-2"><strong>Credenciales de prueba:</strong></small>
                <small class="text-muted d-block">📧 admin@example.com</small>
                <small class="text-muted d-block">🔑 password123</small>
                <hr class="my-2">
                <small class="text-muted d-block">📧 usuario@example.com</small>
                <small class="text-muted d-block">🔑 password123</small>
            </div>

            <p class="mt-4 mb-3 text-body-secondary text-center">&copy; 2017–2025</p>
        </form>
    </main>

</body>
</html>