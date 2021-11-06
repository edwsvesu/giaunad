<?php

namespace App\Http\Controllers\Semilleros;

use App\Dominio\Servicios\Semilleros\ISemilleroServicio;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class editarController extends Controller
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
    public function index($codigo_semillero)
    {
        if($infoSemillero=$this->SemilleroServicio->getInformacionSemillero($codigo_semillero)){
            $lideres=$this->getLideres();
            $coordinadores=$this->getCoordinadores();
            $encargados=$this->SemilleroServicio->getInformacionEncargadosDeSemillero($infoSemillero[0]->id);
            switch ($this->usuario_rol) {
                case 1:
                    return view('administrador.semilleros.editar',compact('infoSemillero','lideres','coordinadores','encargados'));
                    break;
                case 2:
                    return view('codirector.semilleros.editar',compact('infoSemillero','lideres','coordinadores','encargados'));
                    break;
                default:
                    abort(403);
                    break;
            }
        }
        abort(404);
    }

    public function getLideres()
    {
        return $this->SemilleroServicio->getUsuariosAptosComoLideresSemillero();
    }

    public function getCoordinadores()
    {
        return $this->SemilleroServicio->getUsuariosAptosComoCoordinadoresSemillero();
    }

    public function editar(Request $request,$codigo_semillero)
    {
        $this->SemilleroServicio->editarSemillero($request->all(),$codigo_semillero,$this->usuario_rol);
        return redirect("/semilleros/semillero/$codigo_semillero");
    }
}
