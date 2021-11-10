<?php

namespace App\Servicios\Usuarios\Curriculum;
use App\Dominio\Servicios\Usuarios\Curriculum\IFormacionIdiomasServicio;
use App\Dominio\Persistencia\Repositorios\IRepositorioFormacionIdioma;
use App\Dominio\Persistencia\Repositorios\IRepositorioIdioma;
use App\Dominio\Modelos\Usuario;

class FormacionIdiomasServicio implements IFormacionIdiomasServicio{

	private IRepositorioFormacionIdioma $RepositorioFormacionIdioma;
	private IRepositorioIdioma $RepositorioIdioma;

	public function __construct(IRepositorioFormacionIdioma $RepositorioFormacionIdioma,IRepositorioIdioma $RepositorioIdioma){
		$this->RepositorioFormacionIdioma=$RepositorioFormacionIdioma;
		$this->RepositorioIdioma=$RepositorioIdioma;
	}

	public function getFormacionIdiomas(int $usuario_id){
		return $this->RepositorioFormacionIdioma->getPorUsuario($usuario_id);
	}

	public function getTodosIdiomas(){
		return $this->RepositorioIdioma->getTodos();
	}

	public function crearFormacionIdioma(array $datos,int $usuario_id){
		$lectura=isset($datos['lectura']) ? $datos['lectura']:'';
		$escritura=isset($datos['escritura']) ? $datos['escritura']:'';
		$habla=isset($datos['habla']) ? $datos['habla']:'';
		$escucha=isset($datos['escucha']) ? $datos['escucha']:'';
		$idioma_id=isset($datos['idioma_id']) ? $datos['idioma_id']:0;
		$usuario=new Usuario();
		$usuario->setId($usuario_id);
		$usuario->setFormacion_idioma($lectura,$escritura,$habla,$escucha,$idioma_id);
		if(!($usuario->getFormacion_idioma()->validez()->fails())){
			if(!($this->formacionEstaRegistrada($usuario->getFormacion_idioma()->getIdioma_id(),$usuario->getId()))){
				return $this->RepositorioFormacionIdioma->insertar($usuario->getArregloFormacionIdioma());
			}
		}
	}

	public function formacionEstaRegistrada(int $idioma_id,int $usuario_id){
		if($this->RepositorioFormacionIdioma->getFormacionPorIdiomaYUsuario($idioma_id,$usuario_id)){
			return true;
		}
		else{
			return false;
		}
	}

	public function editarFormacionIdioma(array $datos,int $usuario_id){
		$id=isset($datos['formacion_id']) ? $datos['formacion_id']:0;
		$lectura=isset($datos['lectura']) ? $datos['lectura']:'';
		$escritura=isset($datos['escritura']) ? $datos['escritura']:'';
		$habla=isset($datos['habla']) ? $datos['habla']:'';
		$escucha=isset($datos['escucha']) ? $datos['escucha']:'';
		$idioma_id=isset($datos['idioma_id']) ? $datos['idioma_id']:0;
		$usuario=new Usuario();
		$usuario->setId($usuario_id);
		$usuario->setFormacion_idioma($lectura,$escritura,$habla,$escucha,$idioma_id,$id);
		if(!($usuario->getFormacion_idioma()->validez()->fails())){
			return $this->RepositorioFormacionIdioma->editarPorUsuario($usuario->getArregloFormacionIdioma());
		}
	}

	public function eliminarFormacionIdioma(array $datos,int $usuario_id){
		$id=isset($datos['formacion_id_del']) ? $datos['formacion_id_del']:0;
		return $this->RepositorioFormacionIdioma->eliminar($id,$usuario_id);
	}
}