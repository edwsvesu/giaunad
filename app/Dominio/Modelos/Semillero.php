<?php
namespace App\Dominio\Modelos;
use Illuminate\Support\Facades\Validator;

class Semillero{
    private $nombre;
    private $codigo;
    private $id;
    private $fecha_inicio;
    private $coordinador_id;
    private $lider_id;
    private $semilleristas_id;

    public function setId($id)
    {
        $this->id=$id;
    }

    public function setSemilleristas_id($semilleristas)
    {
        $this->semilleristas_id=$semilleristas;
    }

    public function getNombre(){
		return $this->nombre;
	}

	public function setNombre($nombre){
		$this->nombre = $nombre;
	}

	public function getCodigo(){
		return $this->codigo;
	}

	public function setCodigo($codigo){
		$this->codigo = $codigo;
	}

	public function getFecha_inicio(){
		return $this->fecha_inicio;
	}

	public function setFecha_inicio($fecha_inicio){
		$this->fecha_inicio = $fecha_inicio;
	}

	public function getCoordinador_id(){
		return $this->coordinador_id;
	}

	public function setCoordinador_id($coordinador_id){
		$this->coordinador_id = $coordinador_id;
	}

	public function getLider_id(){
		return $this->lider_id;
	}

	public function setLider_id($lider_id){
		$this->lider_id = $lider_id;
	}

    public function validarRegistro(){
        $validator = Validator::make($this->getArreglo(),[
            'nombre' => 'required   ',
        ]);
        return $validator;
    }

    public function generarCodigo(){
        $arrayText = explode(" ",$this->nombre);
        $acronym = "";
        foreach ($arrayText as $word)   {
        $arrayLetters = str_split($word, 1);
        $acronym =  $acronym . $arrayLetters['0'];
        } 
        return $acronym."-".uniqid();
    }

    public function getArreglo(){
        return array(
            'nombre'=>$this->nombre,
            'codigo'=>$this->codigo,
            'fecha_inicio'=>$this->fecha_inicio,
            'coordinador_id'=>$this->coordinador_id,
            'lider_id'=>$this->lider_id
        );
    }

    public function usuarioEsAptoComoLiderSemillero($listaUsuariosAptos){
        foreach ($listaUsuariosAptos as $usuario) {
            if($usuario->id==$this->lider_id){
                return true;
            }
        }
        return false;
    }

    public function usuarioEsAptoComoCoordinadorSemillero($listaUsuariosAptos){
        foreach ($listaUsuariosAptos as $usuario) {
            if($usuario->id==$this->coordinador_id){
                return true;
            }
        }
        return false;
    }

    public function usuariosSonAptosComoSemilleristas($listaUsuariosAptos)
    {
        if(!is_null($this->semilleristas_id) && count(array_unique($this->semilleristas_id))==count($this->semilleristas_id)){
            $usuarioNoApto=true;
            foreach($this->semilleristas_id as $semillerista_id){
                foreach ($listaUsuariosAptos as $usuario) {
                    if($usuario->id==$semillerista_id){
                        $usuarioNoApto=false;
                        break;
                    }
                }
                if($usuarioNoApto){
                    return false;
                }
                $usuarioNoApto=true;
            }
            return true;
        }
        return false;
    }

    public function getArregloRegistroSemilleristas()
    {
        $arreglo=array();
        foreach($this->semilleristas_id as $semillerista_id){
            $arreglo[]=array(
                'usuario_id'=>$semillerista_id,
                'semillero_id'=>$this->id
            );
        }
        return $arreglo;
    }
}