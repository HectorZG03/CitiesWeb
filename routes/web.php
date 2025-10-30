<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CiudadController;
use App\Http\Controllers\PaisController;

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


        
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});