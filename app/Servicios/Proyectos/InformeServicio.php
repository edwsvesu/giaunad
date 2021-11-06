<?php

namespace App\Servicios\Proyectos;
use App\Dominio\Servicios\Proyectos\IInformeServicio;
use App\Dominio\Modelos\Informe;
use App\Dominio\Persistencia\Repositorios\IRepositorioInforme;
use App\Dominio\Persistencia\Repositorios\IReportes;
use App\Dominio\Persistencia\Repositorios\IRepositorioArchivoInforme;
use App\Dominio\Persistencia\Repositorios\IRepositorioProyecto;
use Illuminate\Support\Facades\Storage;

class InformeServicio implements IInformeServicio{
	private IRepositorioInforme $RepositorioInforme;
	private IReportes $Reportes;
	private IRepositorioArchivoInforme $RepositorioArchivoInforme;
	private IRepositorioProyecto $RepositorioProyecto;
	public function __construct(IRepositorioInforme $RepositorioInforme,IReportes $Reportes,IRepositorioArchivoInforme $RepositorioArchivoInforme,IRepositorioProyecto $RepositorioProyecto){
		$this->RepositorioInforme=$RepositorioInforme;
		$this->Reportes=$Reportes;
		$this->RepositorioArchivoInforme=$RepositorioArchivoInforme;
		$this->RepositorioProyecto=$RepositorioProyecto;
	}

	public function crear(array $datos,string $proyecto_cod,int $usuario_id,int $usuario_rol){
		if($this->proyectoEstaRegistradoPorCodigo($proyecto_cod)){
			$proyecto_id=$this->getIdProyecto($proyecto_cod);
			if($this->usuarioEsLiderDeProyecto($proyecto_id,$usuario_id) || $usuario_rol==1 || $usuario_rol==2){
				$informe=new Informe();
				$informe->setTitulo(isset($datos['titulo']) ? $datos['titulo']: '');
				$informe->setDescripcion(isset($datos['descripcion']) ? $datos['descripcion']: '');
				$informe->setFecha_limite(isset($datos['fecha_limite']) ? $datos['fecha_limite']: '');
				$informe->setProyecto_id($proyecto_id);
				if(!($informe->validez()->fails())){
					$arregloInforme=$informe->getArregloInforme();
					$id=$this->RepositorioInforme->insertar($arregloInforme);
					if($id>0){
						$salida=array(
							'informe_id'=>$id,
							'proyecto_cod'=>$proyecto_cod
						);
						return $salida;
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

	public function getIdProyecto(string $codigo){
		return $this->RepositorioProyecto->getId($codigo)[0]->id;
	}

	public function getInformes(int $proyecto_id){
		return $this->RepositorioInforme->getInformesPorProyecto($proyecto_id);
	}

	public function getInforme(int $informe_id,string $cod_proyecto){
		return $this->Reportes->getInforme($informe_id,$cod_proyecto);
	}

	public function realizarEntrega(array $datos,string $proyecto_cod,int $informe_id,int $usuario_id,int $usuario_rol){
		$informeInfo=$this->getInforme($informe_id,$proyecto_cod);
		if($informeInfo){
			if($this->usuarioEsLiderDeProyecto($informeInfo[0]->proyecto_id,$usuario_id) || $usuario_rol==1 || $usuario_rol==2){
				$informe=new Informe();
				$informe->setArchivos(isset($datos['archivos']) ? $datos['archivos']: '');
				$informe_id=$informeInfo[0]->id;
				if($informe->validezArchivos()){
					//$this->RepositorioInforme->actualizarFechaEntrega($informe_id,'1999-12-16');
					if($informe->getArchivos()){
						foreach($informe->getArchivos() as $file) {
							$archivos[]=array(
								'nombre'=>$file->getClientOriginalName(),
								'ruta'=>$file->store('proyectos/informes'),
								'informe_id'=>$informe_id
							);
						}
						$this->RepositorioArchivoInforme->insertarArchivos($archivos);
					}
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

	public function getArchivos(int $informe_id){
		return $this->RepositorioArchivoInforme->getPorInforme($informe_id);
	}


	public function informeEstaRegistrado(int $informe_id){
		if($this->RepositorioInforme->buscarPorId($informe_id)){
			return true;
		}
		else{
			return false;
		}
	}

	public function proyectoEstaRegistrado(int $proyecto_id){
		if($this->RepositorioProyecto->buscarPorId($proyecto_id)){
			return true;
		}
		else{
			return false;
		}
	}

	public function proyectoEstaRegistradoPorCodigo(string $proyecto_cod){
		$registro=$this->RepositorioProyecto->buscarPorCodigo($proyecto_cod);
		if($registro){
			return true;
		}
		else{
			return false;
		}
	}

	public function descargarArchivo(string $ruta,string $nombre){
		return Storage::download($ruta,$nombre);
	}

	public function borrarArchivo(array $datos,string $proyecto_cod,int $informe_id,int $usuario_id,int $usuario_rol){
		$informe=$this->getInforme($informe_id,$proyecto_cod);
		if($informe &&  isset($datos['ruta'])){
			if($this->usuarioEsLiderDeProyecto($informe[0]->proyecto_id,$usuario_id) || $usuario_rol==1){
				if($this->RepositorioArchivoInforme->eliminarArchivo($datos['ruta'],$informe[0]->id)){
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

	public function editar(array $datos,$id)
	{
		$entrada=array(
			'titulo'=>$datos['titulo'],
			'fecha_limite'=>$datos['fecha_limite'],
			'descripcion'=>$datos['descripcion'],
			'id'=>$id
		);
		return $this->RepositorioInforme->editar($entrada);
	}

	public function eliminarInforme(string $codigo_proyecto,int $id,int $usuario_rol,int $usuario_id)
	{
		if($infoInforme=$this->getInforme($id,$codigo_proyecto)){
			if($usuario_rol==1 || $usuario_rol==2 || $this->usuarioEsLiderDeProyecto($infoInforme[0]->proyecto_id,$usuario_id)){
				return $this->RepositorioInforme->eliminar($id);
			}
		}
	}
}