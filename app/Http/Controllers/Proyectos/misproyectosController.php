<?php

namespace App\Http\Controllers\Proyectos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dominio\Servicios\Proyectos\IReporteServicio;
use Illuminate\Support\Facades\Auth;

class misproyectosController extends Controller
{
    private IReporteServicio $ReporteServicio;
    private $usuario_id;
    private $usuario_rol;

    public function __construct(IReporteServicio $ReporteServicio){
        $this->ReporteServicio=$ReporteServicio;
        $this->middleware(function ($request, $next) {
            $this->usuario_id=Auth::user()->id;
            $this->usuario_rol=Auth::user()->rol_id;
            return $next($request);
        });
    }

    public function index(){
        $proyectos=$this->ReporteServicio->getProyectosDeUsuario($this->usuario_id);
        switch ($this->usuario_rol){
            case 1:
                $privilegio="admin";
                return view('administrador.proyectos.misproyectos',compact('proyectos','privilegio'));
                break;
            case 2:
                $privilegio="codirector";
                return view('codirector.proyectos.misproyectos',compact('proyectos','privilegio'));
                break;
            case 3:
                $privilegio="none";
                return view('investigador.proyectos.misproyectos',compact('proyectos','privilegio'));
                break;
            default:
                abort(403);
                break;
        }
    }
}
