<?php

namespace App\Http\Controllers\administrador\usuarios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dominio\Servicios\Usuarios\IUsuarioServicio;

class solicitudesController extends Controller
{
    private IUsuarioServicio $UsuarioServicio;

    public function __construct(IUsuarioServicio $UsuarioServicio){
        $this->UsuarioServicio=$UsuarioServicio;
    }

    public function index(){
        $solicitudes=$this->getUsuariosNoVerificados();
        $roles=$this->UsuarioServicio->getTodosRoles();
        return view('administrador.usuarios.solicitudes',compact('solicitudes','roles'));
    }

    public function getUsuariosNoVerificados(){
        return $this->UsuarioServicio->getUsuariosNoVerificados();
    }

    public function rechazarSolicitudIngreso(Request $request){
        return $this->UsuarioServicio->rechazarSolicitudIngreso($request->all());
    }

    public function aceptarSolicitudIngreso(Request $request){
        return $this->UsuarioServicio->aceptarSolicitudIngreso($request->all());
    }

    public function cambiarRol(Request $request){
        return $this->UsuarioServicio->actualizarRol($request->all());
    }
}
