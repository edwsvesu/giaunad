<?php
namespace App\Persistencia\Repositorios;
use App\Dominio\Persistencia\Repositorios\IRepositorioInforme;
use Illuminate\Support\Facades\DB;

class RepositorioInforme implements IRepositorioInforme{
	public function insertar(array $datos){
		DB::insert("INSERT INTO informe(titulo,descripcion,fecha_limite,fecha_entrega,proyecto_id) VALUES (:titulo,:descripcion,:fecha_limite,:fecha_entrega,:proyecto_id)",$datos);
		return DB::select("SELECT LAST_INSERT_ID() as id")[0]->id;
	}

	public function getInformesPorProyecto(int $proyecto_id){
		$registros=DB::select("SELECT * FROM informe WHERE proyecto_id=:proyecto_id",['proyecto_id'=>$proyecto_id]);
		return $registros;
	}

	public function actualizarFechaEntrega(int $informe_id,string $fecha_entrega){
		return DB::update("UPDATE informe SET fecha_entrega=:fecha_entrega WHERE id=:informe_id",['informe_id'=>$informe_id,'fecha_entrega'=>$fecha_entrega]);
	}

	public function buscarPorId(int $informe_id){
		$registro=DB::select("SELECT * FROM informe WHERE id=:informe_id",['informe_id'=>$informe_id]);
		return $registro;
	}
}