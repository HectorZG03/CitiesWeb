<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CiudadController;
use App\Http\Controllers\PaisProvinciaController;

// Ruta raíz - muestra login
Route::get('/', [AuthController::class, 'mostrarLogin'])->name('login');

// Ruta de login POST
Route::post('/login', [AuthController::class, 'login']);

// Rutas protegidas (requieren autenticación)
Route::middleware('auth')->group(function () {
    // Página de bienvenida
    Route::get('/bienvenida', function () {
        return view('bienvenida');
    })->name('bienvenida');
    
    // Ciudades
    Route::get('/ciudades', [CiudadController::class, 'index'])->name('ciudades.index');
    Route::post('/ciudades', [CiudadController::class, 'store'])->name('ciudades.store');
    Route::put('/ciudades/{id}', [CiudadController::class, 'update'])->name('ciudades.update');
    Route::delete('/ciudades/{id}', [CiudadController::class, 'destroy'])->name('ciudades.destroy');

    // Países y Provincias
    Route::get('/paises-provincias', [PaisProvinciaController::class, 'index'])->name('paises-provincias.index');
    
    // Rutas para Países (solo editar y eliminar)
    Route::put('/paises-provincias/pais/{id}', [PaisProvinciaController::class, 'updatePais'])->name('paises-provincias.pais.update');
    Route::delete('/paises-provincias/pais/{id}', [PaisProvinciaController::class, 'destroyPais'])->name('paises-provincias.pais.destroy');
    
    // Rutas para Provincias (solo editar y eliminar)
    Route::put('/paises-provincias/provincia/{id}', [PaisProvinciaController::class, 'updateProvincia'])->name('paises-provincias.provincia.update');
    Route::delete('/paises-provincias/provincia/{id}', [PaisProvinciaController::class, 'destroyProvincia'])->name('paises-provincias.provincia.destroy');
        
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});