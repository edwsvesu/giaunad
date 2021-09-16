<?php

namespace App\Dominio\Persistencia\Repositorios;

interface IRepositorioFormacionIdioma{
	public function getPorUsuario(int $usuario_id);
	public function insertar(array $datos);
	public function getFormacionPorIdiomaYUsuario(int $idioma_id,int $usuario_id);
	public function editarPorUsuario(array $datos);
	public function eliminar(int $id,int $usuario_id);
}