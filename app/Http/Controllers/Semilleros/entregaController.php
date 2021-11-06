<?php

namespace App\Http\Controllers\Semilleros;

use App\Dominio\Servicios\Semilleros\ISemilleroServicio;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class entregaController extends Controller
{
    private ISemilleroServicio $SemilleroServicio;
    private $usuario_rol;
    private $usuario_id;
    public function __construct(ISemilleroServicio $SemilleroServicio)
    {
        $this->middleware(function ($request, $next) {
            $this->usuario_rol=Auth::user()->rol_id;
            $this->usuario_id=Auth::user()->id;
            return $next($request);
        });
        $this->SemilleroServicio=$SemilleroServicio;
    }

    public function index($codigo_semillero,$codigo_actividad,$codigo_usuario)
    {
        if($infoSemillero=$this->SemilleroServicio->getInformacionSemillero($codigo_semillero)){
            if($infoActividad=$this->SemilleroServicio->getInformacionActividad($infoSemillero[0]->id,$codigo_actividad)){
                if($autor=$this->SemilleroServicio->usuarioEsSemilleristaDeSemilleroPorCodigo($infoSemillero[0]->id,$codigo_usuario)){
                    $infoEntrega=$this->SemilleroServicio->getInformacionEntrega($infoActividad[0]->id,$autor->id);
                    $archivosEntrega=isset($infoEntrega[0]->id) ? $this->SemilleroServicio->getArchivosDeEntrega($infoEntrega[0]->id):[];
                    switch ($this->usuario_rol){
                        case 1:
                            return view('administrador.semilleros.entrega',compact('autor','archivosEntrega','infoActividad'));
                            break;
                        case 2:
                            return view('codirector.semilleros.entrega',compact('autor','archivosEntrega','infoActividad'));
                            break;
                        case 3:
                            if($this->SemilleroServicio->usuarioEsCoordinadorDeSemillero($infoSemillero[0]->id,$this->usuario_id)){
                                return view('investigador.semilleros.entrega',compact('autor','archivosEntrega','infoActividad'));
                            }
                            abort(403);
                            break;
                        case 4:
                            if($this->SemilleroServicio->usuarioEsLiderDeSemillero($infoSemillero[0]->id,$this->usuario_id)){
                                return view('estudiante.semilleros.entrega',compact('autor','archivosEntrega','infoActividad'));
                            }
                            abort(403);
                            break;
                        default:
                            abort(403);
                            break;
                    }
                }
            }
        }
        abort(404);
    }

    public function descargarArchivo($codigo_semillero,$codigo_actividad,$autor_codigo,$ruta)
    {
        return $this->SemilleroServicio->descargarArchivoEntrega($codigo_semillero,$codigo_actividad,$this->usuario_rol,$this->usuario_id,$ruta,$autor_codigo);
    }
}
