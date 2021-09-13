<?php

namespace App\Http\Controllers\administrador\Curriculum\DatosGenerales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dominio\Servicios\Usuarios\Curriculum\IDatosPersonalesServicio;

class datospersonalesController extends Controller
{
    private IDatosPersonalesServicio $DatosPersonalesServicio;
    public function __construct(IDatosPersonalesServicio $DatosPersonalesServicio){
        $this->DatosPersonalesServicio=$DatosPersonalesServicio;
    }

    public function index(){
        $datos=$this->DatosPersonalesServicio->getDatos("1232892648");
        return view('administrador.curriculum.datospersonales',compact('datos'));
    }
}
