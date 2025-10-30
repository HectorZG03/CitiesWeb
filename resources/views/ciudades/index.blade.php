
@extends('layouts.app')

@section('title', 'Ciudades del Mundo')

@include('ciudades.modal_actualizar')
@include('ciudades.modal_eliminar')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2 class="mb-4">Ciudades del Mundo</h2>
            
            <!-- Mensajes -->
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

            <!-- Formulario -->
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Registrar Nueva Ciudad</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('ciudades.store') }}" id="formCrear">
                        @csrf
                        
                        <div class="row">
                            <!-- País -->
                            <div class="col-md-6 mb-3">
                                <label for="pais_nombre" class="form-label">País</label>
                                <select class="form-select @error('pais_nombre') is-invalid @enderror" 
                                        id="pais_nombre" 
                                        name="pais_nombre"
                                        required>
                                    <option value="">Seleccione un país</option>
                                    <!-- Las opciones se cargarán via JavaScript -->
                                </select>
                                <div class="form-text">Los países se cargan desde la API de REST COUNTRIES</div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Provincia/Estado -->
                            <div class="col-md-6 mb-3">
                                <label for="provincia_nombre" class="form-label">Provincia/Estado</label>
                                <input type="text" 
                                       class="form-control @error('provincia_nombre') is-invalid @enderror" 
                                       id="provincia_nombre" 
                                       name="provincia_nombre"
                                       value="{{ old('provincia_nombre') }}"
                                       placeholder="Ej: Querétaro"
                                       required>
                            </div>

                            <!-- Ciudad -->
                            <div class="col-md-6 mb-3">
                                <label for="ciudad_nombre" class="form-label">Ciudad</label>
                                <input type="text" 
                                       class="form-control @error('ciudad_nombre') is-invalid @enderror" 
                                       id="ciudad_nombre" 
                                       name="ciudad_nombre"
                                       value="{{ old('ciudad_nombre') }}"
                                       placeholder="Ej: Santiago de Querétaro"
                                       required>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Población -->
                            <div class="col-md-6 mb-3">
                                <label for="poblacion" class="form-label">Población (opcional)</label>
                                <input type="number" 
                                       class="form-control @error('poblacion') is-invalid @enderror" 
                                       id="poblacion" 
                                       name="poblacion"
                                       value="{{ old('poblacion') }}"
                                       placeholder="Ej: 1500000"
                                       min="0">
                            </div>

                            <div class="col-md-6 mb-3 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary w-100">
                                    Guardar Ciudad
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tabla de Ciudades -->
            <div class="card shadow">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">Ciudades Registradas</h5>
                </div>
                <div class="card-body">
                    @if($ciudades->count() > 0)
                        @include('layouts.buscador')
                        
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Ciudad</th>
                                        <th>Provincia/Estado</th>
                                        <th>País</th>
                                        <th>Población</th>
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
                                            <td>{{ $ciudad->poblacion ? number_format($ciudad->poblacion) : 'N/A' }}</td>
                                            <td>{{ $ciudad->created_at->format('d/m/Y') }}</td>
                                            <td>
                                                <button type="button" 
                                                        class="btn btn-sm btn-warning"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalActualizar"
                                                        data-id="{{ $ciudad->id }}"
                                                        data-ciudad="{{ $ciudad->nombre }}"
                                                        data-provincia="{{ $ciudad->provinciaEstado->nombre }}"
                                                        data-pais="{{ $ciudad->provinciaEstado->pais->nombre }}"
                                                        data-poblacion="{{ $ciudad->poblacion ?? '' }}">
                                                    Editar
                                                </button>
                                                
                                                <button type="button" 
                                                        class="btn btn-sm btn-danger"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalEliminar"
                                                        data-id="{{ $ciudad->id }}"
                                                        data-ciudad="{{ $ciudad->nombre }}">
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
@endsection
