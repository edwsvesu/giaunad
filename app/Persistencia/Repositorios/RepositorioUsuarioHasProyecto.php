<?php
namespace App\Persistencia\Repositorios;
use Illuminate\Support\Facades\DB;
use App\Dominio\Persistencia\Repositorios\IRepositorioUsuarioHasProyecto;

class RepositorioUsuarioHasProyecto implements IRepositorioUsuarioHasProyecto{
	public function insertar(array $datos){
		return DB::insert("INSERT INTO usuario_has_proyecto(proyecto_id,usuario_id) VALUES (:proyecto_id,:usuario_id)",$datos);
	}

	public function get(int $usuario_id,int $proyecto_id){
		$registro=DB::select("SELECT * FROM usuario_has_proyecto WHERE usuario_id=:usuario_id AND proyecto_id=:proyecto_id",['usuario_id'=>$usuario_id,'proyecto_id'=>$proyecto_id]);
		return $registro;
	}
}