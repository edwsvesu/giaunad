<?php 

namespace App\Servicios\Semilleros;

use App\Dominio\Modelos\Actividad;
use App\Dominio\Modelos\Semillero;
use App\Dominio\Persistencia\Repositorios\IReportes;
use App\Dominio\Persistencia\Repositorios\IRepositorioActividad;
use App\Dominio\Persistencia\Repositorios\IRepositorioSemillero;
use App\Dominio\Persistencia\Repositorios\IRepositorioUsuarioHasSemillero;
use App\Dominio\Servicios\Semilleros\ISemilleroServicio;
use Illuminate\Validation\ValidationException;

class SemilleroServicio implements ISemilleroServicio{
    private IRepositorioSemillero $RepositorioSemillero;
    private IReportes $Reportes;
    private IRepositorioUsuarioHasSemillero $RepositorioUsuarioHasSemillero;
    private IRepositorioActividad $RepositorioActividad; 

    public function __construct(IRepositorioSemillero $RepositorioSemillero,IReportes $Reportes,IRepositorioUsuarioHasSemillero $RepositorioUsuarioHasSemillero,IRepositorioActividad $RepositorioActividad)
    {
        $this->RepositorioSemillero=$RepositorioSemillero;
        $this->Reportes=$Reportes;
        $this->RepositorioUsuarioHasSemillero=$RepositorioUsuarioHasSemillero;
        $this->RepositorioActividad=$RepositorioActividad;
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

    public function agregarSemilleristas(array $datos,$codigo,$usuario_rol)
    {
        if($usuario_rol==1){
            if($infoGeneral=$this->getInformacionSemillero($codigo)){
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

    ///////////////////// actividades ////////////////////////////////////
    public function crearActividad(array $datos,string $semillero_codigo,int $usuario_rol)
    {
        if($usuario_rol==1){
            if($info=$this->getInformacionSemillero($semillero_codigo)){
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

    public function getSemillerosVigentes(){
        return $this->Reportes->getSemillerosVigentes();
    }
}