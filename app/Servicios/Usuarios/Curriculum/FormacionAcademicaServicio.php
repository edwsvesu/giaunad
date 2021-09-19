<?php

namespace App\Servicios\Usuarios\Curriculum;
use App\Dominio\Servicios\Usuarios\Curriculum\IFormacionAcademicaServicio;
use App\Dominio\Persistencia\Repositorios\IReportes;
use App\Dominio\Persistencia\Repositorios\IRepositorioFormacionAcademica;
use App\Dominio\Persistencia\Repositorios\IRepositorioNivel;
use App\Dominio\Persistencia\Repositorios\IRepositorioInstitucion;
use App\Dominio\Modelos\FormacionAcademica;
use App\Dominio\Modelos\Usuario;

class FormacionAcademicaServicio implements IFormacionAcademicaServicio{
	private IReportes $Reportes;
	private IRepositorioFormacionAcademica $RepositorioFormacionAcademica;
	private IRepositorioNivel $RepositorioNivel;
	private IRepositorioInstitucion $RepositorioInstitucion;
	
	public function __construct(IReportes $Reportes,IRepositorioFormacionAcademica $RepositorioFormacionAcademica,IRepositorioNivel $RepositorioNivel,IRepositorioInstitucion $RepositorioInstitucion){
		$this->Reportes=$Reportes;
		$this->RepositorioFormacionAcademica=$RepositorioFormacionAcademica;
		$this->RepositorioNivel=$RepositorioNivel;
		$this->RepositorioInstitucion=$RepositorioInstitucion;
	}

	public function getTodoPorUsuario(int $usuario_id){
		return $this->Reportes->getTodaFormacionAcademicaPorUsuario($usuario_id);
	}

	public function getInformacionFormacion(int $formacion_id,$usuario_id){
		return $this->Reportes->getFormacionAcademicaPorUsuario($formacion_id,$usuario_id);
	}

	public function eliminar(array $datos,int $usuario_id){
		$id=isset($datos['formacion_id_del']) ? (ctype_digit($datos['formacion_id_del']) ? $datos['formacion_id_del']:0):0;
		return $this->RepositorioFormacionAcademica->eliminar($id,$usuario_id);
	}

	public function getTodosNivelesFormacion(){
		return $this->RepositorioNivel->getTodo();
	}

	public function getTodasInstituciones(){
		return $this->RepositorioInstitucion->getTodo();
	}

	public function crearFormacionAcademica(array $datos,int $usuario_id){
		$titulo=isset($datos['titulo']) ? $datos['titulo']:null;
		$nivel_id=isset($datos['nivel_id']) ? $datos['nivel_id']:null;
		$institucion_id=isset($datos['institucion_id']) ? $datos['institucion_id']:null;
		$intensidad=isset($datos['intensidad']) ? $datos['intensidad']:null;
		$promedio=isset($datos['promedio']) ? $datos['promedio']:null;
		$fecha_inicio=isset($datos['fecha_inicio']) ? $datos['fecha_inicio']:null;
		$fecha_fin=isset($datos['fecha_fin']) ? $datos['fecha_fin']:null;
		$usuario=new Usuario();
		$usuario->setId($usuario_id);
		$usuario->setFormacion_academica($nivel_id,$titulo,$institucion_id,$intensidad,$promedio,$fecha_inicio,$fecha_fin);
		if(!($usuario->getFormacion_academica()->validez()->fails())){
			$datos=$usuario->getArregloFormacionAcademica();
			$this->RepositorioFormacionAcademica->insertar($datos);
		}
	}

	public function editarFormacionAcademica(array $datos,int $usuario_id){
		$id=isset($datos['formacion_id']) ? $datos['formacion_id']:null;
		$titulo=isset($datos['titulo']) ? $datos['titulo']:null;
		$nivel_id=isset($datos['nivel_id']) ? $datos['nivel_id']:null;
		$institucion_id=isset($datos['institucion_id']) ? $datos['institucion_id']:null;
		$intensidad=isset($datos['intensidad']) ? $datos['intensidad']:null;
		$promedio=isset($datos['promedio']) ? $datos['promedio']:null;
		$fecha_inicio=isset($datos['fecha_inicio']) ? $datos['fecha_inicio']:null;
		$fecha_fin=isset($datos['fecha_fin']) ? $datos['fecha_fin']:null;
		$usuario=new Usuario();
		$usuario->setId($usuario_id);
		$usuario->setFormacion_academica($nivel_id,$titulo,$institucion_id,$intensidad,$promedio,$fecha_inicio,$fecha_fin,$id);
		if(!($usuario->getFormacion_academica()->validez()->fails())){
			$datos=$usuario->getArregloFormacionAcademica();
			$this->RepositorioFormacionAcademica->editar($datos);
		}
	}
}