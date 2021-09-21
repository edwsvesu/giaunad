<?php
namespace App\Dominio\Persistencia\Repositorios;

interface IRepositorioDocumento{
    public function getDocumentosPorProyecto(int $proyecto_id);
    public function insertarDocumentos(array $datos);
    public function eliminarDocumento(string $ruta,int $proyecto_id);
}
