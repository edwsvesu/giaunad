<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dominio\Servicios\Usuarios\IUsuarioServicio;
use Illuminate\Support\Facades\Auth;

class solicitudesController extends Controller
{
    private IUsuarioServicio $UsuarioServicio;
    private $usuario_rol;

    public function __construct(IUsuarioServicio $UsuarioServicio){
        $this->UsuarioServicio=$UsuarioServicio;
        $this->middleware(function ($request, $next) {
            $this->usuario_rol=Auth::user()->rol_id;
            return $next($request);
        });
    }

    public function index(){
        $solicitudes=$this->getUsuariosNoVerificados();
        $roles=$this->UsuarioServicio->getTodosRoles();
        switch ($this->usuario_rol) {
            case 1:
                return view('administrador.usuarios.solicitudes',compact('solicitudes','roles'));
                break;
            default:
                abort(403);
                break;
        }
    }

    public function getUsuariosNoVerificados(){
        return $this->UsuarioServicio->getUsuariosNoVerificados();
    }

    public function rechazarSolicitudIngreso(Request $request){
        return $this->UsuarioServicio->rechazarSolicitudIngreso($request->all(),$this->usuario_rol);
    }

    public function aceptarSolicitudIngreso(Request $request){
        return $this->UsuarioServicio->aceptarSolicitudIngreso($request->all(),$this->usuario_rol);
    }

    public function cambiarRol(Request $request){
        return $this->UsuarioServicio->actualizarRol($request->all(),$this->usuario_rol);
    }
}
