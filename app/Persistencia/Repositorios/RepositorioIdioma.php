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
}