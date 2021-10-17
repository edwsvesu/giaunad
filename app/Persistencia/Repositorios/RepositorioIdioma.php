<?php
namespace App\Persistencia\Repositorios;
use App\Dominio\Persistencia\Repositorios\IRepositorioInforme;
use Illuminate\Support\Facades\DB;
use App\Dominio\Persistencia\Repositorios\IRepositorioIdioma;

class RepositorioIdioma implements IRepositorioIdioma{
	public function getTodos(){
		$registros=DB::select('SELECT * FROM idioma');
		return $registros;
	}

	public function insertar(string $nombre)
	{
		return DB::insert('insert into idioma (nombre) values (:nombre)',['nombre'=>$nombre]);
	}
}