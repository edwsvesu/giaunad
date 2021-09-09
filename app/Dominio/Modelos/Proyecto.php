<?php
namespace App\Dominio\Modelos;
use Illuminate\Support\Facades\Validator;

class Proyecto{
    private $titulo;
    private $fecha_inicio;
    private $fecha_fin;
    private $codigo;
    private $documentos;
    private $tipo_proyecto_id;
    private $lider_id;

    public function setTitulo($titulo){
        $this->titulo=$titulo;
    }

    public function setLider_id($lider_id){
        $this->lider_id=$lider_id;
    }

    public function setFecha_inicio($fecha_inicio){
        $this->fecha_inicio=$fecha_inicio;
    }

    public function setFecha_fin($fecha_fin){
        if(empty($fecha_fin)){
            $this->fecha_fin=null;
        }
        else{
            $this->fecha_fin=$fecha_fin;
        }

    }

    public function setCodigo($codigo){
        $this->codigo=$codigo;
    }

    public function setTipo_proyecto_id($tipo_proyecto_id){
        $this->tipo_proyecto_id=$tipo_proyecto_id;
    }

    public function setDocumentos($documentos){
        $this->documentos=$documentos;
    }

    public function getArregloProyecto(){
        $arreglo=array(
            'titulo'=>$this->titulo,
            'fecha_inicio'=>$this->fecha_inicio,
            'fecha_fin'=>$this->fecha_fin,
            'codigo'=>$this->codigo,
            'tipo_proyecto_id'=>$this->tipo_proyecto_id,
            'documentos'=>$this->documentos,
            'lidera'=>$this->lider_id
        );
        return $arreglo;
    }

    public function validez(){
        $atributos=$this->getArregloProyecto();
        /*$atributos=array(
            'nombres'=>$this->nombres,
            'apellidos'=>$this->apellidos,
            'numero_documento'=>$this->numero_documento
        );*/

        $validacion=Validator::make($atributos,[
            'titulo'=>'required'
        ]);
        return $validacion;
    }

    public function validezArchivos(){
        $validez=true;
        if(!$this->noHayDocumentos()){
            if(is_array($this->documentos)){
                foreach($this->documentos as $documento){
                    $validacion=Validator::make(['documento'=>$documento],[
                        'documento'=>'required|file'
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

    public function noHayDocumentos(){
        return empty($this->documentos);
    }
}