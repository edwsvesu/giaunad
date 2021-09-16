<?php
namespace App\Persistencia\Repositorios;
use App\Dominio\Persistencia\Repositorios\IRepositorioFormacionIdioma;
use Illuminate\Support\Facades\DB;

class RepositorioFormacionIdioma implements IRepositorioFormacionIdioma{
	public function getPorUsuario(int $usuario_id){
		$registros=DB::select("SELECT f.*,i.nombre as idioma FROM formacion_idioma f JOIN idioma i ON f.idioma_id=i.id WHERE f.usuario_id=:usuario_id",['usuario_id'=>$usuario_id]);
		return $registros;
	}

	public function insertar(array $datos){
		unset($datos['id']);
		return DB::insert("INSERT INTO formacion_idioma(lectura,escritura,habla,escucha,usuario_id,idioma_id) VALUES(:lectura,:escritura,:habla,:escucha,:usuario_id,:idioma_id)",$datos);
	}

	public function getFormacionPorIdiomaYUsuario(int $idioma_id,int $usuario_id){
		$registro=DB::select("SELECT * FROM formacion_idioma WHERE idioma_id=:idioma_id AND usuario_id=:usuario_id",['idioma_id'=>$idioma_id,'usuario_id'=>$usuario_id]);
		return $registro;
	}

	public function editarPorUsuario(array $datos){
		unset($datos['idioma_id']);
		$actualizado=DB::update("UPDATE formacion_idioma SET lectura=:lectura,escritura=:escritura,habla=:habla,escucha=:escucha WHERE id=:id AND usuario_id=:usuario_id",$datos);
		return $actualizado;
	}

	public function eliminar(int $id,int $usuario_id){
		return DB::delete("DELETE FROM formacion_idioma WHERE id=:id AND usuario_id=:usuario_id",['id'=>$id,'usuario_id'=>$usuario_id]);
	}
}