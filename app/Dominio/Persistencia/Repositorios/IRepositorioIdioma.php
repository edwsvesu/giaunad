<?php

namespace App\Dominio\Persistencia\Repositorios;

interface IRepositorioIdioma{
	public function getTodos();
	public function insertar(string $nombre);
}