<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UnidadController;
use App\Http\Controllers\UserController;
/*Route::get('/', function () {
    return view('bienvenido');
});*/

Route::get('/', [UserController::class, 'showLogin'])->name('login');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/categoria', [CategoriaController::class, 'index'])->name('categoria.index');
Route::get('/unidad', [UnidadController::class, 'index'])->name('unidad.index');

Route::post('/identificacion', [UserController::class, 'verificalogin'])->name('identificacion');
Route::post('/salir', [UserController::class, 'salir'])->name('logout');

Route::resource('/categoria', CategoriaController::class);

Route::get('cancelar', function () {
    return redirect()->route('categoria.index')
        ->with('datos', 'Acción Cancelada ..!');
})->name('cancelar');

Route::get('categoria/{id}/confirmar', [CategoriaController::class, 'confirmar'])->name('categoria.confirmar');

// PRODUCTOS

Route::resource('productos', ProductoController::class);
Route::resource('libros', LibroController::class);
Route::resource('autores', LibroController::class);
Route::get('/cancelar1', function () {
    return redirect()->route('producto.index')->with('datos', 'Accion cancelada');
})->name('cancelar1');
Route::get('producto/{id}/confirmar', 'ProductoController@confirmar')->name('productos.confirmar');
