@extends('layouts.app')

@section('title', 'Bienvenida - Dashboard')

@section('content')
<div class="container my-5">
    <!-- Card de bienvenida -->
    <div class="row justify-content-center mb-5">
        <div class="col-lg-8">
            <div class="card shadow text-center">
                <div class="card-body py-4">
                    <h1 class="display-5 fw-bold mb-3">¡Bienvenido, {{ Auth::user()->name }}!</h1>
                    <p class="lead text-muted mb-4">Has iniciado sesión correctamente en el sistema.</p>
                    <hr class="w-50 mx-auto">
                    <p class="mb-1">Tu correo: <strong>{{ Auth::user()->email }}</strong></p>
                    <p class="text-muted mb-0">
                        <small>Última conexión: {{ now()->format('d/m/Y H:i:s') }}</small>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Card de Ciudades -->
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow-sm h-100 text-center">
                <div class="card-body">
                    <div class="fs-1 text-primary mb-3">🌍</div>
                    <h5 class="card-title fw-semibold">Ciudades del Mundo</h5>
                    <p class="card-text text-muted mb-4">
                        Visualiza, registra, edita y elimina información de las ciudades del mundo.
                    </p>
                    <a href="{{ route('ciudades.index') }}" class="btn btn-primary">
                        Ir a Ciudades
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
