<?php

namespace App\Http\Controllers\administrador\Proyectos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dominio\Servicios\Proyectos\IReporteServicio;
use App\Dominio\Servicios\Proyectos\IProyectoServicio;
use App\Dominio\Servicios\Proyectos\IInformeServicio;



//temporal
use Illuminate\Support\Facades\Storage;

class proyectoController extends Controller
{
    private IReporteServicio $ReporteServicio;
    private IProyectoServicio $ProyectoServicio;
    private IInformeServicio $InformeServicio;

    public function __construct(IReporteServicio $ReporteServicio,IProyectoServicio $ProyectoServicio,IInformeServicio $InformeServicio){
        $this->ReporteServicio=$ReporteServicio;
        $this->ProyectoServicio=$ProyectoServicio;
        $this->InformeServicio=$InformeServicio;
    }

    public function index($codigo){
        $infoGeneral=$this->ReporteServicio->getInformacionGeneralProyecto($codigo);
        if($infoGeneral){
            $documentos=$this->ProyectoServicio->getDocumentos($infoGeneral[0]->id);
            $integrantesAgregar=$this->ProyectoServicio->getIntegrantesProyecto($infoGeneral[0]->id);
            $integrantesProyecto=$this->ReporteServicio->getIntegrantesProyecto($infoGeneral[0]->id);
            $informes=$this->InformeServicio->getInformes($infoGeneral[0]->id);
            return view('administrador.proyectos.proyecto',compact('infoGeneral','documentos','integrantesAgregar','integrantesProyecto','informes'));
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

    public function getIntegranteDeProyecto(Request $request){
        return $this->ReporteServicio->getIntegranteProyecto($request->all());
    }

    public function crearInforme(Request $request){
        $salida=$this->InformeServicio->crear($request->all());
        if($salida){
            return redirect("informe/".$salida['informe_id']."/proyecto/".$salida['proyecto_cod']);
        }
        else{
            return back();
        }
    }
}
