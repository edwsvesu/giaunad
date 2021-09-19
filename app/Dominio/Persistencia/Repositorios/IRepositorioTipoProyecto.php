<?php
namespace App\Dominio\Persistencia\Repositorios;

interface IRepositorioTipoProyecto{
	public function getTodos();
	public function insertar(string $nombre);
	public function editar(int $tipo_proyecto_id,string $valor);
	public function eliminar(int $tipo_proyecto_id);
}