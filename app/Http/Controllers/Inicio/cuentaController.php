<?php

namespace App\Http\Controllers\Inicio;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Dominio\Servicios\Usuarios\IAutenticacionServicio;
use Illuminate\Support\Facades\Password;

class cuentaController extends Controller
{
    private IAutenticacionServicio $AutenticacionServicio;

    public function __construct(IAutenticacionServicio $AutenticacionServicio){
        $this->AutenticacionServicio=$AutenticacionServicio;
    }

    public function index(){
        return view("inicio.cuenta");
    }

    public function login(Request $request){
        $this->AutenticacionServicio->autenticar($request->only('numero_documento', 'password'));
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function logout(){
        $this->AutenticacionServicio->cerrarSesion();
        return redirect('/cuenta');
    }
}
