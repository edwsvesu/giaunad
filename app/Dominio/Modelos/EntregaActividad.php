<?php

namespace App\Dominio\Modelos;

use Illuminate\Support\Facades\Validator;

class EntregaActividad{
    private $id;
    private $archivo;

    public function setArchivo($archivo)
    {
        $this->archivo=$archivo;
    }

    public function validarArchivo()
    {
        $validacion=Validator::make(['archivo'=>$this->archivo],[
            'archivo'=>'file'
        ]);
        return $validacion;
    }

    public function getArregloRegistroArchivo()
    {
        return array(
            'nombre'=>$this->archivo->getClientOriginalName(),
            'ruta'=>$this->archivo->store('semilleros/actividades/entregas'),
            'entrega_id'=>$this->id
        );
    }
}