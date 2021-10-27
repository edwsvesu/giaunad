<?php
namespace App\Persistencia\Repositorios;

use App\Dominio\Persistencia\Repositorios\IRepositorioArchivoEntrega;
use Illuminate\Support\Facades\DB;

class RepositorioArchivoEntrega implements IRepositorioArchivoEntrega{
    public function insertar(array $datos)
    {
        return DB::insert('INSERT INTO archivo_entrega (nombre,ruta,entrega_id) VALUES (:nombre,:ruta,:entrega_id)',$datos);
    }

    public function getNombreArchivo(string $ruta,int $entrega_id)
    {
        $registro=DB::select('SELECT nombre FROM archivo_entrega WHERE ruta=:ruta AND entrega_id=:entrega_id',['ruta'=>$ruta,'entrega_id'=>$entrega_id]);
        return $registro;
    }

    public function getArchivosDeEntrega(int $entrega_id)
    {
        $registros=DB::select('SELECT nombre,ruta FROM archivo_entrega WHERE entrega_id=:entrega_id', ['entrega_id'=>$entrega_id]);
        return $registros;
    }

    public function eliminar(int $entrega_id,string $ruta)
    {
        return DB::delete('DELETE FROM archivo_entrega WHERE ruta=:ruta AND entrega_id=:entrega_id', ['ruta'=>$ruta,'entrega_id'=>$entrega_id]);
    }
}