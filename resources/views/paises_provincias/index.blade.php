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
                            <div class="mb-3">
                                <input type="text" id="buscadorPaises" class="form-control" placeholder="🔍 Buscar país...">
                            </div>

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
                                        @forelse($paises as $pais)
                                            <tr>
                                                <td>{{ $pais->id }}</td>
                                                <td>{{ $pais->nombre }}</td>
                                                <td>
                                                    <span class="badge bg-info">
                                                        {{ $pais->provinciasEstados->count() }}
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
                            <div class="mb-3">
                                <input type="text" id="buscadorProvincias" class="form-control" placeholder="🔍 Buscar provincia/estado...">
                            </div>

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
                                        @foreach($paises as $pais)
                                            @foreach($pais->provinciasEstados as $provincia)
                                                <tr>
                                                    <td>{{ $provincia->id }}</td>
                                                    <td>{{ $provincia->nombre }}</td>
                                                    <td>{{ $pais->nombre }}</td>
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
                                                                data-pais-id="{{ $pais->id }}"
                                                                data-pais-nombre="{{ $pais->nombre }}">
                                                            <i class="bi bi-pencil"></i> Editar
                                                        </button>
                                                        <button class="btn btn-danger btn-sm"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modalEliminarProvincia"
                                                                data-id="{{ $provincia->id }}"
                                                                data-elemento-nombre="{{ $provincia->nombre }} ({{ $pais->nombre }})"
                                                                data-url-eliminar="{{ route('paises-provincias.provincia.destroy', $provincia->id) }}">
                                                            <i class="bi bi-trash"></i> Eliminar
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- MODAL EDITAR PAÍS -->
<div class="modal fade" id="modalEditarPais" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title">Editar País</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="formEditarPais" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_nombre_pais" class="form-label">Nombre del País</label>
                        <input type="text" class="form-control" id="edit_nombre_pais" name="nombre" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-warning">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL EDITAR PROVINCIA -->
<div class="modal fade" id="modalEditarProvincia" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title">Editar Provincia/Estado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="formEditarProvincia" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_pais_id" class="form-label">País</label>
                        <select class="form-select" id="edit_pais_id" name="pais_id" required>
                            <option value="">Seleccione un país</option>
                            @foreach($paises as $pais)
                                <option value="{{ $pais->id }}">{{ $pais->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_nombre_provincia" class="form-label">Nombre de la Provincia/Estado</label>
                        <input type="text" class="form-control" id="edit_nombre_provincia" name="nombre" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-warning">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODALES DE ELIMINAR (Reutilizables) -->
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