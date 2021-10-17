<?php

namespace App\Persistencia\Repositorios;

use App\Dominio\Persistencia\Repositorios\IRepositorioUsuarioHasSemillero;
use Illuminate\Support\Facades\DB;

class RepositorioUsuarioHasSemillero implements IRepositorioUsuarioHasSemillero{
    public function insertarVarios(array $datos)
    {
        return DB::table('usuario_has_semillero')->insert($datos);
    }
}