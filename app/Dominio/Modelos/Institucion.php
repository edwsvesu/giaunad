<?php

namespace App\Dominio\Modelos;
use Illuminate\Support\Facades\Validator;

class Institucion{
	private $id;
	private $nombre;
	private $ciudad_id;

	public function setId($id){
		$this->id=$id;
	}

	public function getId(){
		return $this->id;
	}

	public function getNombre(){
		return $this->nombre;
	}

	public function setNombre($nombre){
		$this->nombre = $nombre;
	}

	public function getCiudad_id(){
		return $this->ciudad_id;
	}

	public function setCiudad_id($ciudad_id){
		$this->ciudad_id = $ciudad_id;
	}
}