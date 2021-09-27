<?php

namespace App\Http\Controllers\Curriculum\DatosGenerales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dominio\Servicios\Usuarios\Curriculum\IDatosPersonalesServicio;
use App\Dominio\Servicios\Usuarios\IAutenticacionServicio;
use Illuminate\Support\Facades\Auth;

class datospersonalesController extends Controller
{
    private IDatosPersonalesServicio $DatosPersonalesServicio;
    private $usuario_id;
    private $usuario_rol;
    public function __construct(IDatosPersonalesServicio $DatosPersonalesServicio,IAutenticacionServicio $AutenticacionServicio){
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
                return view('administrador.curriculum.datospersonales',compact('datos'));
                break;
            case 2:
                return view('codirector.curriculum.datospersonales',compact('datos'));
                break;
            case 3:
                return view('investigador.curriculum.datospersonales',compact('datos'));
                break;
            case 4:
                return view('estudiante.curriculum.datospersonales',compact('datos'));
                break;
            default:
                abort(403);
                break;
        }
    }
}
