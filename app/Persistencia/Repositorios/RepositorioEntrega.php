<?php
namespace App\Persistencia\Repositorios;

use App\Dominio\Persistencia\Repositorios\IRepositorioEntrega;
use Illuminate\Support\Facades\DB;

class RepositorioEntrega implements IRepositorioEntrega{
    public function insertar(array $datos)
    {
        return DB::insert('INSERT INTO entrega (actividad_id,usuario_id) VALUES (:actividad_id,:usuario_id)',$datos);
    }
}