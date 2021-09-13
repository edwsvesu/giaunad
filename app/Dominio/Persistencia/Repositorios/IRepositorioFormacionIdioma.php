<?php

namespace App\Dominio\Persistencia\Repositorios;

interface IRepositorioFormacionIdioma{
	public function getPorUsuario(int $usuario_id);
}