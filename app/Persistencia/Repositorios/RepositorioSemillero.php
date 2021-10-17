<?php
namespace App\Persistencia\Repositorios;

use App\Dominio\Persistencia\Repositorios\IRepositorioSemillero;
use Illuminate\Support\Facades\DB;

class RepositorioSemillero implements IRepositorioSemillero{
    
    public function insertar(array $datos)
    {
        return DB::insert('INSERT INTO semillero(codigo,nombre,fecha_inicio,coordinador_id,lider_id) VALUES(:codigo,:nombre,:fecha_inicio,:coordinador_id,:lider_id)',$datos);
    }  
}