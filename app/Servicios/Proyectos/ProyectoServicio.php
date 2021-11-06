<?php
namespace App\Servicios\Proyectos;
use App\Dominio\Servicios\Proyectos\IProyectoServicio;
use App\Dominio\Persistencia\Repositorios\IRepositorioTipoProyecto;
use App\Dominio\Persistencia\Repositorios\IRepositorioProyecto;
use App\Dominio\Modelos\Proyecto;
use App\Dominio\Persistencia\Repositorios\IRepositorioDocumento;
use Illuminate\Support\Facades\Storage;
use App\Dominio\Persistencia\Repositorios\IRepositorioUsuario;
use App\Dominio\Persistencia\Repositorios\IRepositorioUsuarioHasProyecto;
use App\Dominio\Persistencia\Repositorios\IReportes;

class ProyectoServicio implements IProyectoServicio{
	private IRepositorioTipoProyecto $RepositorioTipoProyecto;
	private IRepositorioProyecto $RepositorioProyecto;
	private IRepositorioDocumento $RepositorioDocumento;
	private IRepositorioUsuario $RepositorioUsuario;
	private IRepositorioUsuarioHasProyecto $RepositorioUsuarioHasProyecto;
	private IReportes $Reportes;

	public function __construct(IRepositorioTipoProyecto $RepositorioTipoProyecto,IRepositorioProyecto $RepositorioProyecto,IRepositorioDocumento $RepositorioDocumento,IRepositorioUsuario $RepositorioUsuario,IRepositorioUsuarioHasProyecto $RepositorioUsuarioHasProyecto,IReportes $Reportes){
		$this->RepositorioTipoProyecto=$RepositorioTipoProyecto;
		$this->RepositorioProyecto=$RepositorioProyecto;
		$this->RepositorioDocumento=$RepositorioDocumento;
		$this->RepositorioUsuario=$RepositorioUsuario;
		$this->RepositorioUsuarioHasProyecto=$RepositorioUsuarioHasProyecto;
		$this->Reportes=$Reportes;
	}

	public function getTodosTiposDeProyectos(){
		return $this->RepositorioTipoProyecto->getTodos();
	}

	public function getInformacionGeneralProyecto(string $codigo){
		return $this->Reportes->getInformacionGeneralProyecto($codigo);
	}

	public function registrarNuevoProyecto(array $datos,int $usuario_rol){
		if(!$this->proyectoEstaRegistrado(isset($datos['codigo']) ? $datos['codigo']:'') && ($usuario_rol==1 || $usuario_rol==2)){
			$proyecto=new Proyecto();
			$proyecto->setTitulo(isset($datos['titulo']) ? $datos['titulo']:'');
			$proyecto->setFecha_inicio(isset($datos['fecha_inicio']) ? $datos['fecha_inicio']:'');
			$proyecto->setFecha_fin(isset($datos['fecha_fin']) ? $datos['fecha_fin']:'');
			$proyecto->setCodigo(isset($datos['codigo']) ? $datos['codigo']:'');
			$proyecto->setTipo_proyecto_id(isset($datos['tipo_proyecto_id']) ? $datos['tipo_proyecto_id']:'');
			$proyecto->setDocumentos(isset($datos['documento']) ? $datos['documento']:'');
			$proyecto->setLider_id(isset($datos['lidera']) ? $datos['lidera']:'');
			if(!($proyecto->validez()->fails()) && $proyecto->validezArchivos()){
				$arregloProyecto=$proyecto->getArregloProyecto();
				if(!empty($arregloProyecto['documentos'])){
					foreach ($arregloProyecto['documentos'] as $file) {
						$documentos[]=array(
							'nombre'=>$file->getClientOriginalName(),
							'ruta'=>$file->store('proyectos/documentos')
						);
					}
					$arregloProyecto['documentos']=$documentos;
				}
				$this->RepositorioProyecto->insertar($arregloProyecto);
				return true;
	        }
    	}
		return false;
	}

	public function editarProyecto(array $datos,string $codigo_proyecto,int $usuario_rol)
	{
		if($infoProyecto=$this->getInformacionGeneralProyecto($codigo_proyecto)){
			if($usuario_rol==1 || $usuario_rol==2){
				$proyecto=new Proyecto();
				$proyecto->setId($infoProyecto[0]->id);
				$proyecto->setCodigo(isset($datos['codigo']) ? $datos['codigo']:null);
				$proyecto->setTitulo(isset($datos['titulo']) ? $datos['titulo']:null);
				$proyecto->setFecha_inicio(isset($datos['fecha_inicio']) ? $datos['fecha_inicio']:null);
				$proyecto->setFecha_fin(isset($datos['fecha_fin']) ? $datos['fecha_fin']:null);
				$proyecto->setTipo_proyecto_id(isset($datos['tipo_proyecto_id']) ? $datos['tipo_proyecto_id']:null);
				if(!$proyecto->validarEditar($this->getTodosTiposDeProyectos(),$codigo_proyecto,$this->proyectoEstaRegistrado($proyecto->getCodigo()))->fails()){
					return $this->RepositorioProyecto->editar($proyecto->getArregloEditar()) ? $proyecto->getCodigo():false;
				}
			}
		}
		return false;
	}


	public function proyectoEstaRegistrado(string $codigo){
		$registro=$this->RepositorioProyecto->buscarPorCodigo($codigo);
		if($registro){
			return true;
		}
		else{
			return false;
		}
	}

	public function proyectoEstaRegistradoPorId(int $id){
		$registro=$this->RepositorioProyecto->buscarPorId($id);
		if($registro){
			return true;
		}
		else{
			return false;
		}
	}

	public function getDocumentos(int $proyecto_id){
		return $this->RepositorioDocumento->getDocumentosPorProyecto($proyecto_id);
	}

	public function descargarDocumento(string $ruta,string $nombre){
			return Storage::download($ruta,$nombre);
	}

	/*public function subirDocumentos(array $datos){
		if(isset($datos['documentos']) && isset($datos['proyecto_id'])){
			if(is_array($datos['documentos'])){
				if($datos['documentos'] && $this->proyectoEstaRegistradoPorId($datos['proyecto_id'])){
					foreach ($datos['documentos'] as $file) {
						$documentos[]=array(
							'nombre'=>$file->getClientOriginalName(),
							'ruta'=>$file->store('proyectos/documentos'),
							'proyecto_id'=>$datos['proyecto_id']
						);
					}
				$this->RepositorioDocumento->insertarDocumentos($documentos);
				return $documentos;
				}
				
			}
		}
	}*/

	public function crearTipoProyecto(array $datos,$usuario_rol){
		if($usuario_rol==1 || $usuario_rol==2){
			$proyecto=new Proyecto();
			$proyecto->setTipo_proyecto(isset($datos['tipo_proyecto']) ? $datos['tipo_proyecto']:null);
			if(!$proyecto->validezTipoProyecto()->fails()){
				return $this->RepositorioTipoProyecto->insertar($proyecto->getTipo_proyecto());
			}
		}
	}

	public function editarTipoProyecto(array $datos,int $usuario_rol){
		if($usuario_rol==1 || $usuario_rol==2){
			$proyecto=new Proyecto();
			$proyecto->setTipo_proyecto(isset($datos['nuevo_valor']) ? $datos['nuevo_valor']:null);
			$proyecto->setTipo_proyecto_id(isset($datos['tipo_proyecto_id_act']) ? $datos['tipo_proyecto_id_act']:null);
			if(!$proyecto->validezTipoProyecto()->fails()){
				return $this->RepositorioTipoProyecto->editar($proyecto->getTipo_proyecto_id(),$proyecto->getTipo_proyecto());
			}
		}
	}


	//! crear arreglo en la clase proyecto para insertar documentos...
	public function subirDocumentos(array $datos,string $proyecto_cod,int $usuario_id,int $usuario_rol){
		if($this->proyectoEstaRegistrado($proyecto_cod) && isset($datos['documentos'])){
			$proyecto_id=$this->getIdProyecto($proyecto_cod);
			if($this->usuarioEsLiderDeProyecto($proyecto_id,$usuario_id) || $usuario_rol==1 || $usuario_rol==2){
				$proyecto=new Proyecto();
				$proyecto->setDocumentos($datos['documentos']);
				if($proyecto->validezArchivos()){
					foreach ($datos['documentos'] as $file) {
						$documentos[]=array(
							'nombre'=>$file->getClientOriginalName(),
							'ruta'=>$file->store('proyectos/documentos'),
							'proyecto_id'=>$proyecto_id
						);
					}
					$this->RepositorioDocumento->insertarDocumentos($documentos);
					return $documentos;
				}
			}
		}
	}


	public function borrarDocumento(array $datos,string $proyecto_cod,int $usuario_id,int $usuario_rol){
		if(isset($datos['ruta']) && $this->proyectoEstaRegistrado($proyecto_cod)){
			$proyecto_id=$this->getIdProyecto($proyecto_cod);
			if($this->usuarioEsLiderDeProyecto($proyecto_id,$usuario_id) || $usuario_rol==1 || $usuario_rol=2){
				if($this->RepositorioDocumento->eliminarDocumento($datos['ruta'],$proyecto_id)){
					Storage::delete($datos['ruta']);
					return true;
				}
				else{
					return false;
				}
			}
			else{
				return false;
			}
		}
		else{
			return false;
		}
	}

	public function getIntegrantesProyecto(int $proyecto_id){
		return $this->RepositorioUsuario->getUsuariosAptosComoIntegrantesProyecto($proyecto_id);
	}

	public function eliminarTipoProyecto(array $datos,int $usuario_rol){
		if($usuario_rol==1 || $usuario_rol==2){
			$id=isset($datos['tipo_proyecto_id_el']) ? (ctype_digit($datos['tipo_proyecto_id_el']) ? $datos['tipo_proyecto_id_el']:0):0;
			return $this->RepositorioTipoProyecto->eliminar($id);
		}
	}

	public function setIntegranteProyecto(array $datos,string $proyecto_cod,int $usuario_id,int $usuario_rol){
		if(isset($datos['usuario_id']) && $this->proyectoEstaRegistrado($proyecto_cod)){
			$proyecto_id=$this->getIdProyecto($proyecto_cod);
			if(ctype_digit($datos['usuario_id']) && ($this->usuarioEsLiderDeProyecto($proyecto_id,$usuario_id) || $usuario_rol==1 || $usuario_rol==2)){
				$this->RepositorioUsuarioHasProyecto->insertar(array(
					'proyecto_id'=>$proyecto_id,
					'usuario_id'=>$datos['usuario_id']
				));
				return true;
			}
			else{
				return false;
			}
		}
		else{
			return false;
		}
	}

	public function usuarioEsIntegranteDeProyecto(int $usuario_id,int $proyecto_id){
		$registro=$this->RepositorioUsuarioHasProyecto->get($usuario_id,$proyecto_id);
		if($registro){
			return true;
		}
		else{
			return false;
		}
	}

	public function usuarioEsLiderDeProyecto(int $proyecto_id,int $usuario_id){
		$registro=$this->RepositorioProyecto->buscarPorIdYLiderId($proyecto_id,$usuario_id);
		if($registro){
			return true;
		}
		else{
			return false;
		}
	}

	public function usuarioEsLiderDeProyectoPorCodigo(string $proyecto_cod,int $usuario_id){
		$registro=$this->RepositorioProyecto->buscarPorCodigoYLiderId($proyecto_cod,$usuario_id);
		if($registro){
			return true;
		}
		else{
			return false;
		}
	}

	public function getIdProyecto(string $codigo){
		return $this->RepositorioProyecto->getId($codigo)[0]->id;
	}
}