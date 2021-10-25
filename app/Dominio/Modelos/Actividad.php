<?php
namespace App\Dominio\Modelos;

use Illuminate\Support\Facades\Validator;
use App\Dominio\Modelos\EntregaActividad;

class Actividad{
    private $id;
    private $codigo;
    private $titulo;
    private $fecha_entrega;
    private $instrucciones;
    private $semillero_id;
    private $entrega;

    public function setEntrega($archivo)
    {
        $entrega=new EntregaActividad();
        $entrega->setArchivo($archivo);
    }

    public function setSemillero_id($semillero_id)
    {
        $this->semillero_id=$semillero_id;
    }

    public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getCodigo(){
		return $this->codigo;
	}

	public function setCodigo($codigo){
		$this->codigo = $codigo;
	}

	public function getTitulo(){
		return $this->titulo;
	}

	public function setTitulo($titulo){
		$this->titulo = $titulo;
	}

	public function getFecha_entrega(){
		return $this->fecha_entrega;
	}

	public function setFecha_entrega($fecha_entrega){
		$this->fecha_entrega = $fecha_entrega;
	}

	public function getInstrucciones(){
		return $this->instrucciones;
	}

	public function setInstrucciones($instrucciones){
		$this->instrucciones = $instrucciones;
	}

    public function generarCodigo(){
        $arrayText = explode(" ",$this->titulo);
        $acronym = "";
        foreach ($arrayText as $word)   {
        $arrayLetters = str_split($word, 1);
        $acronym =  $acronym . $arrayLetters['0'];
        } 
        return $acronym."-".uniqid();
    }

    public function validarRegistro()
    {
        $datos=$this->getArregloRegistro();
        $validacion=Validator::make($datos,[
            'titulo'=>'required'
        ]);
        return $validacion;
    }

    public function getArregloRegistro()
    {
        return array(
            'titulo'=>$this->titulo,
            'codigo'=>$this->codigo,
            'fecha_entrega'=>$this->fecha_entrega,
            'instrucciones'=>$this->instrucciones,
            'semillero_id'=>$this->semillero_id
        );
    }

    public function getValidezArchivoEntrega()
    {
        return $this->entrega->validarArchivo();
    }

    public function getArregloRegistroArchivoEntrega()
    {
        return $this->entrega->getArregloRegistroArchivo();
    }
}