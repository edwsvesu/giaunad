<?php
namespace App\Dominio\Servicios\Usuarios\Curriculum;

interface IFormacionAcademicaServicio{
	public function getTodoPorUsuario(int $usuario_id);
	public function getInformacionFormacion(int $formacion_id,$usuario_id);
	public function eliminar(array $datos,int $usuario_id);
	public function getTodosNivelesFormacion();
	public function getTodasInstituciones();
	public function crearFormacionAcademica(array $datos,int $usuario_id);
	public function editarFormacionAcademica(array $datos,int $usuario_id);
}