<?php
namespace App\Persistencia\Repositorios;
use Illuminate\Support\Facades\DB;
use App\Dominio\Repositorios\IRepositorioRol;

class RepositorioRol implements IRepositorioRol{
	public function getTodo(){
		return DB::select("SELECT * FROM rol");
	}
}