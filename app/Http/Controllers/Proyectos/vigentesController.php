<?php

namespace App\Http\Controllers\Proyectos;

use App\Dominio\Servicios\Proyectos\IProyectoServicio;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dominio\Servicios\Proyectos\IReporteServicio;
use Illuminate\Support\Facades\Auth;

class vigentesController extends Controller
{
    private IReporteServicio $ReporteServicio;
    private $usuario_rol;
    private IProyectoServicio $ProyectoServicio;
    public function __construct(IReporteServicio $ReporteServicio,IProyectoServicio $ProyectoServicio){
        $this->ReporteServicio=$ReporteServicio;
        $this->middleware(function ($request, $next) {
            $this->usuario_rol=Auth::user()->rol_id;
            return $next($request);
        });
        $this->ProyectoServicio=$ProyectoServicio;
    }

    public function index(){
        $proyectos=$this->ReporteServicio->getProyectosVigentes();
        switch ($this->usuario_rol){
            case 1:
                $privilegio="admin";
                return view('administrador.proyectos.vigentes',compact('proyectos','privilegio'));       
                break;
            case 2:
                $privilegio="none";
                return view('codirector.proyectos.vigentes',compact('proyectos','privilegio'));       
                break;
            default:
                abort(403);
                break;
        }
    }

    public function cerrar($codigo)
    {
        return $this->ProyectoServicio->cerrarProyecto($codigo);
    }
}
