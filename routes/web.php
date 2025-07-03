<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UsuarioController;

Route::middleware('prevent-back')->group(function () {
    Route::redirect('/', 'login');
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth')->group(function () {
        Route::prefix('admin')->name('admin.')->group(function () {
            Route::get('/dashboard', function () {
                return view('admin.dashboard');
            })->name('dashboard');
            Route::get('productos', [ProductoController::class, 'index']);
        });
        // Mostrar la lista de productos
        Route::get('admin/productos/index', [ProductoController::class, 'index'])->name('admin.productos.index');
        // Formulario para crear un nuevo producto
        Route::get('admin/productos/create', [ProductoController::class, 'create'])->name('admin.productos.create');
        // Guardar nuevo producto (form create)
        Route::post('admin/productos/index', [ProductoController::class, 'store'])->name('admin.productos.store');
        // Mostrar el formulario de edición
        Route::get('admin/productos/index/{producto}', [ProductoController::class, 'edit'])->name('admin.productos.edit');
        // Actualizar producto (form edit)  
        Route::get('admin/productos/{producto}', [ProductoController::class, 'show'])->name('admin.productos.show');
        //Actualiza producto
        Route::put('admin/productos/{producto}', [ProductoController::class, 'update'])->name('admin.productos.update');
        // Eliminar producto
        Route::delete('admin/productos/{producto}', [ProductoController::class, 'destroy'])->name('admin.productos.destroy');
        // Logout
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        //usuarios
        Route::get('admin/usuarios/index', [UsuarioController::class, 'index'])->name('admin.usuarios.index');
        // Eliminar usuario
        Route::delete('admin/usuarios/{usuario}', [UsuarioController::class, 'destroy'])->name('admin.usuarios.destroy');

        
    });
});
