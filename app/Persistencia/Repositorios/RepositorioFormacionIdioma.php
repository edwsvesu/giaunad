<?php
namespace App\Persistencia\Repositorios;
use App\Dominio\Persistencia\Repositorios\IRepositorioFormacionIdioma;
use Illuminate\Support\Facades\DB;

class RepositorioFormacionIdioma implements IRepositorioFormacionIdioma{
	public function getPorUsuario(int $usuario_id){
		$registros=DB::select("SELECT f.*,i.nombre as idioma FROM formacion_idioma f JOIN idioma i ON f.idioma_id=i.id WHERE f.usuario_id=:usuario_id",['usuario_id'=>$usuario_id]);
		return $registros;
	}
}