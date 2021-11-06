<?php

namespace App\Http\Controllers\Proyectos;

use App\Http\Controllers\Controller;
use App\Dominio\Servicios\Proyectos\IProyectoServicio;
use App\Dominio\Servicios\Proyectos\IReporteServicio;
use App\Dominio\Servicios\Usuarios\IUsuarioServicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class editarController extends Controller
{
    private $usuario_rol;
    private IReporteServicio $ReporteServicio;
    private IProyectoServicio $ProyectoServicio;
    private IUsuarioServicio $UsuarioServicio;

    public function __construct(IReporteServicio $ReporteServicio,IProyectoServicio $ProyectoServicio,IUsuarioServicio $UsuarioServicio)
    {
        $this->middleware(function ($request, $next) {
            $this->usuario_rol=Auth::user()->rol_id;
            return $next($request);
        });
        $this->ReporteServicio=$ReporteServicio;
        $this->ProyectoServicio=$ProyectoServicio;
        $this->UsuarioServicio=$UsuarioServicio;
    }

    public function index($codigo_proyecto)
    {
        if($infoProyecto=$this->ReporteServicio->getInformacionGeneralProyecto($codigo_proyecto)){
            $tipos_proyectos=$this->ProyectoServicio->getTodosTiposDeProyectos();
            $usuarioslideres=$this->UsuarioServicio->getUsuariosAptosComoLideres();
            switch ($this->usuario_rol){
                case 1:
                    return view('administrador.proyectos.editar',compact('infoProyecto','tipos_proyectos','usuarioslideres'));
                    break;
                case 2:
                    return view('codirector.proyectos.editar',compact('infoProyecto','tipos_proyectos','usuarioslideres'));
                    break;
                default:
                    abort(403);
                    break;
            }
        }
        abort(404);
    }

    public function editar(Request $request,$codigo_proyecto)
    {
        $salida=$this->ProyectoServicio->editarProyecto($request->all(),$codigo_proyecto,$this->usuario_rol);
        if($salida){
            return redirect("/proyectos/proyecto/$salida/editar");
        }
        else{
            return back();
        }
    }
}
