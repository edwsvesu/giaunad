<?php
namespace App\Servicios\Usuarios;
use App\Dominio\Servicios\Usuarios\IReporteServicio;
use App\Dominio\Persistencia\Repositorios\IReportes;

class ReporteServicio implements IReporteServicio{

	private IReportes $Reportes;

	public function __construct(IReportes $Reportes){
		$this->Reportes=$Reportes;
	}

	public function getIntegrantesDelGrupo(){
		return $this->Reportes->getIntegrantesDelGrupo();
	}
}