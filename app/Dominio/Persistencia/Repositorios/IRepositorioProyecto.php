<?php
namespace App\Dominio\Persistencia\Repositorios;

interface IRepositorioProyecto{
    public function insertar(array $datos);
    public function buscarPorCodigo(string $codigo);
    public function buscarPorId(int $id);
    public function buscarPorIdYLiderId(int $id,int $lidera);
    public function buscarPorCodigoYLiderId(string $codigo,int $lidera);
    public function getId(string $codigo);
}
