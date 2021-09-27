<?php

namespace App\Http\Controllers\Proyectos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dominio\Servicios\Proyectos\IReporteServicio;
use Illuminate\Support\Facades\Auth;

class finalizadosController extends Controller
{
    private IReporteServicio $ReporteServicio;
    private $usuario_rol;
    public function __construct(IReporteServicio $ReporteServicio){
        $this->ReporteServicio=$ReporteServicio;
        $this->middleware(function ($request, $next) {
            $this->usuario_rol=Auth::user()->rol_id;
            return $next($request);
        });
    }

    public function index(){
        $proyectos=$this->ReporteServicio->getProyectosFinalizados();
        switch ($this->usuario_rol) {
            case 1:
                return view('administrador.proyectos.finalizados',compact('proyectos'));
                break;
            case 2:
                return view('codirector.proyectos.finalizados',compact('proyectos'));
                break;
            default:
                abort(403);
                break;
        }
    }
}
