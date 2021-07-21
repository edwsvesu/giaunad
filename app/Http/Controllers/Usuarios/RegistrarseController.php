<?php

namespace App\Http\Controllers\Usuarios;
use App\Http\Controllers\Controller;
use App\Dominio\Servicios\Usuarios\IRegistrarseServicio;
use Illuminate\Http\Request;

class RegistrarseController extends Controller{
    private IRegistrarseServicio $RegistrarseServicio;
    public function __construct(IRegistrarseServicio $RegistrarseServicio)
    {
        $this->RegistrarseServicio=$RegistrarseServicio;
    }

    public function registrarse(Request $request){
        $entrada=$request->all();
        $salida=$this->RegistrarseServicio->registrarse($entrada);
        return redirect('/registrarse#signup')->with($salida["accion"],$salida['mensaje']);
    }
}
