<?php

namespace App\Http\Controllers\administrador\Proyectos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dominio\Servicios\Proyectos\IReporteServicio;

class misproyectosController extends Controller
{
    private IReporteServicio $ReporteServicio;

    public function __construct(IReporteServicio $ReporteServicio){
        $this->ReporteServicio=$ReporteServicio;
    }

    public function index(){
        //se pasa un documento temporal mientras se configura la autenticación.
        $proyectos=$this->ReporteServicio->getProyectosDeUsuario('1232892648');
        return view('administrador.proyectos.misproyectos',compact('proyectos'));
    }
}
