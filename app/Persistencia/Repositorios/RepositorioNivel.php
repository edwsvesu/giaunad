<?php
namespace App\Persistencia\Repositorios;
use Illuminate\Support\Facades\DB;
use App\Dominio\Persistencia\Repositorios\IRepositorioNivel;

class RepositorioNivel implements IRepositorioNivel{
	public function getTodo(){
		$registros=DB::select("SELECT * FROM nivel");
		return $registros;
	}
}