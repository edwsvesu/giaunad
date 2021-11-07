<?php

namespace App\Http\Controllers\Usuarios;

use App\Dominio\Servicios\Usuarios\IUsuarioServicio;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class contraController extends Controller
{
    private $usuario_rol;
    private $usuario_id;
    private IUsuarioServicio $UsuarioServicio; 
    public function __construct(IUsuarioServicio $UsuarioServicio)
    {
        $this->middleware(function ($request, $next) {
            $this->usuario_rol=Auth::user()->rol_id;
            $this->usuario_id=Auth::user()->id;
            return $next($request);
        });
        $this->UsuarioServicio=$UsuarioServicio;
    }

    public function index()
    {
        switch ($this->usuario_rol) {
            case 1:
                return view('administrador.contra');
                break;
            case 2:
                return view('codirector.contra');
                break;
            case 3:
                return view('investigador.contra');
                break;
            case 4:
                return view('estudiante.contra');
                break;
            default:
                abort(403);
                break;
        }
    }

    public function cambiar(Request $request)
    {
        $this->UsuarioServicio->cambiarContra($request->all(),Auth::user()->password,$this->usuario_id);
        return back();
    }
}
