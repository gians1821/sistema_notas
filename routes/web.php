<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SeccionController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\CursoPorGradoController;
use App\Http\Controllers\CapacidadController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\CatedraController;
use App\Http\Controllers\CatedrasController;
use App\Http\Controllers\CursoHasAlumnoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\GradoController;
use App\Http\Controllers\NivelController;
use App\Http\Controllers\PadreController;
use App\Http\Controllers\TipoPersonalController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\NotaController;
use App\Models\Alumno;
use App\Models\User;

//login
Route::get('/', [LoginController::class, 'Login'])->name('login');
Route::post('/', [LoginController::class, 'UserLogin'])->name('User.Login');
Route::post('/logout', [LoginController::class, 'exit'])->name('User.Logout');

//Recuperar Contraseña
Route::post('/password/recovery', [LoginController::class, 'sendRecoveryEmail'])->name('password.sendRecoveryEmail');
Route::get('/password/reset/{token}', [LoginController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [LoginController::class, 'resetPassword'])->name('password.resetPassword');


//Home
Route::get('/Home', [HomeController::class, 'index'])->name('Home.index');

//Roles
Route::resource('/User', UserController::class)->names('admin.usuarios');

Route::resource('/Perfil', PerfilController::class)->names('admin.perfil');

Route::get('/CancelarUsuario', function () {
    return redirect()->route('admin.usuarios.index')->with('datos', 'Accion Cancelada..!');
})->name('CancelarUsuario');


Route::get('/Info/{indexito}', [InfoController::class, 'show'])->name('Info');

// Pages Alumnos
Route::resource('/Alumno', AlumnoController::class);
// Pages Seccion
Route::resource('/Seccion', SeccionController::class);
// Pages Cursos
Route::resource('/Curso', CursoController::class);
// Pages CursoGrado
Route::resource('/CursoPorGrado', CursoPorGradoController::class);
// Pages Capacidades
Route::resource('/Capacidad', CapacidadController::class);
// Pages Personal
Route::resource('/Personal', PersonalController::class);
// Pages Catedras
Route::resource('/catedras', CatedrasController::class);
// Pages Notas
Route::resource('/notas', NotaController::class);

// Pages Nota/Catedra
Route::resource('/Nota', CursoHasAlumnoController::class);
Route::get('/Nota/{id_alumno}/{id_curso}/edit', [CursoHasAlumnoController::class, 'edit'])->name('Nota.edit');
Route::put('Nota/{id_alumno}/{id_curso}', [CursoHasAlumnoController::class, 'update'])->name('Nota.update');
Route::get('/Catedra', [CatedraController::class, 'index'])->name('Catedra.index');
Route::get('/Catedra/pdf', [CatedraController::class, 'pdf'])->name('Catedra.pdf');
Route::get('/Catedra/pdfalumno/{id_alumno}', [CatedraController::class, 'PdfAlumno'])->name('Catedra.pdfalumno');
Route::post('/Alumno/pdfalumnos', [AlumnoController::class, 'generarPdf'])->name('Alumno.generarPdf');


// Cancelar Alumno
Route::get('/Cancelar', function () {
    return redirect()->route('Alumno.index')->with('datos', 'Accion Cancelada..!');
})->name('Cancelar');
// Cancelar Perfil
Route::get('/CancelarPerfil', function () {
    return redirect()->route('admin.perfil.index')->with('datos', 'Accion Cancelada..!');
})->name('CancelarPerfil');
// Cancelar Seccion
Route::get('/CancelarSeccion', function () {
    return redirect()->route('Seccion.index')->with('datos', 'Accion Cancelada..!');
})->name('CancelarSeccion');
// Cancelar Capacidad
Route::get('/CancelarCapacidad', function () {
    return redirect()->route('Capacidad.index')->with('datos', 'Accion Cancelada..!');
})->name('CancelarCapacidad');
// Cancelar Usuario
Route::get('/CancelarUsuario', function () {
    return redirect()->route('admin.usuarios.index')->with('datos', 'Accion Cancelada..!');
})->name('CancelarUsuario');
// Cancelar Catedras
Route::get('/CancelarCatedras', function () {
    return redirect()->route('catedras.index')->with('datos', 'Accion Cancelada..!');
})->name('CancelarCatedras');
// Cancelar Personal
Route::get('/CancelarPersonal', function () {
    return redirect()->route('Personal.index')->with('datos', 'Accion Cancelada..!');
})->name('CancelarPersonal');
// Cancelar Nota/Catedra
Route::get('/CancelarNota', function () {
    return redirect()->route('Nota.index')->with('datos', 'Accion Cancelada..!');
})->name('CancelarNota');
Route::get('/CancelarCurso', function () {
    return redirect()->route('Curso.index')->with('datos', 'Accion Cancelada..!');
})->name('CancelarCurso');
Route::get('/CancelarNotas', function () {
    return redirect()->route('notas.index')->with('datos', 'Accion Cancelada..!');
})->name('CancelarNotas');
// Confirmar Alumno
Route::get('Alumno/{id_alumno}/confirmar', [AlumnoController::class, 'confirmar'])->name('Alumno.confirmar');
// Confirmar Perfil
Route::get('Perfil/{id_perfil}/confirmar', [PerfilController::class, 'confirmar'])->name('admin.perfil.confirmar');
// Confirmar Seccion
Route::get('Seccion/{id_seccion}/confirmar', [SeccionController::class, 'confirmar'])->name('Seccion.confirmar');
// Confirmar Curso
Route::get('Curso/{id_curso}/confirmar', [CursoController::class, 'confirmar'])->name('Curso.confirmar');
// Confirmar User
Route::get('User/{id_user}/confirmar', [UserController::class, 'confirmar'])->name('admin.usuarios.confirmar');
// Confirmar Capacidad
Route::get('Capacidad/{id_competencia}/confirmar', [CapacidadController::class, 'confirmar'])->name('Capacidad.confirmar');
// Confirmar Personal
Route::get('Personal/{id_personal}/confirmar', [PersonalController::class, 'confirmar'])->name('Personal.confirmar');
// Confirmar Catedra
Route::get('catedras/{id_catedra}/confirmar', [CatedrasController::class, 'confirmar'])->name('catedras.confirmar');
// Confirmar Nota
Route::get('notas/{id_nota}/confirmar', [NotaController::class, 'confirmar'])->name('notas.confirmar');

// FUNCIONES BACKEND 
Route::get('/api/niveles', [NivelController::class, 'getNiveles']);
Route::get('/api/grados/{id_nivel}', [GradoController::class, 'getGradosPorNivel']);
Route::get('/api/secciones/{id_grado}', [SeccionController::class, 'getSeccionesPorGrado']);
Route::get('/api/grado/{id_grado}/cursos', [CursoController::class, 'getCursosPorGrado']);
Route::get('/api/buscar-padre', [PadreController::class, 'buscarPadre']);
Route::get('/api/tipos_personal', [TipoPersonalController::class, 'getTiposPersonal']);
Route::get('/api/docente/{id}', [PersonalController::class, 'getDocente']);
Route::get('/api/curso/{id}', [CursoController::class, 'getCurso']);