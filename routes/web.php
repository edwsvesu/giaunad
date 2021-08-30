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
use App\Http\Controllers\administrador\usuarios\solicitudesController;
use App\Http\Controllers\administrador\usuarios\usuariosController;
use App\Http\Controllers\administrador\Proyectos\vigentesController;
use App\Http\Controllers\administrador\Proyectos\finalizadosController;
use App\Http\Controllers\administrador\Proyectos\misproyectosController;
use App\Http\Controllers\administrador\Proyectos\nuevoController;
use  App\Http\Controllers\administrador\Proyectos\proyectoController;

Route::get('/registrarse', function () {
    return view('inicio.login');
});

Route::get('/registrarse2', function () {
    return view('administrador.usuarios.usuariosform');
});

Route::post('/registrarse', [RegistrarseController::class,'registrarse']);



Route::get('/proyectos/nuevo',[nuevoController::class,'index']);
Route::post('/proyectos/nuevo/crear',[nuevoController::class,'crear']);

Route::get('/proyectos/vigentes',[vigentesController::class,'index']);

Route::get('/proyectos/finalizados',[finalizadosController::class,'index']);

Route::get('/proyectos/misproyectos',[misproyectosController::class,'index']);


Route::get('/proyectos/proyecto/{codigo}',[proyectoController::class,'index']);
Route::get('/descargar/documento-proyecto/{ruta}/{nombre}',[proyectoController::class,'descargarDocumento'])->where('nombre', '.*')->where('ruta', '.*');

Route::post('/subir/documento-proyecto',[proyectoController::class,'subirDocumentos']);

Route::post('/proyectos/eliminar-documento',[proyectoController::class,'borrarDocumento']);

Route::post('/proyectos/agregar-integrante',[proyectoController::class,'agregarIntegrante']);

Route::get('/usuarios',[usuariosController::class,'index']);

Route::get('/usuarios/solicitudes',[solicitudesController::class,'index']);
Route::post('/usuarios/solicitudes/rechazar',[solicitudesController::class,'rechazarSolicitudIngreso']);
Route::post('/usuarios/solicitudes/aceptar',[solicitudesController::class,'aceptarSolicitudIngreso']);
Route::post('/usuarios/solicitudes/cambiar-rol',[solicitudesController::class,'cambiarRol']);

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