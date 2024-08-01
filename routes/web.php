<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UnidadController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VentaController;

Route::get('/', [UserController::class, 'showLogin'])->name('login');
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::post('/identificacion', [UserController::class, 'verificalogin'])->name('identificacion');
Route::post('/salir', [UserController::class, 'salir'])->name('logout');

// CATEGORIAS

Route::resource('categorias', CategoriaController::class);
Route::get('cancelar-categorias', [CategoriaController::class, 'cancelar'])->name('categorias.cancelar');
Route::get('categoria/{id}/confirmar', [CategoriaController::class, 'confirmar'])->name('categorias.confirmar');

// UNIDADES

Route::resource('unidades', UnidadController::class);
Route::get('unidad/{id}/confirmar', [UnidadController::class, 'confirmar'])->name('unidades.confirmar');
Route::get('cancelar-unidades', [UnidadController::class, 'cancelar'])->name('unidades.cancelar');

// PRODUCTOS

Route::resource('productos', ProductoController::class);
Route::get('producto/{id}/confirmar', [ProductoController::class, 'confirmar'])->name('productos.confirmar');
Route::get('cancelar-productos', [ProductoController::class, 'cancelar'])->name('productos.cancelar');


Route::resource('ventas', VentaController::class);
