<?php

namespace App\Servicios\Usuarios\Curriculum;
use App\Dominio\Persistencia\Repositorios\IRepositorioNivel;
use App\Dominio\Servicios\Usuarios\Curriculum\IDatosGeneralesServicio;

class DatosGeneralesServicio implements IDatosGeneralesServicio{
	private IRepositorioNivel $RepositorioNivel;

	public function __construct(IRepositorioNivel $RepositorioNivel){
		$this->RepositorioNivel=$RepositorioNivel;
	}

	public function getTodosNivelesFormacion(){
		return $this->RepositorioNivel->getTodo();
	}
}