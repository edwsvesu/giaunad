<?php

namespace App\Http\Controllers\administrador\Curriculum\DatosGenerales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dominio\Servicios\Usuarios\Curriculum\IDatosGeneralesServicio;

class formacionacademicaformController extends Controller
{
    private IDatosGeneralesServicio $DatosGeneralesServicio;

    public function __construct(IDatosGeneralesServicio $DatosGeneralesServicio){
        $this->DatosGeneralesServicio=$DatosGeneralesServicio;
    }

    public function index(){
        $niveles=$this->DatosGeneralesServicio->getTodosNivelesFormacion();
        return view('administrador.curriculum.formacionacademicaform',compact('niveles'));
    }
}
