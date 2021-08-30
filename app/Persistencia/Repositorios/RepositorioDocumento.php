<?php
namespace App\Persistencia\Repositorios;
use Illuminate\Support\Facades\DB;
use App\Dominio\Persistencia\Repositorios\IRepositorioDocumento;

class RepositorioDocumento implements IRepositorioDocumento{
	public function getDocumentosPorProyecto(int $proyecto_id){
		$registros=DB::select("SELECT * FROM documento WHERE proyecto_id=:proyecto_id",['proyecto_id'=>$proyecto_id]);
		return $registros;	
	}

	public function insertarDocumentos(array $datos){
		DB::table('documento')->insert($datos);
	}

	public function eliminarDocumento(string $ruta){
		return DB::delete("DELETE FROM documento where ruta=:ruta",['ruta'=>$ruta]);
	}
}