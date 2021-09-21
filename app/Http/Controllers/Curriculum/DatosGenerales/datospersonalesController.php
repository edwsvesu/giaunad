<?php

namespace App\Http\Controllers\Curriculum\DatosGenerales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dominio\Servicios\Usuarios\Curriculum\IDatosPersonalesServicio;

class datospersonalesController extends Controller
{
    private IDatosPersonalesServicio $DatosPersonalesServicio;
    private $usuario_id;
    private $usuario_rol;
    public function __construct(IDatosPersonalesServicio $DatosPersonalesServicio){
        $this->DatosPersonalesServicio=$DatosPersonalesServicio;
        $this->usuario_id=1;
        $this->usuario_rol=3;
    }

    public function index(){
        $datos=$this->DatosPersonalesServicio->getDatos($this->usuario_id);
        switch ($this->usuario_rol) {
            case 1:
                return view('administrador.curriculum.datospersonales',compact('datos'));
                break;
            case 3:
                return view('investigador.curriculum.datospersonales',compact('datos'));
                break;
            case 4:
                return view('estudiante.curriculum.datospersonales',compact('datos'));
                break;
            default:
                abort(403);
                break;
        }
    }
}
