<?php

namespace App\Servicios\Usuarios\Curriculum;
use App\Dominio\Servicios\Usuarios\Curriculum\IDatosPersonalesServicio;
use App\Dominio\Persistencia\Repositorios\IReportes;
use App\Dominio\Persistencia\Repositorios\IRepositorioTelefono;
use App\Dominio\Modelos\Usuario;
use App\Dominio\Persistencia\Repositorios\IRepositorioUsuario;
use Illuminate\Support\Facades\Storage;

class DatosPersonalesServicio implements IDatosPersonalesServicio{
	private IReportes $Reportes;
	private IRepositorioTelefono $RepositorioTelefono;
	private IRepositorioUsuario $RepositorioUsuario;

	public function __construct(IReportes $Reportes,IRepositorioTelefono $RepositorioTelefono,IRepositorioUsuario $RepositorioUsuario){
		$this->Reportes=$Reportes;
		$this->RepositorioTelefono=$RepositorioTelefono;
		$this->RepositorioUsuario=$RepositorioUsuario;
	}

	public function getDatos(int $usuario_id){
		$datos=$this->Reportes->getDatosPersonalesUsuario($usuario_id);
		$telefonos=$this->RepositorioTelefono->getTodosPorUsuarioId($usuario_id);
		$datos['telefonos']=$telefonos;
		return $datos;
	}

	public function eliminarTelefono(array $datos,int $usuario_id){
		$id=isset($datos['telefono_id']) ? (ctype_digit($datos['telefono_id']) ? $datos['telefono_id']:0):0;
		return $this->RepositorioTelefono->eliminar($id,$usuario_id);
	}

	public function editarInformacion(array $datos,int $id){
		$usuario=new Usuario();
		//$usuario->setNumero_documento(isset($datos['numero_documento']) ? $datos['numero_documento']:'');
		$usuario->setId($id);
		$usuario->setNombres(isset($datos['nombres']) ? $datos['nombres']:'');
		$usuario->setApellidos(isset($datos['apellidos']) ? $datos['apellidos']:'');
		$usuario->setCorreo_principal(isset($datos['correo_principal']) ? $datos['correo_principal']:'');
		$usuario->setCorreo_secundario(isset($datos['correo_secundario']) ? $datos['correo_secundario']:'');
		$usuario->setFoto(isset($datos['foto']) ? $datos['foto']:'');
		$usuario->setTelefonos(isset($datos['telefonos']) ? $datos['telefonos']:'');
		if(!($usuario->validez2()->fails()) && $usuario->validarTelefonos()){
			$datos=$usuario->getArregloEditar();
			$foto=$usuario->getFoto();
			if($foto){
				$ruta=$this->RepositorioUsuario->getFoto($id)[0]->foto;
				Storage::disk('public')->delete($ruta);
				$datos['foto']=Storage::disk('public')->put('usuario/avatar',$foto);	
			}
			$this->RepositorioUsuario->editar($datos);
			$telefonos=$usuario->getTelefonos();
			if($telefonos){
				$this->RepositorioTelefono->actualizarVarios($telefonos);
			}
		}
		else{
			return "vayase a la verga"; 
		}
	}

	public function agregarTelefono(array $datos,int $usuario_id){
		$usuario=new Usuario();
		$telefono=array(
			'descripcion'=>isset($datos['descripcion']) ? $datos['descripcion']: null,
			'numero'=>isset($datos['numero']) ? $datos['numero']: null,
			'usuario_id'=>$usuario_id
		);
		$usuario->setTelefono($telefono);
		if($usuario->validarTelefonos()){
			return $this->RepositorioTelefono->insertar($telefono);
		}
	}
}

