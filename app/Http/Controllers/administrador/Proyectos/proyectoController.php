<?php

namespace App\Http\Controllers\administrador\Proyectos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dominio\Servicios\Proyectos\IReporteServicio;
use App\Dominio\Servicios\Proyectos\IProyectoServicio;



//temporal
use Illuminate\Support\Facades\Storage;

class proyectoController extends Controller
{
    private IReporteServicio $ReporteServicio;
    private IProyectoServicio $ProyectoServicio;

    public function __construct(IReporteServicio $ReporteServicio,IProyectoServicio $ProyectoServicio){
        $this->ReporteServicio=$ReporteServicio;
        $this->ProyectoServicio=$ProyectoServicio;
    }

    public function index($codigo){
        $infoGeneral=$this->ReporteServicio->getInformacionGeneralProyecto($codigo);
        if($infoGeneral){
            $documentos=$this->ProyectoServicio->getDocumentos($infoGeneral[0]->id);
            $integrantesAgregar=$this->ProyectoServicio->getIntegrantesProyecto($infoGeneral[0]->id);
            return view('administrador.proyectos.proyecto',compact('infoGeneral','documentos','integrantesAgregar'));
        }
        else{
            abort(404);
        }
    }

    public function descargarDocumento($ruta,$nombre){
        return $this->ProyectoServicio->descargarDocumento($ruta,$nombre);
    }

    public function subirDocumentos(Request $request){
        return $this->ProyectoServicio->subirDocumentos($request->all());
    }

    public function borrarDocumento(Request $request){
        return $this->ProyectoServicio->borrarDocumento($request->all());
    }

    public function agregarIntegrante(Request $request){
        return $this->ProyectoServicio->setIntegranteProyecto($request->all());
    }
}
