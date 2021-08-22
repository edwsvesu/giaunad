<?php

namespace App\Http\Controllers\administrador\usuarios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dominio\Servicios\Usuarios\IReporteServicio;

class usuariosController extends Controller
{
    private IReporteServicio $ReporteServicio;

    public function __construct(IReporteServicio $ReporteServicio){
        $this->ReporteServicio=$ReporteServicio;   
    }

    public function index(){
        $integrantes=$this->ReporteServicio->getIntegrantesDelGrupo();
        return view('administrador.usuarios.usuarios',compact('integrantes'));
    }
}
