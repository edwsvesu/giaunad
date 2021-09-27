<?php

namespace App\Http\Controllers\Curriculum\DatosGenerales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dominio\Servicios\Usuarios\Curriculum\IFormacionIdiomasServicio;
use Illuminate\Support\Facades\Auth;

class formacionidiomasController extends Controller
{
    private $usuario_id;
    private $usuario_rol;
    private IFormacionIdiomasServicio $FormacionIdiomasServicio;
    public function __construct(IFormacionIdiomasServicio $FormacionIdiomasServicio){
        $this->FormacionIdiomasServicio=$FormacionIdiomasServicio;
        $this->middleware(function ($request, $next) {
            $this->usuario_id=Auth::user()->id;
            $this->usuario_rol=Auth::user()->rol_id;
            return $next($request);
        });
    }

    public function index(){
        $formacion=$this->FormacionIdiomasServicio->getFormacionIdiomas($this->usuario_id);
        $idiomas=$this->FormacionIdiomasServicio->getTodosIdiomas();
        switch ($this->usuario_rol){
            case 1:
                return view('administrador.curriculum.formacionidiomas',compact('formacion','idiomas'));
                break;
            case 2:
                return view('codirector.curriculum.formacionidiomas',compact('formacion','idiomas'));
                break;
            case 3:
                return view('investigador.curriculum.formacionidiomas',compact('formacion','idiomas'));
                break;
            case 4:
                return view('estudiante.curriculum.formacionidiomas',compact('formacion','idiomas'));
                break;
            default:
                abort(403);
                break;
        }
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
