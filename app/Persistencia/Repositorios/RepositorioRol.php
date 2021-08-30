<?php
namespace App\Persistencia\Repositorios;
use Illuminate\Support\Facades\DB;
use App\Dominio\Persistencia\Repositorios\IRepositorioRol;

class RepositorioRol implements IRepositorioRol{
	public function getTodo(){
		return DB::select("SELECT * FROM rol");
	}
}