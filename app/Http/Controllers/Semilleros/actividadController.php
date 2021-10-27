<?php

namespace App\Http\Controllers\Semilleros;

use App\Dominio\Servicios\Semilleros\ISemilleroServicio;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class actividadController extends Controller
{
    private $usuario_rol;
    private $usuario_id;
    private ISemilleroServicio $SemilleroServicio;
    public function __construct(ISemilleroServicio $SemilleroServicio)
    {
        $this->middleware(function ($request, $next) {
            $this->usuario_rol=Auth::user()->rol_id;
            $this->usuario_id=Auth::user()->id;
            return $next($request);
        });
        $this->SemilleroServicio=$SemilleroServicio;
    }

    public function index($codigo_semillero,$codigo_actividad)
    {
        if($infoSemillero=$this->SemilleroServicio->getInformacionSemillero($codigo_semillero)){
            if($infoActividad=$this->SemilleroServicio->getInformacionActividad($infoSemillero[0]->id,$codigo_actividad)){
                $infoEntrega=$this->SemilleroServicio->getInformacionEntrega($infoActividad[0]->id,$this->usuario_id);
                $archivosEntrega=isset($infoEntrega[0]->id) ? $this->SemilleroServicio->getArchivosDeEntrega($infoEntrega[0]->id):[];
                switch ($this->usuario_rol) {
                    case 1:
                        return view("administrador.semilleros.actividad",compact('infoActividad'));
                        break;
                    case 4:
                        if($this->SemilleroServicio->usuarioEsLiderDeSemillero($infoSemillero[0]->id,$this->usuario_id)){
                            return view('estudiante.semilleros.actividadg',compact('infoActividad'));
                        }else if($this->SemilleroServicio->usuarioEsSemilleristaDeSemillero($infoSemillero[0]->id,$this->usuario_id)){
                            //validar mas adelante el acceso a una actividad, en caso de asignacion de actividad especifica
                            return view('estudiante.semilleros.actividad',compact('infoActividad','archivosEntrega'));
                        }
                        abort(403);
                        break;
                    default:
                        abort(403);
                        break;
                }
            }
            abort(404);
        }
        abort(404);
    }

    public function crearEntregaSiNoExiste($codigo_semillero,$codigo_actividad)
    {
        return $this->SemilleroServicio->crearEntregaSiNoExiste($codigo_semillero,$codigo_actividad,$this->usuario_id);
    }

    public function subirArchivo(Request $request,$codigo_semillero,$codigo_actividad)
    {
        return $this->SemilleroServicio->subirArchivoEntrega($request->all(),$codigo_semillero,$codigo_actividad,$this->usuario_id);
    }

    public function descargarArchivo($codigo_semillero,$codigo_actividad,$ruta)
    {
        return $this->SemilleroServicio->descargarArchivoEntrega($codigo_semillero,$codigo_actividad,$this->usuario_id,$ruta);
    }

    public function eliminarArchivoEntrega($codigo_semillero,$codigo_actividad,$ruta)
    {
        return $this->SemilleroServicio->eliminarArchivoEntrega($codigo_semillero,$codigo_actividad,$this->usuario_id,$ruta);
    }
}
