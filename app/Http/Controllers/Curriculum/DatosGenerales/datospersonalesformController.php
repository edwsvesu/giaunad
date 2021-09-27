<?php

namespace App\Http\Controllers\Curriculum\DatosGenerales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dominio\Servicios\Usuarios\Curriculum\IDatosPersonalesServicio;
use Illuminate\Support\Facades\Auth;

class datospersonalesformController extends Controller
{
    private IDatosPersonalesServicio $DatosPersonalesServicio;
    private $usuario_id;
    private $usuario_rol;

    public function __construct(IDatosPersonalesServicio $DatosPersonalesServicio){
        $this->DatosPersonalesServicio=$DatosPersonalesServicio;
        $this->middleware(function ($request, $next) {
            $this->usuario_id=Auth::user()->id;
            $this->usuario_rol=Auth::user()->rol_id;
            return $next($request);
        });
    }

    public function index(){
        $datos=$this->DatosPersonalesServicio->getDatos($this->usuario_id);
        switch ($this->usuario_rol) {
            case 1:
                return view('administrador.curriculum.datospersonalesform',compact('datos'));
                break;
            case 2:
                return view('codirector.curriculum.datospersonalesform',compact('datos'));
                break;
            case 3:
                return view('investigador.curriculum.datospersonalesform',compact('datos'));
                break;
            case 4:
                return view('estudiante.curriculum.datospersonalesform',compact('datos'));
                break;
            default:
                abort(403);
                break;
        }
    }

    public function eliminarTelefono(Request $request){
        return $this->DatosPersonalesServicio->eliminarTelefono($request->all(),$this->usuario_id);
    }

    public function editarInformacion(Request $request){
        $this->DatosPersonalesServicio->editarInformacion($request->all(),$this->usuario_id);
        return redirect('/curriculum/datos-generales/datos-personales');
    }

    public function agregarTelefono(Request $request){
        return $this->DatosPersonalesServicio->agregarTelefono($request->all(),$this->usuario_id);
    }
}
