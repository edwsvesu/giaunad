<?php
namespace App\Dominio\Modelos;
use Illuminate\Support\Facades\Validator;

class Informe{
	private $titulo;
	private $fecha_limite;
	private $descripcion;
	private $fecha_entrega;
	private $archivos;
	private $proyecto_id;

	public function getTitulo(){
		return $this->titulo;
	}

	public function setTitulo($titulo){
		$this->titulo = $titulo;
	}

	public function getFecha_limite(){
		return $this->fecha_limite;
	}

	public function setFecha_limite($fecha_limite){
		if(empty($fecha_limite)){
            $this->fecha_limite=null;
        }
        else{
            $this->fecha_limite = $fecha_limite;
        }
	}

	public function getDescripcion(){
		return $this->descripcion;
	}

	public function setDescripcion($descripcion){
		if(empty($descripcion)){
			$this->descripcion=null;
		}
		else{
			$this->descripcion=$descripcion;
		}
	}

	public function getFecha_entrega(){
		return $this->fecha_entrega;
	}

	public function setFecha_entrega($fecha_entrega){
		$this->fecha_entrega = $fecha_entrega;
	}

	public function setArchivos($archivos){
		$this->archivos = $archivos;
	}

	public function getArchivos(){
		return $this->archivos;
	}

	public function setProyecto_id($proyecto_id){
		$this->proyecto_id = $proyecto_id;
	}

	public function getProyecto_id(){
		return $this->proyecto_id;
	}

	public function getArregloInforme(){
        $arreglo=array(
            'titulo'=>$this->titulo,
            'fecha_limite'=>$this->fecha_limite,
            'fecha_entrega'=>$this->fecha_entrega,
            'proyecto_id'=>$this->proyecto_id,
            'descripcion'=>$this->descripcion
        );
        return $arreglo;
    }

    public function getArregloEntregaInforme(){
        $arreglo=array(
            'titulo'=>$this->titulo,
            'fecha_limite'=>$this->fecha_limite,
            'fecha_entrega'=>$this->fecha_entrega,
            'proyecto_id'=>$this->proyecto_id,
            'descripcion'=>$this->descripcion
        );
        return $arreglo;
    }

    public function validezArchivos(){
        $validez=true;
        if(!empty($this->archivos)){
            if(is_array($this->archivos)){
                foreach($this->archivos as $archivo){
                    $validacion=Validator::make(['archivo'=>$archivo],[
                        'archivo'=>'required|file'
                    ]);
                    if($validacion->fails()){
                        $validez=$validez && false;
                    }
                    else{
                        $validez=$validez && true;
                    }
                }
            }
            else{
                $validez=false;
            }
        }
        return $validez;
    }

	public function validez(){
        $atributos=$this->getArregloInforme();
        $validacion=Validator::make($atributos,[
            'titulo'=>'required'
        ]);
        return $validacion;
    }
}