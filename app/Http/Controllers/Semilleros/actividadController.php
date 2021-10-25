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
                switch ($this->usuario_rol) {
                    case 1:
                        return view("administrador.semilleros.actividad",compact('infoActividad'));
                        break;
                    case 4:
                        if($this->SemilleroServicio->usuarioEsLiderDeSemillero($infoSemillero[0]->id,$this->usuario_id)){
                            return view('estudiante.semilleros.actividadg',compact('infoActividad'));
                        }else{
                            return view('estudiante.semilleros.actividad',compact('infoActividad'));
                        }
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

    public function subirArchivo(Request $request,$codigo_semillero,$codigo_actividad)
    {
        return $this->SemilleroServicio->subirArchivoEntrega($request->all(),$codigo_semillero,$codigo_actividad,$this->usuario_id);
    }
}
