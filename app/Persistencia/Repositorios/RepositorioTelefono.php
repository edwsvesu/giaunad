<?php
namespace App\Persistencia\Repositorios;
use Illuminate\Support\Facades\DB;
use App\Dominio\Persistencia\Repositorios\IRepositorioTelefono;

class RepositorioTelefono implements IRepositorioTelefono{
	public function getTodosPorUsuarioId(int $id){
		$registros=DB::select("SELECT * FROM telefono WHERE usuario_id=:usuario_id",['usuario_id'=>$id]);
		return $registros;
	}

	public function eliminar(int $id,int $usuario_id){
		return DB::delete("DELETE FROM telefono WHERE id=:id AND usuario_id=:usuario_id",['id'=>$id,'usuario_id'=>$usuario_id]);
	}

	public function insertar(array $datos){
		$insertado=DB::insert("INSERT INTO telefono (numero,descripcion,usuario_id) VALUES(:numero,:descripcion,:usuario_id)",$datos);
		if($insertado){
			return DB::select("SELECT LAST_INSERT_ID() as id FROM telefono")[0]->id;
		}
	}

	public function actualizarVarios(array $datos){
		foreach ($datos as $dato){
			DB::update("UPDATE telefono SET numero=:numero,descripcion=:descripcion WHERE id=:id AND usuario_id=:usuario_id",$dato);
		}
		return true;
	}
} 