<?php

namespace App\Http\Controllers\Proyectos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dominio\Servicios\Proyectos\IReporteServicio;

class misproyectosController extends Controller
{
    private IReporteServicio $ReporteServicio;
    private $usuario_id;
    private $usuario_rol;

    public function __construct(IReporteServicio $ReporteServicio){
        $this->ReporteServicio=$ReporteServicio;
        $this->usuario_id=1;
        $this->usuario_rol=3;
    }

    public function index(){
        //se pasa un documento temporal mientras se configura la autenticación.
        $proyectos=$this->ReporteServicio->getProyectosDeUsuario($this->usuario_id);
        switch ($this->usuario_rol) {
            case 3:
                return view('investigador.proyectos.misproyectos',compact('proyectos'));
                break;
            default:
                abort(403);
                break;
        }
    }
}
