<?php
namespace App\Persistencia\Repositorios;
use App\Dominio\Persistencia\Repositorios\IRepositorioFormacionAcademica;
use Illuminate\Support\Facades\DB;

class RepositorioFormacionAcademica implements IRepositorioFormacionAcademica{
	public function eliminar(int $id,int $usuario_id){
		return DB::delete("DELETE FROM formacion_academica WHERE id=:id AND usuario_id=:usuario_id",['id'=>$id,'usuario_id'=>$usuario_id]);
	}

	public function insertar(array $datos){
		unset($datos['id']);
		return DB::insert("INSERT INTO formacion_academica (titulo,intensidad,fecha_inicio,fecha_fin,promedio,usuario_id,nivel_id,institucion_id) VALUES (:titulo,:intensidad,:fecha_inicio,:fecha_fin,:promedio,:usuario_id,:nivel_id,:institucion_id)",$datos);
	}

	public function editar(array $datos){
		return DB::insert("UPDATE formacion_academica SET titulo=:titulo,intensidad=:intensidad,fecha_inicio=:fecha_inicio,fecha_fin=:fecha_fin,promedio=:promedio,nivel_id=:nivel_id,institucion_id=:institucion_id WHERE id=:id AND usuario_id=:usuario_id",$datos);
	}
}