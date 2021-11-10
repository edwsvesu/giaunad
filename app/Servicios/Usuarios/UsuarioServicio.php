<?php
namespace App\Servicios\Usuarios;

use App\Dominio\Modelos\Usuario;
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

	public function rechazarSolicitudIngreso(array $datos,int $usuario_rol){
		if($usuario_rol==1){
			$numero_documento=isset($datos['numero_documento']) ? $datos['numero_documento']:'';
			return $this->RepositorioUsuario->eliminarPorNoVerificado($numero_documento);
		}
		return false;
	}

	public function aceptarSolicitudIngreso(array $datos,int $usuario_rol){
		if($usuario_rol==1){
			$numero_documento=isset($datos['numero_documento']) ? $datos['numero_documento']:'';
			return $this->RepositorioUsuario->actualizarVerificado($numero_documento,1);
		}
		return false;
	}

	public function getTodosRoles(){
		return $this->RepositorioRol->getTodo();
	}

	public function actualizarRol(array $datos,int $usuario_rol){
		if($usuario_rol==1){
			$numero_documento=isset($datos['numero_documento']) ? $datos['numero_documento']:'';
			$rol_id=isset($datos['rol_id']) ? $datos['rol_id']:0;
			return $rol_id!=0 ? $this->RepositorioUsuario->actualizarRol($numero_documento,$rol_id):false;
		}
		return false;
	}

	public function getIntegrantesDelGrupo(){
		///
	}

	public function getUsuariosAptosComoLideres(){
		return $this->RepositorioUsuario->getUsuariosAptosComoLideres();
	}

	public function eliminarUsuario(array $datos,int $usuario_rol)
	{
		if($usuario_rol==1){
			return $this->RepositorioUsuario->eliminar(isset($datos['numero_documento']) ? $datos['numero_documento']:'');
		}
		return false;
	}

	public function cambiarContra(array $datos,$hash,$usuario_id)
	{
		$usuario=new Usuario();
		$usuario->setPasswordHash($hash);
		if($usuario->ClaveCorrecta(isset($datos['anterior']) ? $datos['anterior']:'')){
			$usuario->setClave($datos['nueva']);
			return $this->RepositorioUsuario->editarPassword($usuario->getClaveEncriptada(),$usuario_id);
		}
	}

	public function cambiarContraTodos(array $datos,int $usuario_id)
	{
		$usuario=new Usuario();
		$usuario->setClave($datos['nueva']);
		return $this->RepositorioUsuario->editarPassword($usuario->getClaveEncriptada(),$usuario_id);
	}
}




