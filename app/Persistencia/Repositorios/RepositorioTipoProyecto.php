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
}