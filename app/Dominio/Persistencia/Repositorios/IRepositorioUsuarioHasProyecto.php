<?php

namespace App\Dominio\Persistencia\Repositorios;

interface IRepositorioUsuarioHasProyecto{
	public function insertar(array $datos);
	public function get(int $usuario_id,int $proyecto_id);
}