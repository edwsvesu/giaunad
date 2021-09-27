<?php

namespace App\Http\Controllers\Curriculum\DatosGenerales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dominio\Servicios\Usuarios\Curriculum\IFormacionAcademicaServicio;
use Illuminate\Support\Facades\Auth;

class formacionacademicaController extends Controller
{
    private IFormacionAcademicaServicio $FormacionAcademicaServicio;
    private $usuario_id;
    private $usuario_rol;

    public function __construct(IFormacionAcademicaServicio $FormacionAcademicaServicio){
        $this->FormacionAcademicaServicio=$FormacionAcademicaServicio;
        $this->middleware(function ($request, $next) {
            $this->usuario_id=Auth::user()->id;
            $this->usuario_rol=Auth::user()->rol_id;
            return $next($request);
        });
    }

    public function index(){
        $titulos=$this->FormacionAcademicaServicio->getTodoPorUsuario($this->usuario_id);
        $niveles=$this->FormacionAcademicaServicio->getTodosNivelesFormacion();
        $instituciones=$this->FormacionAcademicaServicio->getTodasInstituciones();
        switch ($this->usuario_rol) {
            case 1:
                return view('administrador.curriculum.formacionacademica',compact('titulos','niveles','instituciones'));
                break;
            case 2:
                return view('codirector.curriculum.formacionacademica',compact('titulos','niveles','instituciones'));
                break;
            case 3:
                return view('investigador.curriculum.formacionacademica',compact('titulos','niveles','instituciones'));
                break;
            case 4:
                return view('estudiante.curriculum.formacionacademica',compact('titulos','niveles','instituciones'));
                break;
            default:
                abort(403);
                break;
        }
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
