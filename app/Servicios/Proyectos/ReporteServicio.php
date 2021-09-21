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

	public function getProyectosDeUsuario(int $usuario_id){
		return $this->Reportes->getProyectosDeUsuario($usuario_id);
	}

	public function getInformacionGeneralProyecto(string $codigo){
		return $this->Reportes->getInformacionGeneralProyecto($codigo);
	}

	public function getIntegrantesProyecto(int $proyecto_id){
		return $this->Reportes->getIntegrantesDeProyecto($proyecto_id);
	}

	public function getIntegranteProyecto(string $proyecto_cod,int $usuario_id){
		//$proyecto_id=isset($datos['proyecto_id']) ? $datos['proyecto_id']:'';
		//$usuario_id=isset($datos['usuario_id']) ? $datos['usuario_id']:'';
		return $this->Reportes->getIntegranteDeProyecto($proyecto_cod,$usuario_id);
	}
}