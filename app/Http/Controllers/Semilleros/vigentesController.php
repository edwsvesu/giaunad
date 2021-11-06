<?php

namespace App\Http\Controllers\Semilleros;

use App\Dominio\Servicios\Semilleros\ISemilleroServicio;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class vigentesController extends Controller
{
    private ISemilleroServicio $SemilleroServicio;
    private $usuario_rol;
    
    public function __construct(ISemilleroServicio $SemilleroServicio)
    {
        $this->middleware(function ($request, $next) {
            $this->usuario_rol=Auth::user()->rol_id;
            return $next($request);
        });
        $this->SemilleroServicio=$SemilleroServicio;
    }

    public function index()
    {
        switch ($this->usuario_rol) {
            case 1:
                $semilleros=$this->SemilleroServicio->getSemillerosVigentes();
                $privilegio="admin";
                return view('administrador.semilleros.vigentes',compact('semilleros','privilegio'));
                break;
            case 2:
                $semilleros=$this->SemilleroServicio->getSemillerosVigentes();
                $privilegio="codirector";
                return view('codirector.semilleros.vigentes',compact('semilleros','privilegio'));
                break;
            default:
                abort(403);
                break;
        }
    }
}
