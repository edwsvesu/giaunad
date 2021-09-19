<?php
namespace App\Persistencia\Repositorios;
use App\Dominio\Persistencia\Repositorios\IRepositorioInstitucion;
use Illuminate\Support\Facades\DB;

class RepositorioInstitucion implements IRepositorioInstitucion{
	public function getTodo(){
		return DB::select("select * from institucion");
	}
}