<?php
namespace App\Dominio\Persistencia\Repositorios;

interface IRepositorioTelefono{
    public function getTodosPorUsuarioId(int $id);
    public function eliminar(int $id,int $usuario_id);
    public function actualizarVarios(array $datos);
    public function insertar(array $datos);
}