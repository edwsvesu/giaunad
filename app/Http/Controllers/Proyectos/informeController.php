<?php

namespace App\Http\Controllers\administrador\Proyectos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dominio\Servicios\Proyectos\IInformeServicio;

class informeController extends Controller
{
    private IInformeServicio $InformeServicio;
    public function __construct(IInformeServicio $InformeServicio){
        $this->InformeServicio=$InformeServicio;
    }
    public function index($codinforme,$codproyecto){
        $informacion=$this->InformeServicio->getInforme($codinforme,$codproyecto);
        if($informacion){
            $archivos=$this->InformeServicio->getArchivos($informacion[0]->id);
            return view('administrador.proyectos.informe',compact('informacion','archivos'));
        }
        else{
            abort(404);
        }
    }

    public function entregar(Request $request){
        $this->InformeServicio->realizarEntrega($request->all());
        return back();
    }

    public function descargarArchivo($ruta,$nombre){
        return $this->InformeServicio->descargarArchivo($ruta,$nombre);
    }

    public function borrarArchivo(Request $request){
        return $this->InformeServicio->borrarArchivo($request->all());
    }
}
