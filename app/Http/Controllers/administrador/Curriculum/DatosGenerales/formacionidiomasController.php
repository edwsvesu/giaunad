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
        $idiomas=$this->FormacionIdiomasServicio->getTodosIdiomas();
        return view('administrador.curriculum.formacionidiomas',compact('formacion','idiomas'));
    }

    public function crear(Request $request){
        $this->FormacionIdiomasServicio->crearFormacionIdioma($request->all(),$this->usuario_id);
        return back();
    }

    public function editar(Request $request){
        $this->FormacionIdiomasServicio->editarFormacionIdioma($request->all(),$this->usuario_id);
        return back();
    }

    public function eliminar(Request $request){
        return $this->FormacionIdiomasServicio->eliminarFormacionIdioma($request->all(),$this->usuario_id);
    }
}
