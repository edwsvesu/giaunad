<?php

namespace App\Http\Controllers\administrador\Curriculum\DatosGenerales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class datospersonalesController extends Controller
{
    public function index(){
        return view('administrador.curriculum.datospersonales');
    }
}
