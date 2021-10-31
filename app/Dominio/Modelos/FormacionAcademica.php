<?php

namespace App\Dominio\Modelos;
use Illuminate\Support\Facades\Validator;
use App\Dominio\Modelos\Institucion;

class FormacionAcademica{
	private $id;
	private $titulo;
	private $intensidad;
	private $fecha_inicio;
	private $fecha_fin;
	private $promedio;
	private $nivel_id;
	private $institucion;

	public function setId($id){
		$this->id=$id;
	}

	public function getId(){
		return $this->id;
	}

	public function getInstitucion(){
		return $this->institucion;
	}

	public function setInstitucion($id=null,$nombre=null,$ciudad_id=null){
		$institucion=new Institucion();
		$institucion->setId($id);
		$institucion->setNombre($nombre);
		$institucion->setCiudad_id($ciudad_id);
		$this->institucion=$institucion;
	}

	public function getNivel_id(){
		return $this->nivel_id;
	}

	public function setNivel_id($nivel_id){
		$this->nivel_id = $nivel_id;
	}

	public function getTitulo(){
		return $this->titulo;
	}

	public function setTitulo($titulo){
		$this->titulo = $titulo;
	}

	public function getIntensidad(){
		return $this->intensidad;
	}

	public function setIntensidad($intensidad){
		$this->intensidad = $intensidad;
	}

	public function getFecha_inicio(){
		return $this->fecha_inicio;
	}

	public function setFecha_inicio($fecha_inicio){
		$this->fecha_inicio = $fecha_inicio;
	}

	public function getFecha_fin(){
		return $this->fecha_fin;
	}

	public function setFecha_fin($fecha_fin){
		$this->fecha_fin = $fecha_fin;
	}

	public function getPromedio(){
		return $this->promedio;
	}

	public function setPromedio($promedio){
		$this->promedio = $promedio;
	}

	public function validez(){
        $atributos=array(
            'titulo'=>$this->titulo,
			'institucion_id'=>$this->institucion->getId()
        );

        $validacion=Validator::make($atributos,[
            'titulo'=>'required',
			'institucion_id'=>'required'
        ]);
        return $validacion;
    }
}