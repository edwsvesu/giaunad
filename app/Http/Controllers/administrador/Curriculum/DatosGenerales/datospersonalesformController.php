<?php

namespace App\Http\Controllers\administrador\Curriculum\DatosGenerales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dominio\Servicios\Usuarios\Curriculum\IDatosPersonalesServicio;

class datospersonalesformController extends Controller
{
    private IDatosPersonalesServicio $DatosPersonalesServicio;
    private $usuario_id;

    public function __construct(IDatosPersonalesServicio $DatosPersonalesServicio){
        $this->DatosPersonalesServicio=$DatosPersonalesServicio;
        //Valor quemado mientras se hace sesion
        $this->usuario_id=1;
    }

    public function index(){
        //Valor quemado mientras se hace sesion
        $datos=$this->DatosPersonalesServicio->getDatos("1232892648");
        return view('administrador.curriculum.datospersonalesform',compact('datos'));
    }

    public function eliminarTelefono(Request $request){
        return $this->DatosPersonalesServicio->eliminarTelefono($request->all(),$this->usuario_id);
    }

    public function editarInformacion(Request $request){
        $this->DatosPersonalesServicio->editarInformacion($request->all(),$this->usuario_id);
        return redirect('/dpersonales');
    }

    public function agregarTelefono(Request $request){
        return $this->DatosPersonalesServicio->agregarTelefono($request->all(),$this->usuario_id);
    }
}
