<?php

namespace App\Http\Controllers\administrador\Curriculum\DatosGenerales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dominio\Servicios\Usuarios\Curriculum\IFormacionIdiomasServicio;

class formacionidiomasController extends Controller
{
    private $usuario_id;
    private IFormacionIdiomasServicio $FormacionIdiomasServicio;
    public function __construct(IFormacionIdiomasServicio $FormacionIdiomasServicio){
        $this->FormacionIdiomasServicio=$FormacionIdiomasServicio;
        $this->usuario_id=1;
    }

    public function index(){
        $formacion=$this->FormacionIdiomasServicio->getFormacionIdiomas($this->usuario_id);
        return view('administrador.curriculum.formacionidiomas',compact('formacion'));
    }
}
