<?php
namespace App\Persistencia\Repositorios;
use Illuminate\Support\Facades\DB;
use App\Dominio\Persistencia\Repositorios\IRepositorioArchivoInforme;

class RepositorioArchivoInforme implements IRepositorioArchivoInforme{
	public function insertarArchivos(array $datos){
		DB::table('archivo_informe')->insert($datos);
	}

	public function getPorInforme(int $informe_id){
		$registros=DB::select("SELECT * FROM archivo_informe WHERE informe_id=:informe_id",['informe_id'=>$informe_id]);
		return $registros;
	}

	public function eliminarArchivo(string $ruta,int $informe_id){
		return DB::delete("DELETE FROM archivo_informe where ruta=:ruta AND informe_id=:informe_id",['ruta'=>$ruta,'informe_id'=>$informe_id]);
	}
}