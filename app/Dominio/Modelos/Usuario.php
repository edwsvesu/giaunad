<?php
namespace App\Dominio\Modelos;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class Usuario{
    private $nombres;
    private $apellidos;
    private $numero_documento;
    private $correo_principal;
    private $correo_secundario;
    private $clave;

    public function setClave($clave){
        $this->clave=$clave;
    }

    public function getClaveEncriptada(){
        return Hash::make($this->clave);
    }

    public function setNombres($nombres){
        $this->nombres=$nombres;
    }

    public function setApellidos($apellidos){
        $this->apellidos=$apellidos;
    }

    public function setNumero_documento($numero_documento){
        $this->numero_documento=$numero_documento;
    }

    public function setCorreo_principal($correo_principal){
        $this->correo_principal=$correo_principal;
    }

    public function setCorreo_secundario($correo_secundario){
        $this->correo_secundario=$correo_secundario;
    }

    public function getNombres(){
        return $this->nombres;
    }

    public function getApellidos(){
        return $this->apellidos;
    }

    public function getNumero_documento(){
        return $this->numero_documento;
    }

    public function getCorreo_principal(){
        return $this->correo_principal;
    }

    public function getCorreo_secundario(){
        return $this->correo_secundario;
    }

    public function validez(){
        $atributos=array(
            'nombres'=>$this->nombres,
            'apellidos'=>$this->apellidos,
            'numero_documento'=>$this->numero_documento
        );

        $validacion=Validator::make($atributos,[
            'nombres'=>'required|min:2|max:60',
            'apellidos'=>'required|min:2|max:60',
            'numero_documento'=>'required|max:15'
        ]);
        return $validacion;
    }
}
