<?php

namespace App\Http\Controllers\administrador\Proyectos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dominio\Servicios\Proyectos\IReporteServicio;

class vigentesController extends Controller
{
    private IReporteServicio $ReporteServicio;
    public function __construct(IReporteServicio $ReporteServicio){
        $this->ReporteServicio=$ReporteServicio;
    }

    public function index(){
        $proyectos=$this->ReporteServicio->getProyectosVigentes();
        return view('administrador.proyectos.vigentes',compact('proyectos'));
    }
}
