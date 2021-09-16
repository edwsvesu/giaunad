<?php
namespace App\Dominio\Servicios\Usuarios\Curriculum;

interface IFormacionIdiomasServicio{
	public function getFormacionIdiomas(int $id);
	public function getTodosIdiomas();
	public function crearFormacionIdioma(array $datos,int $usuario_id);
	public function formacionEstaRegistrada(int $idioma_id,int $usuario_id);
	public function editarFormacionIdioma(array $datos,int $usuario_id);
	public function eliminarFormacionIdioma(array $datos,int $usuario_id);
}