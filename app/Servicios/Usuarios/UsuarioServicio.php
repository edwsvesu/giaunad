<?php
namespace App\Servicios\Usuarios;
use App\Dominio\Servicios\Usuarios\IUsuarioServicio;
use App\Dominio\Persistencia\Repositorios\IRepositorioUsuario;
use App\Dominio\Persistencia\Repositorios\IRepositorioRol;

class UsuarioServicio implements IUsuarioServicio{
	private IRepositorioUsuario $RepositorioUsuario;
	private IRepositorioRol $RepositorioRol;

	public function __construct(IRepositorioUsuario $RepositorioUsuario,IRepositorioRol $RepositorioRol){
		$this->RepositorioUsuario=$RepositorioUsuario;
		$this->RepositorioRol=$RepositorioRol;
	}

	public function getUsuariosNoVerificados(){
		return $this->RepositorioUsuario->getUsuariosNoVerificados();
	}

	public function rechazarSolicitudIngreso(array $datos){
		$numero_documento=isset($datos['numero_documento']) ? $datos['numero_documento']:'';
		return $this->RepositorioUsuario->eliminar($numero_documento);
	}

	public function aceptarSolicitudIngreso(array $datos){
		$numero_documento=isset($datos['numero_documento']) ? $datos['numero_documento']:'';
		return $this->RepositorioUsuario->actualizarVerificado($numero_documento,1);
	}

	public function getTodosRoles(){
		return $this->RepositorioRol->getTodo();
	}

	public function actualizarRol(array $datos){
		$numero_documento=isset($datos['numero_documento']) ? $datos['numero_documento']:'';
		$rol_id=isset($datos['rol_id']) && ctype_digit($datos['rol_id']) ? $datos['rol_id']:0;
		return $rol_id!=0 ? $this->RepositorioUsuario->actualizarRol($numero_documento,$rol_id):false; 
	}

	public function getIntegrantesDelGrupo(){
		///	
	}

	public function getUsuariosAptosComoLideres(){
		return $this->RepositorioUsuario->getUsuariosAptosComoLideres();
	}
}




