<?php

namespace App\Http\Controllers\Proyectos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dominio\Servicios\Proyectos\IInformeServicio;
use App\Dominio\Servicios\Proyectos\IProyectoServicio;
use Illuminate\Support\Facades\Auth;

class informeController extends Controller
{
    private IInformeServicio $InformeServicio;
    private IProyectoServicio $ProyectoServicio;
    private $usuario_rol;
    private $usuario_id;
    public function __construct(IInformeServicio $InformeServicio,IProyectoServicio $ProyectoServicio){
        $this->InformeServicio=$InformeServicio;
        $this->ProyectoServicio=$ProyectoServicio;
        $this->middleware(function ($request, $next) {
            $this->usuario_id=Auth::user()->id;
            $this->usuario_rol=Auth::user()->rol_id;
            return $next($request);
        });
    }
    public function index($proyecto_cod,$informe_id){
        $informacion=$this->InformeServicio->getInforme($informe_id,$proyecto_cod);
        if($informacion){
            $archivos=$this->InformeServicio->getArchivos($informacion[0]->id);
            switch ($this->usuario_rol) {
                case 1:
                    $privilegio="admin";
                    return view('administrador.proyectos.informe',compact('informacion','archivos','privilegio'));
                    break;
                case 2:
                    $privilegio="codirector";
                    return view('codirector.proyectos.informe',compact('informacion','archivos','privilegio'));
                    break;
                case 3:
                    if($this->ProyectoServicio->usuarioEsIntegranteDeProyecto($this->usuario_id,$informacion[0]->proyecto_id)){
                        $privilegio=($this->ProyectoServicio->usuarioEsLiderDeProyecto($informacion[0]->proyecto_id,$this->usuario_id)) ? 'lider':'none';
                        return view('investigador.proyectos.informe',compact('informacion','archivos','privilegio'));
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

    public function entregar($proyecto_cod,$informe_id,Request $request){
        $this->InformeServicio->realizarEntrega($request->all(),$proyecto_cod,$informe_id,$this->usuario_id,$this->usuario_rol);
        return back();
    }

    public function descargarArchivo($ruta,$nombre){
        return $this->InformeServicio->descargarArchivo($ruta,$nombre);
    }

    public function borrarArchivo($proyecto_cod,$informe_id,Request $request){
        return $this->InformeServicio->borrarArchivo($request->all(),$proyecto_cod,$informe_id,$this->usuario_id,$this->usuario_rol);
    }

    public function editar(Request $request,$codigo_proyecto,$codigo_informe)
    {
        $this->InformeServicio->editar($request->all(),$codigo_informe);
        return back();
    }

    public function eliminarInforme($codigo_proyecto,$id)
    {
        if($this->InformeServicio->eliminarInforme($codigo_proyecto,$id,$this->usuario_rol,$this->usuario_id)){
            return redirect("/proyectos/proyecto/$codigo_proyecto"); 
        }
    }
}
