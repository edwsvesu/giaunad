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

	public function __construct(IRepositorioTipoProyecto $RepositorioTipoProyecto,IRepositorioProyecto $RepositorioProyecto,IRepositorioDocumento $RepositorioDocumento,IRepositorioUsuario $RepositorioUsuario,IRepositorioUsuarioHasProyecto $RepositorioUsuarioHasProyecto){
		$this->RepositorioTipoProyecto=$RepositorioTipoProyecto;
		$this->RepositorioProyecto=$RepositorioProyecto;
		$this->RepositorioDocumento=$RepositorioDocumento;
		$this->RepositorioUsuario=$RepositorioUsuario;
		$this->RepositorioUsuarioHasProyecto=$RepositorioUsuarioHasProyecto;
	}

	public function getTodosTiposDeProyectos(){
		return $this->RepositorioTipoProyecto->getTodos();
	}

	public function registrarNuevoProyecto(array $datos){
		if(!$this->proyectoEstaRegistrado(isset($datos['codigo']) ? $datos['codigo']:'')){
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
				return "Registrado!!!";
	        }
    	}
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


	public function subirDocumentos(array $datos){
		$proyecto=new Proyecto();
		$proyecto->setDocumentos(isset($datos['documentos']) ? $datos['documentos']:'');
		if($proyecto->validezArchivos() && isset($datos['proyecto_id'])){
				if($this->proyectoEstaRegistradoPorId($datos['proyecto_id'])){
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


	public function borrarDocumento(array $datos){
		if(isset($datos['ruta'])){
			if($this->RepositorioDocumento->eliminarDocumento($datos['ruta'])){
				Storage::delete($datos['ruta']);
				return true;
			}
		}
		else{
			return false;
		}
	}

	public function getIntegrantesProyecto(int $proyecto_id){
		return $this->RepositorioUsuario->getUsuariosAptosComoIntegrantesProyecto($proyecto_id);
	}

	public function setIntegranteProyecto(array $datos){
		if(isset($datos['proyecto_id']) && isset($datos['usuario_id'])){
			if(ctype_digit($datos['proyecto_id']) && ctype_digit($datos['usuario_id'])){
				$this->RepositorioUsuarioHasProyecto->insertar(array(
					'proyecto_id'=>$datos['proyecto_id'],
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
}