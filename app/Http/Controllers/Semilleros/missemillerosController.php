<?php

namespace App\Http\Controllers\semilleros;

use App\Http\Controllers\Controller;
use App\Servicios\Semilleros\SemilleroServicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class missemillerosController extends Controller
{
    private SemilleroServicio $SemilleroServicio;
    private $usuario_rol;
    private $usuario_id;

    public function __construct(SemilleroServicio $SemilleroServicio)
    {
        $this->middleware(function ($request, $next) {
            $this->usuario_rol=Auth::user()->rol_id;
            $this->usuario_id=Auth::user()->id;
            return $next($request);
        });
        $this->SemilleroServicio=$SemilleroServicio;
    }
    public function index()
    {
        $semilleros=$this->SemilleroServicio->getSemillerosDeUsuario($this->usuario_id);
        switch ($this->usuario_rol) {
            case 4:
                return view('estudiante.semilleros.missemilleros',compact('semilleros'));
                break;
            default:
                abort(404);
                break;
        }
        return view('estudiante.semilleros.missemilleros');
    }
}
