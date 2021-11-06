<?php

namespace App\Persistencia\Repositorios;

use App\Dominio\Persistencia\Repositorios\IRepositorioActividad;
use Illuminate\Support\Facades\DB;

class RepositorioActividad implements IRepositorioActividad{
    public function insertar(array $datos)
    {
        return DB::insert('INSERT INTO actividad (codigo,titulo,fecha_entrega,instrucciones,semillero_id) VALUES(:codigo,:titulo,:fecha_entrega,:instrucciones,:semillero_id)',$datos);
    }

    public function getActividades(int $semillero_id)
    {
        $registros=DB::select("SELECT * FROM actividad WHERE semillero_id=:semillero_id",['semillero_id'=>$semillero_id]);
        return $registros;
    }

    public function editar(array $datos)
    {
        $actualizado=DB::update('UPDATE actividad SET titulo=:titulo,fecha_entrega=:fecha_entrega,instrucciones=:instrucciones WHERE id=:id',$datos);
        return $actualizado;
    }

    public function eliminar(int $id)
    {
        return DB::delete('DELETE FROM actividad WHERE id=:id', ['id'=>$id]);
    }
}