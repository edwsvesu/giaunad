<?php

namespace App\Http\Controllers\Semilleros;

use App\Dominio\Servicios\Semilleros\ISemilleroServicio;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class semilleroController extends Controller
{
    private $usuario_id;
    private $usuario_rol;
    private ISemilleroServicio $SemilleroServicio;
    public function __construct(ISemilleroServicio $SemilleroServicio)
    {
        $this->middleware(function ($request, $next) {
            $this->usuario_id=Auth::user()->id;
            $this->usuario_rol=Auth::user()->rol_id;
            return $next($request);
        });
        $this->SemilleroServicio=$SemilleroServicio;
    }
    public function index($codigo){
        if($infoGeneral=$this->SemilleroServicio->getInformacionSemillero($codigo)){
            $encargados=$this->SemilleroServicio->getInformacionEncargadosDeSemillero($infoGeneral[0]->id);
            $semilleristas=$this->SemilleroServicio->getUsuariosAptosComoSemilleristas($infoGeneral[0]->id);
            $semilleristasInt=$this->SemilleroServicio->getSemilleristas($infoGeneral[0]->id);
            $actividades=$this->SemilleroServicio->getActividades($infoGeneral[0]->id);
            switch ($this->usuario_rol) {
                case 1:
                    $privilegio="admin";
                    return view('administrador.semilleros.semillero',compact('infoGeneral','encargados','semilleristas','semilleristasInt','privilegio','actividades'));
                    break;
                case 2:
                    $privilegio="none";
                    return view('codirector.semilleros.semillero',compact('infoGeneral','encargados','semilleristas','semilleristasInt','privilegio','actividades'));
                    break;
                case 4:
                    $lider=$this->SemilleroServicio->usuarioEsLiderDeSemillero($infoGeneral[0]->id,$this->usuario_id);
                    if($lider || $this->SemilleroServicio->usuarioEsSemilleristaDeSemillero($infoGeneral[0]->id,$this->usuario_id)){
                        $privilegio= $lider ? "lider": "none";
                        return view('estudiante.semilleros.semillero',compact('infoGeneral','encargados','semilleristas','semilleristasInt','privilegio','actividades'));
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

    public function agregarSemilleristas(Request $request,$codigo)
    {
        return $this->SemilleroServicio->agregarSemilleristas($request->all(),$codigo,$this->usuario_rol,$this->usuario_id);
    }

    public function getUsuariosAptosComoSemilleristas($codigo)
    {
        if($info=$this->SemilleroServicio->getInformacionSemillero($codigo)){
            return $this->SemilleroServicio->getUsuariosAptosComoSemilleristas($info[0]->id);
        }
        return false;
    }

    public function crearActividad(Request $request,$semillero_codigo)
    {
        if($salida=$this->SemilleroServicio->crearActividad($request->all(),$semillero_codigo,$this->usuario_rol,$this->usuario_id)){
            return redirect("/semilleros/semillero/".$salida['codigo_semillero']."/actividad/".$salida['codigo_actividad']);
        }
        return back();
    }
}
