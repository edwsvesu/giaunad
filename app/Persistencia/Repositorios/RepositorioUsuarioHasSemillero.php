<?php

namespace App\Persistencia\Repositorios;

use App\Dominio\Persistencia\Repositorios\IRepositorioUsuarioHasSemillero;
use Illuminate\Support\Facades\DB;

class RepositorioUsuarioHasSemillero implements IRepositorioUsuarioHasSemillero{
    public function insertarVarios(array $datos)
    {
        return DB::table('usuario_has_semillero')->insert($datos);
    }

    public function eliminar(int $usuario_id,int $semillero_id)
    {
        return DB::delete('DELETE FROM usuario_has_semillero WHERE usuario_id=:usuario_id AND semillero_id=:semillero_id', ['usuario_id'=>$usuario_id,'semillero_id'=>$semillero_id]);
    }
}