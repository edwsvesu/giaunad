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
