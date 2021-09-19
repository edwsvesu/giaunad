<?php
namespace App\Persistencia\Repositorios;
use Illuminate\Support\Facades\DB;
use App\Dominio\Persistencia\Repositorios\IRepositorioTipoProyecto;

class RepositorioTipoProyecto implements IRepositorioTipoProyecto
{
	public function getTodos(){
		$registros=DB::select("SELECT * FROM tipo_proyecto");
		return $registros;
	}

	public function insertar(string $nombre){
		$insertado=DB::insert("INSERT INTO tipo_proyecto(nombre) VALUES(:nombre)",['nombre'=>$nombre]);
		if($insertado){
			return DB::select("SELECT LAST_INSERT_ID() as id FROM tipo_proyecto")[0]->id;
		}
	}

	public function editar(int $tipo_proyecto_id,string $valor){
		return DB::update("UPDATE tipo_proyecto SET nombre=:nombre WHERE id=:id",['nombre'=>$valor,'id'=>$tipo_proyecto_id]);
	}

	public function eliminar(int $tipo_proyecto_id){
		return DB::delete("DELETE FROM tipo_proyecto WHERE id=:id",['id'=>$tipo_proyecto_id]);
	}
}