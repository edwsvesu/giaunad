<?php
namespace App\Persistencia\Repositorios;

use App\Dominio\Persistencia\Repositorios\IRepositorioSemillero;
use Illuminate\Support\Facades\DB;

class RepositorioSemillero implements IRepositorioSemillero{
    
    public function insertar(array $datos)
    {
        return DB::insert('INSERT INTO semillero(codigo,nombre,fecha_inicio,coordinador_id,lider_id) VALUES(:codigo,:nombre,:fecha_inicio,:coordinador_id,:lider_id)',$datos);
    }
    
    public function editar(array $datos)
    {

        return DB::update('UPDATE semillero SET nombre=:nombre,coordinador_id=:coordinador_id,lider_id=:lider_id,fecha_inicio=:fecha_inicio WHERE id=:id',$datos);
    }

    public function buscarPorSemilleroIdYLiderId(int $semillero_id,int $lider_id)
    {
        $registro=DB::select('SELECT * FROM semillero WHERE id=:id AND lider_id=:lider_id',['id'=>$semillero_id,'lider_id'=>$lider_id]);
        return $registro;
    }

    public function buscarPorSemilleroIdYCoordinadorId(int $semillero_id,int $coordinador_id)
    {
        $registro=DB::select('SELECT * FROM semillero WHERE id=:id AND coordinador_id=:coordinador_id',['id'=>$semillero_id,'coordinador_id'=>$coordinador_id]);
        return $registro;
    }

    public function eliminar(int $id)
    {
        return DB::delete('DELETE FROM semillero WHERE id=:id', ['id'=>$id]);
    }
}