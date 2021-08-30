<?php
namespace App\Servicios\Proyectos;
use App\Dominio\Servicios\Proyectos\IReporteServicio;
use App\Dominio\Persistencia\Repositorios\IReportes;

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

	public function getProyectosDeUsuario(string $numero_documento){
		return $this->Reportes->getProyectosDeUsuario($numero_documento);
	}

	public function getInformacionGeneralProyecto(string $codigo){
		return $this->Reportes->getInformacionGeneralProyecto($codigo);
	}
}