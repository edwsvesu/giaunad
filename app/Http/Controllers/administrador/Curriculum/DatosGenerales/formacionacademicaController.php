<?php

namespace App\Http\Controllers\administrador\Curriculum\DatosGenerales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dominio\Servicios\Usuarios\Curriculum\IFormacionAcademicaServicio;

class formacionacademicaController extends Controller
{
    private IFormacionAcademicaServicio $FormacionAcademicaServicio;
    private $usuario_id;

    public function __construct(IFormacionAcademicaServicio $FormacionAcademicaServicio){
        $this->FormacionAcademicaServicio=$FormacionAcademicaServicio;
        $this->usuario_id=1;
    }

    public function index(){
        $titulos=$this->FormacionAcademicaServicio->getTodoPorUsuario($this->usuario_id);
        $niveles=$this->FormacionAcademicaServicio->getTodosNivelesFormacion();
        $instituciones=$this->FormacionAcademicaServicio->getTodasInstituciones();
        return view('administrador.curriculum.formacionacademica',compact('titulos','niveles','instituciones'));
    }

    public function getFormacion($id){
        return $this->FormacionAcademicaServicio->getInformacionFormacion(ctype_digit($id) ? $id:0,$this->usuario_id);
    }

    public function eliminar(Request $request){
        return $this->FormacionAcademicaServicio->eliminar($request->all(),$this->usuario_id);
    }

    public function crear(Request $request){
        $this->FormacionAcademicaServicio->crearFormacionAcademica($request->all(),$this->usuario_id);
        return back();
    }

    public function editar(Request $request){
        $this->FormacionAcademicaServicio->editarFormacionAcademica($request->all(),$this->usuario_id);
        return back();
    }
}
