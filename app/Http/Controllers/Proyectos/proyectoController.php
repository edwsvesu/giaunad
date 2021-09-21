<?php

namespace App\Http\Controllers\Proyectos;

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
    private $usuario_rol;
    private $usuario_id;
    private $lidera;
    private $proyecto_id;

    public function __construct(IReporteServicio $ReporteServicio,IProyectoServicio $ProyectoServicio,IInformeServicio $InformeServicio){
        $this->ReporteServicio=$ReporteServicio;
        $this->ProyectoServicio=$ProyectoServicio;
        $this->InformeServicio=$InformeServicio;
        $this->usuario_id=2;
        $this->usuario_rol=3;
    }

    public function index($codigo){
        if($this->ProyectoServicio->proyectoEstaRegistrado($codigo)){
            $infoGeneral=$this->ReporteServicio->getInformacionGeneralProyecto($codigo);
            $documentos=$this->ProyectoServicio->getDocumentos($infoGeneral[0]->id);
            $integrantesAgregar=$this->ProyectoServicio->getIntegrantesProyecto($infoGeneral[0]->id);
            $integrantesProyecto=$this->ReporteServicio->getIntegrantesProyecto($infoGeneral[0]->id);
            $informes=$this->InformeServicio->getInformes($infoGeneral[0]->id);
            switch ($this->usuario_rol) {
                case 3:
                    if($this->ProyectoServicio->usuarioEsIntegranteDeProyecto($this->usuario_id,$infoGeneral[0]->id)){
                        $privilegio=($this->ProyectoServicio->usuarioEsLiderDeProyecto($infoGeneral[0]->id,$this->usuario_id)) ? 'lider':'none';
                        return view('investigador.proyectos.proyecto',compact('infoGeneral','documentos','integrantesAgregar','integrantesProyecto','informes','privilegio'));
                    }
                    else{
                        abort(403);
                    }      
                    break;
                default:
                    abort(403);
                    break;
            }
        }
        else{
            abort(404);
        }
    }

    public function descargarDocumento($ruta,$nombre){
        return $this->ProyectoServicio->descargarDocumento($ruta,$nombre);
    }

    public function subirDocumentos($codigo,Request $request){
        return $this->ProyectoServicio->subirDocumentos($request->all(),$codigo,$this->usuario_id);
    }

    public function borrarDocumento($codigo,Request $request){
        return $this->ProyectoServicio->borrarDocumento($request->all(),$codigo,$this->usuario_id); 
    }

    public function agregarIntegrante($codigo,Request $request){
        return $this->ProyectoServicio->setIntegranteProyecto($request->all(),$codigo,$this->usuario_id);
    }

    public function getIntegranteDeProyecto($proyecto_cod,$integrante_id){
        return $this->ReporteServicio->getIntegranteProyecto($proyecto_cod,$integrante_id);
    }

    public function crearInforme($codigo,Request $request){
        $salida=$this->InformeServicio->crear($request->all(),$codigo,$this->usuario_id);
        if($salida){
            return redirect("informe/".$salida['informe_id']."/proyecto/".$salida['proyecto_cod']);
        }
        else{
            return back();
        }
    }
}
