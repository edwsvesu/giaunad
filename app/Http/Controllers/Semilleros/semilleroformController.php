<?php

namespace App\Http\Controllers\Semilleros;

use App\Dominio\Servicios\Semilleros\ISemilleroServicio;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class semilleroformController extends Controller
{
    private $usuario_rol;
    private ISemilleroServicio $SemilleroServicio; 
    public function __construct(ISemilleroServicio $SemilleroServicio)
    {
        $this->middleware(function ($request, $next) {
            $this->usuario_rol=Auth::user()->rol_id;
            return $next($request);
        });
        $this->SemilleroServicio=$SemilleroServicio;
    }
    public function index(){
        $lideres=$this->getLideres();
        $coordinadores=$this->getCoordinadores();
        switch ($this->usuario_rol) {
            case 1:
                return view('administrador.semilleros.semilleroform',compact('lideres','coordinadores'));
                break;
            case 2:
                return view('codirector.semilleros.semilleroform',compact('lideres','coordinadores'));
                break;
            default:
                abort(403);
                break;
        }
    }

    public function crearSemillero(Request $request)
    {
        $salida=$this->SemilleroServicio->crear($request->all(),$this->usuario_rol);
        if($salida){
            return redirect('/semilleros/semillero/'.$salida);
        }
        return back();
    }

    public function getLideres()
    {
        return $this->SemilleroServicio->getUsuariosAptosComoLideresSemillero();
    }

    public function getCoordinadores()
    {
        return $this->SemilleroServicio->getUsuariosAptosComoCoordinadoresSemillero();
    }
}
