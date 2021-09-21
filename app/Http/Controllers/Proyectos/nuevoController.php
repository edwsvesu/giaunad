<?php

namespace App\Http\Controllers\administrador\Proyectos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dominio\Servicios\Proyectos\IProyectoServicio;
use App\Dominio\Servicios\Usuarios\IUsuarioServicio;

class nuevoController extends Controller
{
    private IProyectoServicio $ProyectoServicio;
    private IUsuarioServicio $UsuarioServicio;

    public function __construct(IProyectoServicio $ProyectoServicio,IUsuarioServicio $UsuarioServicio){
        $this->ProyectoServicio=$ProyectoServicio;
        $this->UsuarioServicio=$UsuarioServicio;
    }
    public function index(){
        $tipos_proyectos=$this->getTiposDeProyectos();
        $usuarioslideres=$this->UsuarioServicio->getUsuariosAptosComoLideres();
        return view('administrador.proyectos.nuevo',compact('tipos_proyectos','usuarioslideres'));
    }

    public function crear(Request $request){
        $entrada=$request->all();
        $creado=$this->ProyectoServicio->registrarNuevoProyecto($entrada);
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
        return $this->ProyectoServicio->crearTipoProyecto($request->all());
    }

    public function editarTipoProyecto(Request $request){
        return $this->ProyectoServicio->editarTipoProyecto($request->all());
    }

    public function eliminarTipoProyecto(Request $request){
        return $this->ProyectoServicio->eliminarTipoProyecto($request->all());
    }
}
