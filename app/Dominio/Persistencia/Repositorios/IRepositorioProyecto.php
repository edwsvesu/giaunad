<?php
namespace App\Dominio\Persistencia\Repositorios;

interface IRepositorioProyecto{
    public function insertar(array $datos);
    public function buscarPorCodigo(string $codigo);
    public function buscarPorId(int $id);
}
