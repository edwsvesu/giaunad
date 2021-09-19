<?php
namespace App\Dominio\Persistencia\Repositorios;

interface IRepositorioFormacionAcademica{
    public function eliminar(int $id,int $usuario_id);
    public function insertar(array $datos);
    public function editar(array $datos);
}
