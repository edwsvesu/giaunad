<?php
namespace App\Persistencia\Repositorios;
use Illuminate\Support\Facades\DB;
use App\Dominio\Persistencia\Repositorios\IRepositorioUsuarioHasProyecto;

class RepositorioUsuarioHasProyecto implements IRepositorioUsuarioHasProyecto{
	public function insertar(array $datos){
		return DB::insert("INSERT INTO usuario_has_proyecto(proyecto_id,usuario_id) VALUES (:proyecto_id,:usuario_id)",$datos);
	}
}