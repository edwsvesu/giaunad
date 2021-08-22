<?php
namespace App\Servicios\Proyectos;
use App\Dominio\Servicios\Proyectos\IReporteServicio;
use App\Dominio\Repositorios\IReportes;

class ReporteServicio implements IReporteServicio{

	private IReportes $Reportes;

	public function __construct(IReportes $Reportes){
		$this->Reportes=$Reportes;
	}

	public function getProyectosVigentes(){
		return $this->Reportes->getProyectosVigentes();
	}

	public function getProyectosFinalizados(){
		return $this->Reportes->getProyectosFinalizados();
	}
}