@extends('layouts.app')

@section('title', 'Bienvenida - Dashboard')

@push('styles')
<style>
    .welcome-card {
        margin-top: 2rem;
    }
</style>
@endpush

@section('content')
    <!-- Card de bienvenida -->
    <div class="row welcome-card">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-body text-center py-5">
                    <h1 class="display-4 mb-3">¡Bienvenido, {{ Auth::user()->name }}!</h1>
                    <p class="lead text-muted">Has iniciado sesión correctamente en el sistema.</p>
                    <hr class="my-4">
                    <p>Tu correo: <strong>{{ Auth::user()->email }}</strong></p>
                    <p class="text-muted">
                        <small>Última conexión: {{ now()->format('d/m/Y H:i:s') }}</small>
                    </p>
                </div>
            </div>
        </div>
    </div>

  <div class="col-md-4">
    <div class="card h-100 shadow-sm">
        <div class="card-body text-center">
            <div class="display-6 text-primary mb-3">🌍</div>
            <h5 class="card-title">Ciudades del Mundo</h5>
            <p class="card-text text-muted">Visualiza, registra, edita y elimina información de las ciudades del mundo.</p>
            <a href="{{ route('ciudades.index') }}" class="btn btn-primary">Ir a Ciudades</a>
        </div>
    </div>
</div>
@endsection