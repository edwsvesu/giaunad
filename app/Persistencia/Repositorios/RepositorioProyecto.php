<?php
namespace App\Persistencia\Repositorios;
use Illuminate\Support\Facades\DB;
use App\Dominio\Repositorios\IRepositorioProyecto;

class RepositorioProyecto implements IRepositorioProyecto{
    public function insertar(array $datos){
        DB::insert('INSERT INTO proyecto(titulo,fecha_inicio,fecha_fin,codigo,tipo_proyecto_id,lidera) VALUES (:titulo,:fecha_inicio,:fecha_fin,:codigo,:tipo_proyecto_id,:lidera)',$datos);
    }
}
