<?php 

namespace App\Servicios\Semilleros;

use App\Dominio\Modelos\Actividad;
use App\Dominio\Modelos\Semillero;
use App\Dominio\Persistencia\Repositorios\IReportes;
use App\Dominio\Persistencia\Repositorios\IRepositorioActividad;
use App\Dominio\Persistencia\Repositorios\IRepositorioArchivoEntrega;
use App\Dominio\Persistencia\Repositorios\IRepositorioEntrega;
use App\Dominio\Persistencia\Repositorios\IRepositorioSemillero;
use App\Dominio\Persistencia\Repositorios\IRepositorioUsuarioHasSemillero;
use App\Dominio\Servicios\Semilleros\ISemilleroServicio;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class SemilleroServicio implements ISemilleroServicio{
    private IRepositorioSemillero $RepositorioSemillero;
    private IReportes $Reportes;
    private IRepositorioUsuarioHasSemillero $RepositorioUsuarioHasSemillero;
    private IRepositorioActividad $RepositorioActividad; 
    private IRepositorioArchivoEntrega $RepositorioArchivoEntrega;
    private IRepositorioEntrega $RepositorioEntrega;

    public function __construct(IRepositorioSemillero $RepositorioSemillero,IReportes $Reportes,IRepositorioUsuarioHasSemillero $RepositorioUsuarioHasSemillero,IRepositorioActividad $RepositorioActividad,IRepositorioArchivoEntrega $RepositorioArchivoEntrega,IRepositorioEntrega $RepositorioEntrega)
    {
        $this->RepositorioSemillero=$RepositorioSemillero;
        $this->Reportes=$Reportes;
        $this->RepositorioUsuarioHasSemillero=$RepositorioUsuarioHasSemillero;
        $this->RepositorioActividad=$RepositorioActividad;
        $this->RepositorioArchivoEntrega=$RepositorioArchivoEntrega;
        $this->RepositorioEntrega=$RepositorioEntrega;
    }
    
    public function crear(array $datos,int $usuario_rol)
    {
        if($usuario_rol==1 || $usuario_rol==2){
            $semillero=new Semillero();
            $semillero->setNombre(isset($datos['nombre']) ? $datos['nombre']:null);
            $semillero->setFecha_inicio(isset($datos['fecha_inicio']) ? $datos['fecha_inicio']:null);
            $semillero->setCoordinador_id(isset($datos['coordinador_id']) ? $datos['coordinador_id']:null);
            $semillero->setLider_id(isset($datos['lider_id']) ? $datos['lider_id']:null);
            if(!$semillero->validarRegistro()->fails()){
                if($semillero->usuarioEsAptoComoLiderSemillero($this->getUsuariosAptosComoLideresSemillero()) && $semillero->usuarioEsAptoComoCoordinadorSemillero($this->getUsuariosAptosComoCoordinadoresSemillero())){
                    $semillero->setCodigo($semillero->generarCodigo());
                    if($this->RepositorioSemillero->insertar($semillero->getArreglo())){
                        return $semillero->getCodigo();
                    }
                } 
            }
        }
        return false;
    }

    public function getUsuariosAptosComoLideresSemillero(){
        return $this->Reportes->getUsuariosAptosComoLideresSemillero();
    }

    public function getUsuariosAptosComoCoordinadoresSemillero(){
        return $this->Reportes->getUsuariosAptosComoCoordinadoresSemillero();
    }

    public function getInformacionSemillero(string $codigo){
        return $this->Reportes->getInformacionGeneralSemillero($codigo);
    }

    public function getInformacionEncargadosDeSemillero(int $id){
        return $this->Reportes->getInformacionEncargadosDeSemillero($id);
    }

    public function getUsuariosAptosComoSemilleristas(int $semillero_id)
    {
        return $this->Reportes->getUsuariosAptosComoSemilleristas($semillero_id);
    }

    public function agregarSemilleristas(array $datos,$codigo,$usuario_rol,$usuario_id)
    {
        if($infoGeneral=$this->getInformacionSemillero($codigo)){
            if($usuario_rol==1 || $usuario_rol==2 || $this->usuarioEsLiderDeSemillero($infoGeneral[0]->id,$usuario_id) || $this->usuarioEsCoordinadorDeSemillero($infoGeneral[0]->id,$usuario_id)){
                $semillero=new Semillero();
                $semillero->setSemilleristas_id(isset($datos['usuario_id']) ? $datos['usuario_id']:null);
                if($semillero->usuariosSonAptosComoSemilleristas($this->getUsuariosAptosComoSemilleristas($infoGeneral[0]->id))){
                    $semillero->setId($infoGeneral[0]->id);
                    return $this->RepositorioUsuarioHasSemillero->insertarVarios($semillero->getArregloRegistroSemilleristas());
                }
            }
        }
        return false;
    }

    public function getSemilleristas(int $semillero_id)
    {
        return $this->Reportes->getInformacionDeSemilleristas($semillero_id);
    }

    public function usuarioEsLiderDeSemillero($semillero_id,$usuario_id)
    {
        if($this->RepositorioSemillero->buscarPorSemilleroIdYLiderId($semillero_id,$usuario_id)){
            return true;
        }
        return false;
    }

    public function usuarioEsCoordinadorDeSemillero($semillero_id,$usuario_id)
    {
        return $this->RepositorioSemillero->buscarPorSemilleroIdYCoordinadorId($semillero_id,$usuario_id) ? true:false;
    }

    public function usuarioEsSemilleristaDeSemillero(int $semillero_id,int $usuario_id)
    {
        $semillero=new Semillero();
        return $semillero->usuarioEsSemilleristaDeSemillero($this->getSemilleristas($semillero_id),$usuario_id);
    }

    public function usuarioEsSemilleristaDeSemilleroPorCodigo(int $semillero_id,string $usuario_cod)
    {
        $semillero=new Semillero();
        return $semillero->usuarioEsSemilleristaDeSemilleroPorCodigo($this->getSemilleristas($semillero_id),$usuario_cod);
    }

    public function getSemillerosVigentes(){
        return $this->Reportes->getSemillerosVigentes();
    }

    public function getSemillerosDeUsuario(int $usuario_id)
    {
        return  $this->Reportes->getSemillerosDeUsuario($usuario_id);
    }

    ///////////////////// actividades ////////////////////////////////////
    public function crearActividad(array $datos,string $semillero_codigo,int $usuario_rol,int $usuario_id)
    {
        if($info=$this->getInformacionSemillero($semillero_codigo)){
            if($usuario_rol==1 || $usuario_rol==2 || $this->usuarioEsLiderDeSemillero($info[0]->id,$usuario_id) || $this->usuarioEsCoordinadorDeSemillero($info[0]->id,$usuario_id)){
                $actividad=new Actividad();
                $actividad->setTitulo(isset($datos['titulo']) ? $datos['titulo']:null);
                $actividad->setFecha_entrega(isset($datos['fecha_entrega']) ? $datos['fecha_entrega']:null);
                $actividad->setInstrucciones(isset($datos['instrucciones']) ? $datos['instrucciones']:null);
                $actividad->setCodigo($actividad->generarCodigo());
                $actividad->setSemillero_id($info[0]->id);
                if(!$actividad->validarRegistro()->fails()){
                    if($this->RepositorioActividad->insertar($actividad->getArregloRegistro())){
                        $salida=array(
                            'codigo_semillero'=>$semillero_codigo,
                            'codigo_actividad'=>$actividad->getCodigo()
                        );
                        return $salida;
                    }
                }
            }
        }
        return false;
    }

    public function getActividades(int $semillero_id)
    {
        return $this->RepositorioActividad->getActividades($semillero_id);
    }

    public function getInformacionActividad(int $semillero_id,string $codigo_actividad)
    {
        return $this->Reportes->getInformacionDeActividadDeSemillero($semillero_id,$codigo_actividad);
    }

    public function getInformacionEntrega(int $actividad_id,int $usuario_id)
    {
        return $this->Reportes->getInformacionDeEntrega($actividad_id,$usuario_id);
    }

    public function getArchivosDeEntrega(int $entrega_id)
    {
        return $this->RepositorioArchivoEntrega->getArchivosDeEntrega($entrega_id);
    }

    public function crearEntregaSiNoExiste($semillero_codigo,$codigo_actividad,$usuario_id)
    {
        if($infoSemillero=$this->getInformacionSemillero($semillero_codigo)){
            $integrante=$this->usuarioEsSemilleristaDeSemillero($infoSemillero[0]->id,$usuario_id);
            if($integrante && $infoActividad=$this->getInformacionActividad($infoSemillero[0]->id,$codigo_actividad)){
                if($this->getInformacionEntrega($infoActividad[0]->id,$usuario_id)){
                    return true;
                }
                else{
                    $actividad=new Actividad();
                    $actividad->setEntrega($infoActividad[0]->id,$usuario_id);
                    return $this->RepositorioEntrega->insertar($actividad->getArregloRegistroEntrega());
                }
            }
        }
    }

    public function subirArchivoEntrega(array $datos,$codigo_semillero,$codigo_actividad,$usuario_id)
    {
        if($infoSemillero=$this->getInformacionSemillero($codigo_semillero)){
            if($infoActividad=$this->getInformacionActividad($infoSemillero[0]->id,$codigo_actividad)){
                //por el momento no es necesario validar si el usuario pertenece al semillero ya que esto se puede validar por medio de la misma existencia de la entrega.
                if($infoEntrega=$this->getInformacionEntrega($infoActividad[0]->id,$usuario_id)){
                    $actividad=new Actividad();
                    $actividad->setArchivoEntrega($infoEntrega[0]->id,isset($datos['archivo']) ? $datos['archivo']:null);
                    if(!$actividad->getValidezArchivoEntrega()->fails()){
                        $infoArchivo=$actividad->getArregloRegistroArchivoEntrega();
                        $this->RepositorioArchivoEntrega->insertar($infoArchivo);
                        return $infoArchivo;
                    }
                }
            }
        }
        return false;
    }

    public function pdescargarArchivoEntrega($codigo_semillero,$codigo_actividad,$usuario_id,$ruta){
        if($infoSemillero=$this->getInformacionSemillero($codigo_semillero)){
            if($infoActividad=$this->getInformacionActividad($infoSemillero[0]->id,$codigo_actividad)){
                if($infoEntrega=$this->getInformacionEntrega($infoActividad[0]->id,$usuario_id)){
                    if($infoArchivo=$this->RepositorioArchivoEntrega->getNombreArchivo($ruta,$infoEntrega[0]->id)){
                        return Storage::download($ruta,$infoArchivo[0]->nombre);
                    }
                }
            }
        }
        return false;
    }

    public function descargarArchivoEntrega($codigo_semillero,$codigo_actividad,$usuario_rol,$usuario_id,$ruta,$autor_codigo=null)
    {
        if($infoSemillero=$this->getInformacionSemillero($codigo_semillero)){
            if($infoActividad=$this->getInformacionActividad($infoSemillero[0]->id,$codigo_actividad)){
                $autor_id=0;
                switch ($usuario_rol){
                    case 1:
                        $autor=$this->usuarioEsSemilleristaDeSemilleroPorCodigo($infoSemillero[0]->id,$autor_codigo);
                        $autor_id= $autor ? $autor->id:0;
                        break;
                    case 2:
                        $autor=$this->usuarioEsSemilleristaDeSemilleroPorCodigo($infoSemillero[0]->id,$autor_codigo);
                        $autor_id= $autor ? $autor->id:0;
                        break;
                    case 3:
                        if($this->usuarioEsCoordinadorDeSemillero($infoSemillero[0]->id,$usuario_id)){
                            $autor=$this->usuarioEsSemilleristaDeSemilleroPorCodigo($infoSemillero[0]->id,$autor_codigo);
                            $autor_id= $autor ? $autor->id:0;
                        }
                        break;
                    case 4:
                        if($this->usuarioEsLiderDeSemillero($infoSemillero[0]->id,$usuario_id)){
                            $autor=$this->usuarioEsSemilleristaDeSemilleroPorCodigo($infoSemillero[0]->id,$autor_codigo);
                            $autor_id= $autor ? $autor->id:0;
                        }
                        else{
                            $autor_id=$usuario_id;
                        }
                        break;
                    default:
                        return false;
                        break;
                }
                if($infoEntrega=$this->getInformacionEntrega($infoActividad[0]->id,$autor_id)){
                    if($infoArchivo=$this->RepositorioArchivoEntrega->getNombreArchivo($ruta,$infoEntrega[0]->id)){
                        return Storage::download($ruta,$infoArchivo[0]->nombre);
                    }
                }
            }
        }
        return false;
    }

    public function eliminarArchivoEntrega(string $codigo_semillero,string $codigo_actividad,int $usuario_id,string $ruta)
    {
        if($infoSemillero=$this->getInformacionSemillero($codigo_semillero)){
            if($infoActividad=$this->getInformacionActividad($infoSemillero[0]->id,$codigo_actividad)){
                if($infoEntrega=$this->getInformacionEntrega($infoActividad[0]->id,$usuario_id)){
                    if($this->RepositorioArchivoEntrega->eliminar($infoEntrega[0]->id,$ruta)){
                        Storage::delete($ruta);
                        return true;
                    }
                }
            }
        }
        return false;
    }

    public function getEntregasPorActividad(int $semillero_id)
    {
        return $this->Reportes->getEntregasPorActividad($semillero_id);
    }
}