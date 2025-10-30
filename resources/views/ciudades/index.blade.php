@extends('layouts.app')

@section('title', 'Ciudades del Mundo')


@section('content')
<div class="row">
    <div class="col-12">

        <!-- Título principal -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">🌎 Ciudades del Mundo</h2>
        </div>

        <!-- Mensajes de éxito o error -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Card: Formulario -->
        <div class="card shadow-sm mb-4 border-0">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Registrar Nueva Ciudad</h5>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('ciudades.store') }}" id="formCrear">
                    @csrf

                    <div class="row g-3">
                        <!-- País -->
                        <div class="col-md-6">
                            <label for="pais_nombre" class="form-label">País</label>
                            <select id="pais_nombre" name="pais_nombre"
                                    class="form-select @error('pais_nombre') is-invalid @enderror"
                                    required>
                                <option value="">Seleccione un país</option>
                                <!-- Opciones cargadas por JS -->
                            </select>
                            <div class="form-text">Los países se cargan desde la API de REST COUNTRIES</div>
                        </div>

                        <!-- Provincia -->
                        <div class="col-md-6">
                            <label for="provincia_nombre" class="form-label">Provincia/Estado</label>
                            <input type="text"
                                   id="provincia_nombre"
                                   name="provincia_nombre"
                                   class="form-control @error('provincia_nombre') is-invalid @enderror"
                                   value="{{ old('provincia_nombre') }}"
                                   placeholder="Ej: Querétaro"
                                   required>
                        </div>

                        <!-- Ciudad -->
                        <div class="col-md-6">
                            <label for="ciudad_nombre" class="form-label">Ciudad</label>
                            <input type="text"
                                   id="ciudad_nombre"
                                   name="ciudad_nombre"
                                   class="form-control @error('ciudad_nombre') is-invalid @enderror"
                                   value="{{ old('ciudad_nombre') }}"
                                   placeholder="Ej: Santiago de Querétaro"
                                   required>
                        </div>

                        <!-- Botón Guardar -->
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-sm btn-primary px-4">
                                <i class="bi bi-save me-1"></i> Guardar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Card: Tabla de Ciudades -->
        <div class="card shadow-sm border-0">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0">Ciudades Registradas</h5>
            </div>

            <div class="card-body">
                @if($ciudades->count() > 0)
                    @include('components.buscador')

                    <div class="table-responsive mt-3">
                        <table class="table table-striped table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Ciudad</th>
                                    <th>Provincia/Estado</th>
                                    <th>País</th>
                                    <th>Fecha Registro</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ciudades as $ciudad)
                                    <tr>
                                        <td>{{ $ciudad->id }}</td>
                                        <td>{{ $ciudad->nombre }}</td>
                                        <td>{{ $ciudad->provinciaEstado->nombre }}</td>
                                        <td>{{ $ciudad->provinciaEstado->pais->nombre }}</td>
                                        <td>{{ $ciudad->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            <button type="button"
                                                    class="btn btn-sm btn-warning"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalActualizar"
                                                    data-id="{{ $ciudad->id }}"
                                                    data-ciudad="{{ $ciudad->nombre }}"
                                                    data-provincia="{{ $ciudad->provinciaEstado->nombre }}"
                                                    data-pais="{{ $ciudad->provinciaEstado->pais->nombre }}">
                                                Editar
                                            </button>

                                            <button type="button"
                                                    class="btn btn-sm btn-danger"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalEliminarCiudad"
                                                    data-id="{{ $ciudad->id }}"
                                                    data-elemento-nombre="la ciudad '{{ $ciudad->nombre }}'"
                                                    data-url-eliminar="{{ route('ciudades.destroy', $ciudad->id) }}">
                                                Eliminar
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-info mb-0">
                        No hay ciudades registradas aún. ¡Agrega la primera!
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>
{{-- Modales --}}
@include('components.modal_actualizar')
@include('components.modal-eliminar', [
    'modalId' => 'modalEliminarCiudad',
    'titulo' => 'Confirmar Eliminación de Ciudad',
    'mensajeAdicional' => 'Se eliminará la ciudad y no se podrá recuperar.'
])

@endsection