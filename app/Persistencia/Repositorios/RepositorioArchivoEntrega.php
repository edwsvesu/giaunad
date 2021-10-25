<?php
namespace App\Persistencia\Repositorios;

use App\Dominio\Persistencia\Repositorios\IRepositorioArchivoEntrega;
use Illuminate\Support\Facades\DB;

class RepositorioArchivoEntrega implements IRepositorioArchivoEntrega{
    public function insertar(array $datos)
    {
        return DB::insert('INSERT INTO archivo_entrega (nombre,ruta,entrega_id) VALUES (:nombre,:ruta,:entrega_id)',$datos);
    }
}