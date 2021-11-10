<?php

namespace App\Dominio\Modelos;
use Illuminate\Support\Facades\Validator;

class FormacionIdioma{
	private $id;
	private $lectura;
	private $escritura;
	private $habla;
	private $escucha;
	private $idioma_id;

	public function setId($id){
			$this->id=$id;
	}

	public function getId(){
		return $this->id;
	}

	public function getLectura(){
		return $this->lectura;
	}

	public function setLectura($lectura){
		$this->lectura = $lectura;
	}

	public function getEscritura(){
		return $this->escritura;
	}

	public function setEscritura($escritura){
		$this->escritura = $escritura;
	}

	public function getHabla(){
		return $this->habla;
	}

	public function setHabla($habla){
		$this->habla = $habla;
	}

	public function getEscucha(){
		return $this->escucha;
	}

	public function setEscucha($escucha){
		$this->escucha = $escucha;
	}

	public function getIdioma_id(){
		return $this->idioma_id;
	}

	public function setIdioma_id($idioma_id){
		$this->idioma_id = $idioma_id;
	}

	public function validez(){
        $atributos=array(
            'lectura'=>$this->lectura,
        );

        $validacion=Validator::make($atributos,[
            'lectura'=>'required'
        ]);
        return $validacion;
    }
}