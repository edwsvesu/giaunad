<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class homeController extends Controller
{
    private $usuario_rol;
    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->usuario_rol=Auth::user()->rol_id;
            return $next($request);
        });
    }

    public function index(){
        switch ($this->usuario_rol) {
            case 1:
                return view("administrador.inicio");
                break;
            case 2:
                return view("codirector.inicio");
                break;
            case 3:
                return view("investigador.inicio");
                break;
            case 4:
                return view("estudiante.inicio");
                break;
            default:
                abort(403);
                break;
        }
    }
}
