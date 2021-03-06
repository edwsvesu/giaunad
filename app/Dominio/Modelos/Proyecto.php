<?php
namespace App\Dominio\Modelos;
use Illuminate\Support\Facades\Validator;

class Proyecto{
    private $id;
    private $titulo;
    private $fecha_inicio;
    private $fecha_fin;
    private $codigo;
    private $documentos;
    private $tipo_proyecto;
    private $tipo_proyecto_id;
    private $lider_id;

    public function setId($id)
    {
        $this->id=$id;
    }

    public function setTipo_proyecto($tipo_proyecto){
        $this->tipo_proyecto=$tipo_proyecto;
    }

    public function getTipo_proyecto_id(){
        return $this->tipo_proyecto_id;
    }

    public function getTipo_proyecto(){
        return $this->tipo_proyecto;
    }

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

    public function getCodigo()
    {
        return $this->codigo;
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
            'titulo'=>'required',
            'lidera'=>'required'
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

    public function validezTipoProyecto(){
        $atributos=array(
            'tipo_proyecto'=>$this->tipo_proyecto,
        );

        $validacion=Validator::make($atributos,[
            'tipo_proyecto'=>'required'
        ]);
        return $validacion;
    }

    public function getArregloEditar()
    {
        return array(
            'codigo'=>$this->codigo,
            'titulo'=>$this->titulo,
            'fecha_inicio'=>$this->fecha_inicio,
            'fecha_fin'=>$this->fecha_fin,
            'tipo_proyecto_id'=>$this->tipo_proyecto_id,
            'id'=>$this->id
        );
    }

    public function validarEditar($listaTipoProyectos,$codigo_proyecto,$codigo_registrado)
    {
        if(!$this->tipoDeProyectoEsValido($listaTipoProyectos)){
            $this->tipo_proyecto_id=null;
        }
        if($codigo_proyecto!=$this->codigo && $codigo_registrado){
            $this->codigo=null;
        }
        $atributos=$this->getArregloEditar();
        $validacion=Validator::make($atributos,[
            'codigo'=>'required',
            'tipo_proyecto_id'=>'required'
        ]);
        return $validacion;
    }

    public function tipoDeProyectoEsValido($listaTipoProyectos)
    {
        foreach ($listaTipoProyectos as $tipo) {
            if($tipo->id==$this->tipo_proyecto_id){
                return true;
            }
        }
        return false;
    }
}