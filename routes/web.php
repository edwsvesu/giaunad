<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// referencias temporales
use App\Http\Controllers\Usuarios\RegistrarseController;

Route::get('/registrarse', function () {
    return view('inicio.login');
});

Route::post('/registrarse', [RegistrarseController::class,'registrarse']);



Route::get('/proyectos/nuevo', function () {
    return view('administrador.proyectos.nuevo');
});

Route::get('/proyectos/vigentes', function () {
    return view('administrador.proyectos.vigentes');
});

Route::get('/proyectos/finalizados', function () {
    return view('administrador.proyectos.finalizados');
});

Route::get('/proyectos/misproyectos', function () {
    return view('administrador.proyectos.misproyectos');
});


Route::get('/proyectos/proyecto', function () {
    return view('administrador.proyectos.proyecto');
});

Route::get('/usuarios', function () {
    return view('administrador.usuarios.usuarios');
});

Route::get('/usuarios/solicitudes', function () {
    return view('administrador.usuarios.solicitudes');
});

Route::get('/entrega', function () {
    return view('administrador.proyectos.entrega');
});

Route::get('/actividad', function () {
    return view('administrador.proyectos.actividad');
});

Route::get('/actividad2', function () {
    return view('administrador.proyectos.actividad2');
});

Route::get('/dpersonales', function () {
    return view('administrador.curriculum.datospersonales');
});

Route::get('/academica', function () {
    return view('administrador.curriculum.formacionacademica');
});

Route::get('/nuevoacademica', function () {
    return view('administrador.curriculum.formacionacademicaform');
});

Route::get('/idiomas', function () {
    return view('administrador.curriculum.formacionidiomas');
});

Route::get('/idiomasform', function () {
    return view('administrador.curriculum.formacionidiomasform');
});