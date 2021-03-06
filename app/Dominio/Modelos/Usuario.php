<?php
namespace App\Dominio\Modelos;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Dominio\Modelos\FormacionIdioma;
use App\Dominio\Modelos\FormacionAcademica;

class Usuario{
    private $id;
    private $nombres;
    private $apellidos;
    private $numero_documento;
    private $correo_principal;
    private $correo_secundario;
    private $clave;
    private $telefonos;
    private $foto;
    private $formacion_idioma;
    private $formacion_academica;
    private $passwordHash;

    public function setPasswordHash($hash)
    {
        $this->passwordHash=$hash;
    }

    public function getId(){
        return $this->id;
    }

    public function getFormacion_academica(){
        return $this->formacion_academica;
    }

    public function setFormacion_academica($nivel_id,$titulo,$institucion_id,$intensidad,$promedio,$fecha_inicio,$fecha_fin,$id=null){
        $formacion_academica=new FormacionAcademica();
        $formacion_academica->setNivel_id($nivel_id);
        $formacion_academica->setTitulo($titulo);
        $formacion_academica->setInstitucion($institucion_id);
        $formacion_academica->setIntensidad($intensidad);
        $formacion_academica->setPromedio($promedio);
        $formacion_academica->setFecha_inicio($fecha_inicio);
        $formacion_academica->setFecha_fin($fecha_fin);
        $formacion_academica->setId($id);
        $this->formacion_academica=$formacion_academica;
    }

    public function setFormacion_idioma($lectura,$escritura,$habla,$escucha,$idioma_id,$id=0){
        $formacion_idioma=new FormacionIdioma();
        $formacion_idioma->setId($id);
        $formacion_idioma->setLectura($lectura);
        $formacion_idioma->setEscritura($escritura);
        $formacion_idioma->setHabla($habla);
        $formacion_idioma->setEscucha($escucha);
        $formacion_idioma->setIdioma_id($idioma_id);
        $this->formacion_idioma=$formacion_idioma;
    }

    public function getFormacion_idioma(){
        return $this->formacion_idioma;
    }

    public function setFoto($foto){
        $this->foto=$foto;
    }

    public function getFoto(){
        return $this->foto;
    }

    public function setClave($clave){
        $this->clave=$clave;
    }

    public function setId($id){
        $this->id=$id;
    }

    public function setTelefono($telefono){
        $this->telefonos[]=$telefono;
    }

    public function setTelefonos($telefonos){
        if(is_array($telefonos)){
            $telefono=array(
                'id'=>null,
                'descripcion'=>null,
                'numero'=>null,
                'usuario_id'=>$this->id
            );
            $bandera=0;
            foreach ($telefonos as $value) {
                if(isset($value['id']) && $bandera==0){
                    $telefono['id']=$value['id'];
                    $bandera=1;
                }
                else if(isset($value['descripcion']) && $bandera==1){
                    $telefono['descripcion']=$value['descripcion'];
                    $bandera=2;
                }
                else if(isset($value['numero']) && $bandera==2){
                    $telefono['numero']=$value['numero'];
                    $this->telefonos[]=$telefono;
                    $telefono=array(
                        'id'=>null,
                        'descripcion'=>null,
                        'numero'=>null,
                        'usuario_id'=>$this->id
                    );
                    $bandera=0;
                }
                else{
                    $this->telefonos=false;
                    break;
                }
            }
        }
        else if(!empty($telefonos)){
            $this->telefonos=false;
        }
    }

    public function getTelefonos(){
        return $this->telefonos;
    }

    public function getClaveEncriptada(){
        return Hash::make($this->clave);
    }

    public function ClaveCorrecta($password)
    {
        if(Hash::check($password,$this->passwordHash)){
            return true;
        }   
        return false;
    }

    public function setNombres($nombres){
        $this->nombres=$nombres;
    }

    public function setApellidos($apellidos){
        $this->apellidos=$apellidos;
    }

    public function setNumero_documento($numero_documento){
        $this->numero_documento=$numero_documento;
    }

    public function setCorreo_principal($correo_principal){
        $this->correo_principal=$correo_principal;
    }

    public function setCorreo_secundario($correo_secundario){
        $this->correo_secundario=$correo_secundario;
    }

    public function getNombres(){
        return $this->nombres;
    }

    public function getApellidos(){
        return $this->apellidos;
    }

    public function getNumero_documento(){
        return $this->numero_documento;
    }

    public function getCorreo_principal(){
        return $this->correo_principal;
    }

    public function getCorreo_secundario(){
        return $this->correo_secundario;
    }

    public function validez(){
        $atributos=array(
            'nombres'=>$this->nombres,
            'apellidos'=>$this->apellidos,
            'numero_documento'=>$this->numero_documento
        );

        $validacion=Validator::make($atributos,[
            'nombres'=>'required|min:2|max:60',
            'apellidos'=>'required|min:2|max:60',
            'numero_documento'=>'required|max:15'
        ]);
        return $validacion;
    }

    public function validez2(){
        $atributos=array(
            'nombres'=>$this->nombres,
            'apellidos'=>$this->apellidos,
            'foto'=>$this->foto
        );

        $validacion=Validator::make($atributos,[
            'nombres'=>'required|min:2|max:60',
            'apellidos'=>'required|min:2|max:60',
            'foto'=>'file|image|nullable'
        ]);
        return $validacion;
    }


    public function getArregloEditar(){
        return array(
            'id'=>$this->id,
            'nombres'=>$this->nombres,
            'apellidos'=>$this->apellidos,
            'correo_principal'=>$this->correo_principal,
            'correo_secundario'=>$this->correo_secundario
        );
    }

    public function validarTelefonos(){
        $validez=true;
        if(!is_null($this->telefonos)){
            if(is_array($this->telefonos)){
                //aqui validar cada valor que compone un telefono, su id, numero y descripcion...
            }
            else{
                $validez=false;
            }
        }
        return $validez;
    }

    public function getArregloFormacionIdioma(){
        $arreglo=array(
            'id'=>$this->formacion_idioma->getId(),
            'lectura'=>$this->formacion_idioma->getLectura(),
            'escritura'=>$this->formacion_idioma->getEscritura(),
            'habla'=>$this->formacion_idioma->getHabla(),
            'escucha'=>$this->formacion_idioma->getEscucha(),
            'usuario_id'=>$this->id,
            'idioma_id'=>$this->formacion_idioma->getIdioma_id()
        );
        return $arreglo;
    }

    public function getArregloFormacionAcademica(){
        $arreglo=array(
            'id'=>$this->formacion_academica->getId(),
            'titulo'=>$this->formacion_academica->getTitulo(),
            'intensidad'=>$this->formacion_academica->getIntensidad(),
            'fecha_inicio'=>$this->formacion_academica->getFecha_inicio(),
            'fecha_fin'=>$this->formacion_academica->getFecha_fin(),
            'promedio'=>$this->formacion_academica->getPromedio(),
            'usuario_id'=>$this->id,
            'nivel_id'=>$this->formacion_academica->getNivel_id(),
            'institucion_id'=>$this->formacion_academica->getInstitucion()->getId()
        );
        return $arreglo;
    }
}