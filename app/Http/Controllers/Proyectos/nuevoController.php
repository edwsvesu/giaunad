<?php

namespace App\Http\Controllers\Proyectos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dominio\Servicios\Proyectos\IProyectoServicio;
use App\Dominio\Servicios\Usuarios\IUsuarioServicio;
use Illuminate\Support\Facades\Auth;

class nuevoController extends Controller
{
    private IProyectoServicio $ProyectoServicio;
    private IUsuarioServicio $UsuarioServicio;
    private $usuario_rol;

    public function __construct(IProyectoServicio $ProyectoServicio,IUsuarioServicio $UsuarioServicio){
        $this->ProyectoServicio=$ProyectoServicio;
        $this->UsuarioServicio=$UsuarioServicio;
        $this->middleware(function ($request, $next) {
            $this->usuario_rol=Auth::user()->rol_id;
            return $next($request);
        });
    }
    public function index(){
        $tipos_proyectos=$this->getTiposDeProyectos();
        $usuarioslideres=$this->UsuarioServicio->getUsuariosAptosComoLideres();
        switch ($this->usuario_rol) {
            case 1:
                return view('administrador.proyectos.nuevo',compact('tipos_proyectos','usuarioslideres'));
                break;
            case 2:
                return view('codirector.proyectos.nuevo',compact('tipos_proyectos','usuarioslideres'));
                break;
            default:
                abort(403);
                break;
        }
    }

    public function crear(Request $request){
        $entrada=$request->all();
        $creado=$this->ProyectoServicio->registrarNuevoProyecto($entrada,$this->usuario_rol);
        if($creado){
            return redirect("/proyectos/proyecto/".$entrada['codigo']);
        }
        else{
            return back();
        }
    }

    public function getTiposDeProyectos(){
        return $this->ProyectoServicio->getTodosTiposDeProyectos();
    }

    public function crearTipoProyecto(Request $request){
        return $this->ProyectoServicio->crearTipoProyecto($request->all(),$this->usuario_rol);
    }

    public function editarTipoProyecto(Request $request){
        return $this->ProyectoServicio->editarTipoProyecto($request->all(),$this->usuario_rol);
    }

    public function eliminarTipoProyecto(Request $request){
        return $this->ProyectoServicio->eliminarTipoProyecto($request->all(),$this->usuario_rol);
    }
}
