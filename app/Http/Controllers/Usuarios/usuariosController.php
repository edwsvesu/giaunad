<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dominio\Servicios\Usuarios\IReporteServicio;
use App\Dominio\Servicios\Usuarios\IUsuarioServicio;
use Illuminate\Support\Facades\Auth;

class usuariosController extends Controller
{
    private IReporteServicio $ReporteServicio;
    private $usuario_rol;
    private IUsuarioServicio $UsuarioServicio;
    public function __construct(IReporteServicio $ReporteServicio,IUsuarioServicio $UsuarioServicio){
        $this->ReporteServicio=$ReporteServicio;
        $this->middleware(function ($request, $next) {
            $this->usuario_rol=Auth::user()->rol_id;
            return $next($request);
        });   
        $this->UsuarioServicio=$UsuarioServicio;
    }

    public function index(){
        $integrantes=$this->ReporteServicio->getIntegrantesDelGrupo();
        switch ($this->usuario_rol) {
            case 1:
                return view('administrador.usuarios.usuarios',compact('integrantes'));
                break;
            default:
                abort(403);
                break;
        }
    }

    public function eliminar(Request $request)
    {
        return $this->UsuarioServicio->eliminarUsuario($request->all(),$this->usuario_rol);
    }
}
