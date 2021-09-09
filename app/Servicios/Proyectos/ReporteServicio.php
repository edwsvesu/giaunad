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

	public function getIntegrantesProyecto(int $proyecto_id){
		return $this->Reportes->getIntegrantesDeProyecto($proyecto_id);
	}

	public function getIntegranteProyecto(array $datos){
		$proyecto_id=isset($datos['proyecto_id']) ? $datos['proyecto_id']:'';
		$usuario_id=isset($datos['usuario_id']) ? $datos['usuario_id']:'';
		return $this->Reportes->getIntegranteDeProyecto($proyecto_id,$usuario_id);
	}
}