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
use App\Http\Controllers\homeController;
use App\Http\Controllers\Inicio\cuentaController;
use App\Http\Controllers\Usuarios\RegistrarseController;
use App\Http\Controllers\Usuarios\solicitudesController;
use App\Http\Controllers\Usuarios\usuariosController;
use App\Http\Controllers\Proyectos\vigentesController;
use App\Http\Controllers\Proyectos\finalizadosController;
use App\Http\Controllers\Proyectos\misproyectosController;
use App\Http\Controllers\Proyectos\nuevoController;
use App\Http\Controllers\Proyectos\proyectoController;
//use App\Http\Controllers\administrador\Curriculum\DatosGenerales\formacionacademicaformController;
use App\Http\Controllers\Curriculum\DatosGenerales\formacionacademicaController;
use App\Http\Controllers\Proyectos\informeController;
use App\Http\Controllers\Curriculum\DatosGenerales\datospersonalesController;
use App\Http\Controllers\Curriculum\DatosGenerales\datospersonalesformController;
use App\Http\Controllers\Curriculum\DatosGenerales\formacionidiomasController;

Route::get('/registrarse2', function () {return view('administrador.usuarios.usuariosform');});

Route::post('/registrarse', [RegistrarseController::class,'registrarse']);

Route::delete('/proyectos/tipo-proyecto',[nuevoController::class,'eliminarTipoProyecto']);
Route::put('/proyectos/tipo-proyecto',[nuevoController::class,'editarTipoProyecto']);

Route::get('/descargar/documento-proyecto/{ruta}/{nombre}',[proyectoController::class,'descargarDocumento'])->where('nombre', '.*')->where('ruta', '.*');

Route::get('/descargar/archivo-informe/{ruta}/{nombre}',[informeController::class,'descargarArchivo'])->where('nombre', '.*')->where('ruta', '.*');

Route::get('/entrega', function () {
    return view('administrador.proyectos.entrega');
});


Route::get('/actividad', function () {
    return view('administrador.proyectos.actividad');
});

Route::get('/actividad2', function () {
    return view('administrador.proyectos.actividad2');
});

//Route::post('/dpersonales/editar-telefono',[datospersonalesformController::class,'editarTelefono']);

//Route::get('/nuevoacademica',[formacionacademicaformController::class,'index']);


Route::get('/idiomasform', function () {
    return view('administrador.curriculum.formacionidiomasform');
});


///////////////////////////////////////////////////////////////////////////
Route::get('/cuenta',[cuentaController::class,'index'])->middleware('guest');
Route::post('/cuenta',[cuentaController::class,'login'])->middleware('guest');

Route::group(['middleware'=>'auth'],function(){

Route::get('/home',[homeController::class,'index']);
Route::post('/salir',[cuentaController::class,'logout']);
Route::get('/curriculum/datos-generales/datos-personales',[datospersonalesController::class,'index']);
Route::get('/curriculum/datos-generales/datos-personales/editar',[datospersonalesformController::class,'index']);
Route::post('/curriculum/datos-generales/datos-personales/editar/telefono',[datospersonalesformController::class,'agregarTelefono']);
Route::delete('/curriculum/datos-generales/datos-personales/editar/telefono',[datospersonalesformController::class,'eliminarTelefono']);
Route::post('/curriculum/datos-generales/datos-personales/editar',[datospersonalesformController::class,'editarInformacion']);
Route::get('/curriculum/datos-generales/formacion-academica',[formacionacademicaController::class,'index']);
Route::delete('/curriculum/datos-generales/formacion-academica',[formacionacademicaController::class,'eliminar']);

Route::post('/curriculum/datos-generales/formacion-academica',[formacionacademicaController::class,'crear']);
Route::put('/curriculum/datos-generales/formacion-academica',[formacionacademicaController::class,'editar']);

Route::get('/curriculum/datos-generales/formacion-academica/{id}',[formacionacademicaController::class,'getFormacion']);

Route::get('/curriculum/datos-generales/formacion-idiomas',[formacionidiomasController::class,'index']);
Route::post('/curriculum/datos-generales/formacion-idiomas',[formacionidiomasController::class,'crear']);
Route::put('/curriculum/datos-generales/formacion-idiomas',[formacionidiomasController::class,'editar']);
Route::delete('/curriculum/datos-generales/formacion-idiomas',[formacionidiomasController::class,'eliminar']);
Route::get('/proyectos/misproyectos',[misproyectosController::class,'index']);
Route::get('/proyectos/proyecto/{codigo}',[proyectoController::class,'index']);
Route::post('/proyectos/proyecto/{codigo}/integrante',[proyectoController::class,'agregarIntegrante']);
Route::get('/proyectos/proyecto/{codigo}/integrante/{integrante_id}',[proyectoController::class,'getIntegranteDeProyecto']);
Route::delete('/proyectos/proyecto/{codigo}/documento',[proyectoController::class,'borrarDocumento']);
Route::post('/proyectos/proyecto/{codigo}/documento',[proyectoController::class,'subirDocumentos']);
Route::post('/proyectos/proyecto/{codigo}/informe',[proyectoController::class,'crearInforme']);
Route::get('/proyectos/proyecto/{codigo}/informe/{codinforme}',[informeController::class,'index']);
Route::delete('/proyectos/proyecto/{codigo}/informe/{id}/archivo',[informeController::class,'borrarArchivo']);
Route::post('/proyectos/proyecto/{codigo}/informe/{codinforme}',[informeController::class,'entregar']);
Route::get('/usuarios',[usuariosController::class,'index']);
Route::get('/usuarios/solicitudes',[solicitudesController::class,'index']);
Route::post('/usuarios/solicitudes/rechazar',[solicitudesController::class,'rechazarSolicitudIngreso']);
Route::post('/usuarios/solicitudes/aceptar',[solicitudesController::class,'aceptarSolicitudIngreso']);
Route::get('/proyectos/nuevo',[nuevoController::class,'index']);
Route::post('/usuarios/solicitudes/cambiar-rol',[solicitudesController::class,'cambiarRol']);
Route::post('/proyectos/nuevo/tipo-proyecto',[nuevoController::class,'crearTipoProyecto']);
Route::get('/proyectos/vigentes',[vigentesController::class,'index']);
Route::get('/proyectos/finalizados',[finalizadosController::class,'index']);
Route::post('/proyectos/nuevo',[nuevoController::class,'crear']);
});