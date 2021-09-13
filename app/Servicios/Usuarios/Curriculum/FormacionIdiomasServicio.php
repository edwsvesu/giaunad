<?php

namespace App\Servicios\Usuarios\Curriculum;
use App\Dominio\Servicios\Usuarios\Curriculum\IFormacionIdiomasServicio;
use App\Dominio\Persistencia\Repositorios\IRepositorioFormacionIdioma;

class FormacionIdiomasServicio implements IFormacionIdiomasServicio{

	private IRepositorioFormacionIdioma $RepositorioFormacionIdioma;

	public function __construct(IRepositorioFormacionIdioma $RepositorioFormacionIdioma){
		$this->RepositorioFormacionIdioma=$RepositorioFormacionIdioma;
	}

	public function getFormacionIdiomas(int $usuario_id){
		return $this->RepositorioFormacionIdioma->getPorUsuario($usuario_id);
	}
}