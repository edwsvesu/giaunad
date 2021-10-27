<?php

namespace App\Dominio\Modelos;

use Illuminate\Support\Facades\Validator;

class EntregaActividad{
    private $id;
    private $archivo;
    private $actividad_id;
    private $usuario_id;

    public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getArchivo(){
		return $this->archivo;
	}

	public function setArchivo($archivo){
		$this->archivo = $archivo;
	}

	public function getActividad_id(){
		return $this->actividad_id;
	}

	public function setActividad_id($actividad_id){
		$this->actividad_id = $actividad_id;
	}

	public function getUsuario_id(){
		return $this->usuario_id;
	}

	public function setUsuario_id($usuario_id){
		$this->usuario_id = $usuario_id;
	}

    public function validarArchivo()
    {
        $validacion=Validator::make(['archivo'=>$this->archivo],[
            'archivo'=>'file'
        ]);
        return $validacion;
    }

    public function getArregloRegistroArchivo()
    {
        return array(
            'nombre'=>$this->archivo->getClientOriginalName(),
            'ruta'=>$this->archivo->store('semilleros/actividades/entregas'),
            'entrega_id'=>$this->id
        );
    }

    public function getArregloRegistro()
    {
        return array(
            'actividad_id'=>$this->actividad_id,
            'usuario_id'=>$this->usuario_id
        );
    }
}