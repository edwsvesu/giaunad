<?php

namespace App\Http\Controllers\Semilleros;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class semilleroController extends Controller
{
    public function index($codigo){
    	return view('administrador.semilleros.semillero');
    }
}
