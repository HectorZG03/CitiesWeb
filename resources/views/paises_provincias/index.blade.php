@extends('layouts.app')

@section('title', 'Países y Provincias/Estados')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">
                <i class="bi bi-globe-americas"></i> Gestión de Países y Provincias/Estados
            </h2>

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

            <!-- Tabs -->
            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="paises-tab" data-bs-toggle="tab" data-bs-target="#paises" type="button">
                        <i class="bi bi-flag"></i> Países
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="provincias-tab" data-bs-toggle="tab" data-bs-target="#provincias" type="button">
                        <i class="bi bi-map"></i> Provincias/Estados
                    </button>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content" id="myTabContent">
                
                <!-- TAB PAÍSES -->
                <div class="tab-pane fade show active" id="paises" role="tabpanel">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="bi bi-flag"></i> Lista de Países</h5>
                        </div>
                        <div class="card-body">
                            @include('components.buscador', [
                                'id' => 'buscadorPaises',
                                'placeholder' => '🔍 Buscar país...'
                            ])

                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Provincias/Estados</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tablaPaises">
                                        @forelse($paisesPaginados as $pais)
                                            <tr>
                                                <td>{{ $pais->id }}</td>
                                                <td>{{ $pais->nombre }}</td>
                                                <td>
                                                    <span class="badge bg-info">
                                                        {{ $pais->provincias_estados_count }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <button class="btn btn-warning btn-sm" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#modalEditarPais"
                                                            data-id="{{ $pais->id }}"
                                                            data-nombre="{{ $pais->nombre }}">
                                                        <i class="bi bi-pencil"></i> Editar
                                                    </button>
                                                    <button class="btn btn-danger btn-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modalEliminarPais"
                                                            data-id="{{ $pais->id }}"
                                                            data-elemento-nombre="{{ $pais->nombre }}"
                                                            data-url-eliminar="{{ route('paises-provincias.pais.destroy', $pais->id) }}">
                                                        <i class="bi bi-trash"></i> Eliminar
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center text-muted">No hay países registrados</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            {{-- Paginación de Países --}}
                            <div class="mt-3">
                                {{ $paisesPaginados->links('components.paginacion') }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TAB PROVINCIAS/ESTADOS -->
                <div class="tab-pane fade" id="provincias" role="tabpanel">
                    <div class="card shadow-sm">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0"><i class="bi bi-map"></i> Lista de Provincias/Estados</h5>
                        </div>
                        <div class="card-body">
                            @include('components.buscador', [
                                'id' => 'buscadorProvincias',
                                'placeholder' => '🔍 Buscar provincia/estado...'
                            ])

                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>País</th>
                                            <th>Ciudades</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tablaProvincias">
                                        @forelse($provinciasPaginadas as $provincia)
                                            <tr>
                                                <td>{{ $provincia->id }}</td>
                                                <td>{{ $provincia->nombre }}</td>
                                                <td>{{ $provincia->pais->nombre }}</td>
                                                <td>
                                                    <span class="badge bg-info">
                                                        {{ $provincia->ciudades->count() }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <button class="btn btn-warning btn-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modalEditarProvincia"
                                                            data-id="{{ $provincia->id }}"
                                                            data-nombre="{{ $provincia->nombre }}"
                                                            data-pais-id="{{ $provincia->pais->id }}"
                                                            data-pais-nombre="{{ $provincia->pais->nombre }}">
                                                        <i class="bi bi-pencil"></i> Editar
                                                    </button>
                                                    <button class="btn btn-danger btn-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modalEliminarProvincia"
                                                            data-id="{{ $provincia->id }}"
                                                            data-elemento-nombre="{{ $provincia->nombre }} ({{ $provincia->pais->nombre }})"
                                                            data-url-eliminar="{{ route('paises-provincias.provincia.destroy', $provincia->id) }}">
                                                        <i class="bi bi-trash"></i> Eliminar
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center text-muted">No hay provincias/estados registradas</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            {{-- Paginación de Provincias --}}
                            <div class="mt-3">
                                {{ $provinciasPaginadas->links('components.paginacion') }}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- MODALES -->
@include('components.modal-editar-pais')
@include('components.modal-editar-provincia', ['paises' => $paises])

@include('components.modal-eliminar', [
    'modalId' => 'modalEliminarPais',
    'titulo' => 'Eliminar País',
    'mensajeAdicional' => 'No se puede eliminar si tiene provincias/estados asociados.'
])

@include('components.modal-eliminar', [
    'modalId' => 'modalEliminarProvincia',
    'titulo' => 'Eliminar Provincia/Estado',
    'mensajeAdicional' => 'No se puede eliminar si tiene ciudades asociadas.'
])

@endsection

@push('scripts')
    @vite(['resources/js/paises-provincias.js'])
@endpush