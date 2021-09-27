<?php
namespace App\Dominio\Persistencia\Repositorios;

interface IRepositorioArchivoInforme{
    public function insertarArchivos(array $datos);
    public function getPorInforme(int $informe_id);
    public function eliminarArchivo(string $ruta,int $informe_id);
}