<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dominio\Servicios\Usuarios\IReporteServicio;
use Illuminate\Support\Facades\Auth;

class usuariosController extends Controller
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
}
